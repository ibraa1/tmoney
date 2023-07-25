<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Balance;
use App\Models\Devise;
use App\Models\Pays;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role === 'admin' || Auth::user()->role === 'superAdmin') {
            $transactions = Transaction::orderBy('date')
                ->withTrashed()
                ->get();
        } else {
            $transactions = Transaction::where('agentId', Auth::user()->id)
                ->orderBy('date')
                ->withTrashed()
                ->get();
        }

        return view('pages.transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pays = Pays::all();
        $agents = User::where('role', 'agent')->get();
        $clients = User::where('role', 'client')->get();
        $devises = Devise::whereNull('dateFin')
            ->get();
        return view('pages.transactions.create', compact('pays', 'agents', 'clients', 'devises'));
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(TransactionRequest $request)
    {
        $code = mt_rand(100000, 999999);

        // Vérifier si le code généré existe déjà dans la base de données
        $existingTransaction = Transaction::where('code', $code)->first();
        while ($existingTransaction) {
            // Si le code existe déjà, générer un nouveau code
            $code = mt_rand(100000, 999999);
            $existingTransaction = Transaction::where('code', $code)->first();
        }

        if ($request->isChecked) {
            // Ajout de la commission au montant
            $totalCommission = $request->commission;
            $totalAmount = $this->calculateAmount($request->montant, $request->remise, $request->typeRemise);
        } else {
            $totalCommission = $this->calculateCommission($request->devise, $this->calculateAmount($request->montant, $request->remise, $request->typeRemise));
            $totalAmount = $this->calculateAmount($request->montant, $request->remise, $request->typeRemise) - $this->calculateCommission($request->devise, $this->calculateAmount($request->montant, $request->remise, $request->typeRemise));
        }

        $agentCommission = $totalCommission * 0.4;
        $retraitantCommission = $totalCommission * 0.3;
        $adminCommission = $totalCommission * 0.3;
        $transaction = new Transaction([
            'type' => $request->type,
            'agentId' =>  Auth::user()->id,
            'deviseId' => $request->devise,
            'date' => $request->date,
            'commission' => $totalCommission,
            'agentCommission' => $agentCommission,
            'retraitantCommission' => $retraitantCommission,
            'adminCommission' => $adminCommission,
            'code' => $code,
            'statut' => 'en attente',
            'remise' => $request->remise,
            'typeRemise' => $request->typeRemise,
            'paysId' => $request->paysId,
            'montant' => $totalAmount,
            'clientId' => $request->clientId,
            'receveurId' => $request->receveurId,
            'creationUserId' => Auth::user()->id,
            'modificationUserId' => Auth::user()->id,
        ]);

        $userBalance = Balance::where('userId', Auth::user()->id)->first();
        if ($userBalance && $userBalance->montant >= ($transaction->montant - $userBalance->montantTotalComission - $userBalance->commission)) {
            // La balance existe et le solde est suffisant
            $transaction->save(); // Sauvegarde de la transaction
            $montantARetire = $transaction->montant + $transaction->commission;
            $userBalance->decrement('montant', $montantARetire);
            $userBalance->increment('montantTotalComission', $agentCommission);
            $userBalance->modificationUserId = Auth::user()->id;
            $userBalance->save();

            // Mise à jour de la balance de l'admin
            $deviseEntreeTransaction = Devise::find($request->devise)->deviseEntree;
            $adminBalance = Balance::where('userId', 6)
                ->whereHas('detailBalance', function ($query) use ($deviseEntreeTransaction) {
                    $query->whereHas('devise', function ($subquery) use ($deviseEntreeTransaction) {
                        $subquery->where('deviseEntree', $deviseEntreeTransaction);
                    });
                })
                ->first();
            // dd($adminBalance);

            if ($adminBalance) {
                $tauxDeChange = $adminBalance->detailBalance->first()->devise->courDevise;
                $adminBalance->increment('montant', $adminCommission * $tauxDeChange);
                $adminBalance->increment('montantTotalComission', $adminCommission * $tauxDeChange);
                $adminBalance->save();
            }
        } else {
            // Le solde de l'utilisateur est insuffisant
            return redirect()->route('transactions.index')->with('error', 'Le solde de votre compte est insuffisant.');
        }

        return redirect()->route('transactions.index')->with('success', 'La transaction a été effectué avec succès.');
    }

    public function cancel($id)
    {
        $transaction = Transaction::where('id', $id)->first();
        // Vérifiez si la transaction peut être annulée (selon vos règles métier)
        if ($transaction->statut === 'en attente') {
            // Vérifiez si la balance de l'agent contient encore le montant de la transaction
            $agentBalance = Balance::where('userId', $transaction->agentId)->first();
            if ($agentBalance && $agentBalance->montant >= $transaction->montant) {
                // Mettez à jour le statut de la transaction à "annulée"
                $transaction->statut = 'annulé';
                $transaction->save();

                $agentBalance->decrement(
                    'montant',
                    $transaction->montant
                );

                $agentBalance->decrement('montantTotalComission', $transaction->agentCommission);
                $agentBalance->modificationUserId = Auth::user()->id;
                $agentBalance->save();


                // Mise à jour de la balance de l'admin pour l'annulation
                $deviseEntreeTransaction = Devise::find($transaction->deviseId)->deviseEntree;
                $adminBalance = Balance::where('userId', 1)
                    ->whereHas('detailBalance', function ($query) use ($deviseEntreeTransaction) {
                        $query->whereHas('devise', function ($subquery) use ($deviseEntreeTransaction) {
                            $subquery->where('deviseEntree', $deviseEntreeTransaction);
                        });
                    })
                    ->first();

                if ($adminBalance) {
                    $tauxDeChange = $adminBalance->detailBalance->first()->devise->courDevise;
                    $adminBalance->decrement('montant', $transaction->adminCommission * $tauxDeChange);
                    $adminBalance->decrement('montantTotalComission', $transaction->adminCommission * $tauxDeChange);
                    $adminBalance->save();
                }

                return redirect()->route('transactions.index')->with('success', 'La transaction a été annulée avec succès.');
            } else {
                return redirect()->route('transactions.index')->with('error', 'La balance de l\'agent ne contient pas suffisamment de fonds pour annuler la transaction.');
            }
        } else {
            return redirect()->route('transactions.index')->with('error', 'La transaction ne peut pas être annulée.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
    public function calculateCommission($deviseId, $montant)
    {
        $devise = Devise::find($deviseId);

        // Vérifier si le montant dépasse 500 000 pour une commission fixe de 1%
        if ($montant > 500000) {
            $commission = ($montant * 0.01);
        } else {
            // Vérifier si c'est un transfert national (deviseEntree est le XOF)
            if ($devise->deviseEntree == 'XOF') {
                if ($montant <= 25000) {
                    $commission = ($montant / 5000) * 250;
                } elseif ($montant <= 50000) {
                    $commission = ($montant / 5000) * 200;
                } elseif ($montant <= 150000) {
                    $commission = ($montant / 5000) * 150;
                } elseif ($montant <= 250000) {
                    $commission = ($montant / 5000) * 100;
                } else {
                    $commission = ($montant / 5000) * 75;
                }
            } else {
                // Transfert international, commission de 1% du montant
                $commission = ($montant * 0.01);
            }
        }

        return $commission;
    }


    public function commission(Request $request)
    {
        $devise = Devise::find($request->devise);

        if ($request->montant > 500000) {
            $commission = ($request->montant * 0.01);
        } else {
            // Vérifier si c'est un transfert national (deviseEntree est le XOF)
            if ($devise->deviseEntree == 'XOF') {
                if ($request->montant <= 25000) {
                    $commission = ($request->montant / 5000) * 250;
                } elseif ($request->montant <= 50000) {
                    $commission = ($request->montant / 5000) * 200;
                } elseif ($request->montant <= 150000) {
                    $commission = ($request->montant / 5000) * 150;
                } elseif ($request->montant <= 250000) {
                    $commission = ($request->montant / 5000) * 100;
                } else {
                    $commission = ($request->montant / 5000) * 75;
                }
            } else {
                $commission = ($request->montant * 0.01);
            }
        }

        return $commission;
    }

    function calculateAmount($montant, $remise, $typeRemise)
    {
        // Calcul du montant avec remise
        if ($typeRemise === 'pourcentage') {
            // Remise en pourcentage
            $montant -= ($montant * $remise) / 100;
        } elseif ($typeRemise === 'valeur') {
            // Remise en valeur
            $montant -= $remise;
        }
        return $montant;
    }
}

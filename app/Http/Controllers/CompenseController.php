<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompenseRequest;
use App\Models\Balance;
use App\Models\Compense;
use App\Models\DetailBalance;
use App\Models\DetailCompense;
use App\Models\Devise;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role === 'admin' || Auth::user()->role === 'superAdmin') {
            $compenses = Compense::orderBy('dateInitiation')
                ->withTrashed()
                ->get();
        } else {
            $compenses = Compense::where('userId', Auth::user()->id)
                ->orderBy('dateInitiation')
                ->withTrashed()
                ->get();
        }

        return view('pages.compenses.index', compact('compenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $latestBalance = Auth::user()
            ->balances()
            ->latest('created_at')
            ->first();
        $devises = Devise::whereNull('dateFin')
            ->where('deviseEntree', $latestBalance->detailBalance->devise->deviseEntree)
            ->get();
        return view('pages.compenses.create', compact('devises'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompenseRequest $request)
    {
        $latestBalance = Auth::user()
            ->balances()
            ->latest('created_at')
            ->first();
        $devise = Devise::find($request->deviseId);
        if ($request->type == 'retraitBalance') {
            if ($request->montant <= $latestBalance->montant) {
                // Création d'une demande de compensation pour le solde
                $compense = new Compense([
                    'userId' => Auth::user()->id,
                    'dateInitiation' => $request->dateInitiation,
                    'statut' => 'en attente',
                    'creationUserId' => Auth::user()->id,
                    'modificationUserId' => Auth::user()->id,
                ]);
                $compense->save();

                $detailCompense = new DetailCompense([
                    'compenseId' => $compense->id,
                    'deviseId' => $request->deviseId,
                    'montant' => $request->montant * $devise->courDevise,
                    'type' => $request->type,
                    'modePaiement' => $request->modePaiement,
                    'creationUserId' => Auth::user()->id,
                    'modificationUserId' => Auth::user()->id,
                ]);
                $detailCompense->save();

                return redirect()->route('compenses.index')->with('success', 'La demande a été envoyée avec succès.');
            } else {
                return redirect()->route('compenses.index')->with('error', 'La demande n\'a pas pu être envoyée. Votre solde est insuffisant.');
            }
        } elseif ($request->type == 'commission') {
            if ($request->montant <= $latestBalance->montantTotalComission) {
                // Création d'une demande de compensation pour la commission
                $compense = new Compense([
                    'userId' => Auth::user()->id,
                    'dateInitiation' => $request->dateInitiation,
                    'statut' => 'en attente',
                    'creationUserId' => Auth::user()->id,
                    'modificationUserId' => Auth::user()->id,
                ]);
                $compense->save();

                $detailCompense = new DetailCompense([
                    'compenseId' => $compense->id,
                    'deviseId' => $request->deviseId,
                    'montant' => $request->montant * $devise->courDevise,
                    'type' => $request->type,
                    'modePaiement' => $request->modePaiement,
                    'creationUserId' => Auth::user()->id,
                    'modificationUserId' => Auth::user()->id,
                ]);
                $detailCompense->save();

                return redirect()->route('compenses.index')->with('success', 'La demande a été envoyée avec succès.');
            } else {
                return redirect()->route('compenses.index')->with('error', 'La demande n\'a pas pu être envoyée. Le montant de la commission est insuffisant.');
            }
        } elseif ($request->type == 'transfertBalance') {
            // Création d'une demande de compensation pour la commission
            $compense = new Compense([
                'userId' => Auth::user()->id,
                'dateInitiation' => $request->dateInitiation,
                'statut' => 'en attente',
                'creationUserId' => Auth::user()->id,
                'modificationUserId' => Auth::user()->id,
            ]);
            $compense->save();

            $detailCompense = new DetailCompense([
                'compenseId' => $compense->id,
                'deviseId' => $request->deviseId,
                'montant' => $request->montant * $devise->courDevise,
                'type' => $request->type,
                'modePaiement' => $request->modePaiement,
                'creationUserId' => Auth::user()->id,
                'modificationUserId' => Auth::user()->id,
            ]);
            $detailCompense->save();

            return redirect()->route('compenses.index')->with('success', 'La demande a été envoyée avec succès.');
        }
    }

    public function approve($id)
    {
        $compense = Compense::where('id', $id)->first();
        $user = User::where('id', $compense->userId)->first();
        $latestBalance = $user
            ->balances()
            ->latest('created_at')
            ->first();
        $devise = Devise::where('id', $compense->detailCompenses[0]->deviseId)->first();;
        $userBalance = $latestBalance;
        if ($compense->detailCompenses[0]->type == 'retraitBalance' && $compense->statut == 'en attente') {
            $compense->statut = 'validé';
            $compense->dateApprobation = now();
            $compense->modificationUserId = Auth::user()->id;
            $compense->save();

            $userBalance = $latestBalance;
            $balance = new Balance([
                'montant' =>   $userBalance->montant - ($compense->detailCompenses[0]->montant / $devise->courDevise),
                'userId' =>  $userBalance->userId,
                'montantTotalComission' => $userBalance->montantTotalComission,
                'creationUserId' => Auth::user()->id,
                'modificationUserId' => Auth::user()->id,
            ]);
            $balance->save();

            $detailBalance = new DetailBalance([
                'balanceId' => $balance->id,
                'deviseId' => $userBalance->detailBalance->deviseId,
                'min' => $userBalance->detailBalance->min,
                'max' => $userBalance->detailBalance->max,
                'creationUserId' => Auth::user()->id,
                'modificationUserId' => Auth::user()->id,
            ]);
            $detailBalance->save();

            return redirect()->route('compenses.index')->with('success', 'La demande a été approuvé avec succès.');
        } elseif ($compense->detailCompenses[0]->type == 'transfertBalance') {
            if (($userBalance->montant + ($compense->detailCompenses[0]->montant / $devise->courDevise)) > $userBalance->detailBalance->max && $compense->statut == 'en attente') {
                $compense->statut = 'validé';
                $compense->dateApprobation = now();
                $compense->modificationUserId = Auth::user()->id;
                $compense->save();

                $userBalance = $latestBalance;

                $balance = new Balance([
                    'montant' =>   $userBalance->montant + ($compense->detailCompenses[0]->montant / $devise->courDevise),
                    'userId' =>  $userBalance->userId,
                    'montantTotalComission' => $userBalance->montantTotalComission,
                    'creationUserId' => Auth::user()->id,
                    'modificationUserId' => Auth::user()->id,
                ]);
                $balance->save();

                $detailBalance = new DetailBalance([
                    'balanceId' => $balance->id,
                    'deviseId' => $userBalance->detailBalance->deviseId,
                    'min' => $userBalance->detailBalance->min,
                    'max' => $userBalance->detailBalance->max,
                    'creationUserId' => Auth::user()->id,
                    'modificationUserId' => Auth::user()->id,
                ]);
                $detailBalance->save();

                return redirect()->route('compenses.index')->with('success', 'La demande a été approuvé avec succès.');
            } else {
                return redirect()->route('compenses.index')->with('error', 'La balance excèdera le montant maximum permis en cas d\'approbation.');
            }
        } elseif ($compense->detailCompenses[0]->type == 'commission' && $compense->statut == 'en attente') {
            $compense->statut = 'validé';
            $compense->dateApprobation = now();
            $compense->modificationUserId = Auth::user()->id;
            $compense->save();

            $userBalance = $latestBalance;

            $balance = new Balance([
                'montant' => $userBalance->montant,
                'userId' =>  $userBalance->userId,
                'montantTotalComission' => $userBalance->montantTotalComission - ($compense->detailCompenses[0]->montant / $devise->courDevise),
                'creationUserId' => Auth::user()->id,
                'modificationUserId' => Auth::user()->id,
            ]);
            $balance->save();

            $detailBalance = new DetailBalance([
                'balanceId' => $balance->id,
                'deviseId' => $userBalance->detailBalance->deviseId,
                'min' => $userBalance->detailBalance->min,
                'max' => $userBalance->detailBalance->max,
                'creationUserId' => Auth::user()->id,
                'modificationUserId' => Auth::user()->id,
            ]);
            $detailBalance->save();

            $userBalance->decrement('montantTotalComission', ($compense->detailCompenses[0]->montant / $devise->courDevise));
            $userBalance->modificationUserId = Auth::user()->id;
            $userBalance->save();

            return redirect()->route('compenses.index')->with('success', 'La demande a été approuvé avec succès.');
        }
    }

    public function reject($id)
    {
        $compense = Compense::find($id);
        $compense->statut = 'réjeté';
        $compense->dateApprobation = now();
        $compense->modificationUserId = Auth::user()->id;
        $compense->save();
        return redirect()->route('compenses.index')->with('success', 'La demande a été réjeté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {

        $compense = Compense::find($id);
        $devises = Devise::whereNull('dateFin')
            ->get();
        if (!$compense) {
            return redirect()->route('compenses.index')->with('error', 'La compense n\'existe pas.');
        }
        return view('pages.compenses.edit', compact('compense', 'devises'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompenseRequest $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $compense = Compense::find($id);
        if (!$compense) {
            return redirect()->route('compenses.index')->with('error', 'La compense n\'existe pas.');
        }
        $compense->delete();

        return redirect()->route('compenses.index')->with('success', 'La compense a été suspendu avec succès.');
    }

    public function forceDestroy($id)
    {
        $compense = Compense::withTrashed()->find($id)->forceDelete();
        if (!$compense) {
            return redirect()->route('compenses.index')->with('error', 'La compense n\'existe pas.');
        }

        return back()->with('success', 'La compense  a bien été définitivement supprimé de la base de données.');
    }
    public function restore($id)
    {
        $compense = Compense::withTrashed()->find($id);

        if (!$compense) {
            return redirect()->route('compenses.index')->with('error', 'La compense n\'existe pas.');
        }
        $compense->restore();

        return redirect()->route('compenses.index')
            ->with('success', 'La compense a été restauré avec succès');
    }
}

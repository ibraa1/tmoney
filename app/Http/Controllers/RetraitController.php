<?php

namespace App\Http\Controllers;

use App\Http\Requests\RetraitRequest;
use App\Models\Balance;
use App\Models\Devise;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RetraitController extends Controller
{
    public function create()
    {
        return view('pages.retraits.create');
    }

    public function searchByCode(Request $request)
    {
        $transactions = Transaction::where('code', $request->code)->where('statut', 'en attente')->first();

        if ($transactions) {
            $transactions->load('client', 'pays', 'receveur', 'devise');
            return response()->json($transactions);
        } else {
            return response()->json(null);
        }
    }

    public function retrait(RetraitRequest $request)
    {
        $transfertTransaction = Transaction::where('type', 'transfert')
            ->where('id', $request->transacId)
            ->where('code', $request->code)
            ->where('statut', 'en attente')
            ->first();

        if ($transfertTransaction) {
            // Récupérer les devises de la transaction et de la balance de l'utilisateur
            $deviseTransfert = Devise::find($request->devise)->deviseSortie;
            $deviseBalance = Auth::user()->balances[0]->detailBalance->devise->deviseEntree;

            $userBalance = Balance::where('userId', Auth::user()->id)->first();
            $maxAllowedBalance = $userBalance->detailBalance->max;
            if ($userBalance->montant + $request->montant > $maxAllowedBalance) {
                return redirect()->back()->with('error', 'Le montant du retrait dépasse le solde maximum autorisé.');
            }

            if ($deviseTransfert === $deviseBalance) {
                // Calcul de la commission du retraitant
                $retraitantCommission = $transfertTransaction->retraitantCommission;

                $deviseEntreeAgent = Auth::user()->balances[0]->detailBalance->devise->deviseEntree;
                $deviseEntreeTransaction = Devise::find($request->devise)->deviseEntree;
                $devise = Devise::where('deviseEntree', $deviseEntreeTransaction)
                    ->where('deviseSortie', $deviseEntreeAgent)
                    ->first();
                if ($devise) {
                    $tauxDeChange = $devise->courDevise;
                    $commissionAgent = $retraitantCommission * $tauxDeChange;
                    $userBalance = Balance::where('userId', Auth::user()->id)->first();
                } else {
                    return redirect()->back()->with('error', 'Erreur, aucun taux de change trouvé contactez l\'admin pour votre commission.');
                }
            } else {
                // La devise de la requête ne correspond pas à la devise de la balance de l'utilisateur
                return redirect()->back()->with('error', 'La devise de la requête ne correspond pas à la devise de la balance de l\'utilisateur.');
            }
        } else {
            // Transaction de transfert non trouvée, gérer l'erreur
            return redirect()->back()->with('error', 'La transaction de transfert est introuvable.');
        }

        $transaction = new Transaction([
            'type' => 'retrait',
            'agentId' =>  Auth::user()->id,
            'deviseId' => $request->devise,
            'date' => $request->date,
            //'code' => $transfertTransaction->code,
            'paysId' => $request->paysId,
            'montant' => $request->montant,
            'retraitantCommission' => $commissionAgent,
            'clientId' => $request->clientId,
            'receveurId' => $request->receveurId,
            'creationUserId' => Auth::user()->id,
            'modificationUserId' => Auth::user()->id,
        ]);

        $transaction->save();

        // Update the status of the transfertTransaction to 'OK' after saving the retrait transaction
        $transfertTransaction->statut = 'OK';
        $transfertTransaction->save();

        $userBalance = Balance::where('userId', Auth::user()->id)->first();

        if ($userBalance) {
            // La balance existe, mise à jour du montant
            $userBalance->increment('montant', $transaction->montant);
            $userBalance->increment('montantTotalComission', $commissionAgent);
            $userBalance->modificationUserId = Auth::user()->id;
            $userBalance->save();
        }

        // Vérification de la mise à jour de la balance de l'utilisateur
        if (!$userBalance || !$userBalance->save()) {
            // Gérer l'erreur
            return redirect()->back()->with('error', 'Erreur lors de la mise à jour de la balance.');
        }


        return redirect()->route('transactions.index')->with('success', 'La transaction a été effectuée avec succès.');
    }
}

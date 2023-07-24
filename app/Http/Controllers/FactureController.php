<?php

namespace App\Http\Controllers;

use App\Models\Compense;
use App\Models\DetailCompense;
use App\Models\Devise;
use App\Models\Transaction;
use Illuminate\Http\Request;

class FactureController extends Controller
{
    public function factureTransfert($id)
    {
        $transaction = Transaction::find($id);
        $devise = Devise::find($transaction->deviseId);
        $data = [
            'id' => $transaction->id,
            'code' => $transaction->code,
            'numeroFacture' => $transaction->id,
            'client' => $transaction->client->prenom . ' ' . $transaction->client->nom,
            'destinataire' => $transaction->receveur->prenom . ' ' . $transaction->receveur->prenom,
            'montant' => $transaction->montant  . ' ' .  $devise->deviseEntree,
            'comission' => $transaction->commission  . ' ' .  $devise->deviseEntree,
            'montantTotal' => ($transaction->commission + $transaction->montant)  . ' ' .  $devise->deviseEntree,
            'montantARetire' => ($transaction->montant * $devise->courDevise)  . ' ' .  $devise->deviseSortie,
            'description' => 'Transfert',
            'date' => $transaction->date
        ];
        return view('factures.transfert', compact('data'));
    }

    public function factureRetrait($id)
    {
        $transaction = Transaction::find($id);
        $devise = Devise::find($transaction->deviseId);
        $data = [
            'id' => $transaction->id,
            'code' => $transaction->code,
            'numeroFacture' => $transaction->id,
            'client' => $transaction->client->prenom . ' ' . $transaction->client->nom,
            'destinataire' => $transaction->receveur->prenom . ' ' . $transaction->receveur->nom,
            'montant' => $transaction->montant . $devise->deviseSortie,
            'description' => 'Retrait',
            'date' => $transaction->date
        ];

        // dd($data);

        return view('factures.retrait', compact('data'));
    }

    public function factureCompense($id)
    {
        $compense = Compense::where('id', $id)->first();
        $detailCompense = DetailCompense::where('compenseId', $compense->id)->first();
        $devise = Devise::find($detailCompense->deviseId);
        $data = [
            'id' => $compense->id,
            'numeroFacture' => $compense->id,
            'agent' => $compense->user->prenom . ' ' . $compense->user->nom,
            'montant' => $detailCompense->montant . ' ' . $devise->deviseSortie,
            'type' => $detailCompense->type,
            'modePaiement' => $detailCompense->modePaiement,
            'dateInitiation' => $compense->dateInitiation,
            'dateApprobation' => $compense->dateApprobation,
        ];

        // dd($data);

        return view('factures.compense', compact('data'));
    }
}

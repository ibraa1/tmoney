<?php

namespace App\Http\Controllers;

use App\Models\Devise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalculetteController extends Controller
{
    public function index()
    {
        $devises = Devise::whereNull('dateFin')->get();
        return view('pages.calculettes.index', compact('devises'));
    }
    public function calculette(Request $request)
    {
        $montant = floatval($request->montant);
        $devise = Devise::where('id', $request->devise)->first();
        $tauxDeChange = floatval($devise->courDevise);
        $montantConverti = $montant / $tauxDeChange;
        $montantConvertiFormat = number_format($montantConverti, 2, '.', ',');

        // Calcul de la commission
        $commission = $this->calculateCommission($devise->id, $montantConverti);

        // Calcul de la somme convertie avec la commission
        $sommeConvertie = $montantConverti - $commission;
        $sommeConvertieFormat = number_format($sommeConvertie, 2, '.', ',');

        $result = $montantConvertiFormat . ' ' . $devise->deviseEntree . ' (Commission: ' . $commission . ' ' . $devise->deviseEntree . ') - Somme totale: ' . $sommeConvertieFormat . ' ' . $devise->deviseEntree;
        return response()->json($result);
    }


    public function calculateCommission($deviseId, $montant)
    {
        $devise = Devise::find($deviseId);

        // Vérifier si c'est un transfert national
        if ($devise->deviseEntree == $devise->deviseSortie) {
            // Transfert national, commission de 1% du montant
            $commission = $montant * 0.01;
        } else {
            // Transfert international
            if ($devise->deviseSortie == 'XOF') {
                // Commission de 200 pour chaque tranche de 5000
                $commission = floor($montant / 5000) * 200;
            } else {
                // Commission de 1% du montant
                $commission = $montant * 0.01;
            }
        }

        return $commission;
    }
}

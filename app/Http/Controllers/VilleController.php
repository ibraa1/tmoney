<?php

namespace App\Http\Controllers;

use App\Models\Ville;
use Illuminate\Http\Request;

class VilleController extends Controller
{
    public function villesByPays(Request $request)
    {
        $paysId = $request->paysId;
        $villes = Ville::where('pays_id', $paysId)->get();
        return response()->json($villes);
    }
}

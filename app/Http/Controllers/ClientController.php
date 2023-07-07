<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function addClient(ClientRequest $request)
    {
        $user = new User([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'ville_id' => $request->ville,
            'pays_id' => $request->pays,
            'numero_tel' => $request->telephone,
            'email' => $request->email,
            'role' => 'client',
            'creation_user_id' => Auth::user()->id,
            'modification_user_id' => Auth::user()->id,
        ]);
        $user->save();
        $user->load('ville', 'pays');
        return response()->json($user);
    }
    public function getReceiverPays(Request $request)
    {
        if ($request->receveurId) {
            $user = User::find($request->receveurId);
            $user->load('pays');
            return response()->json($user);
        }
    }
}

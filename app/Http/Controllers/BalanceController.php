<?php

namespace App\Http\Controllers;

use App\Http\Requests\BalanceRequest;
use App\Models\Balance;
use App\Models\DetailBalance;
use App\Models\Devise;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role === 'admin' || Auth::user()->role === 'superAdmin') {
            $users = User::where('role', '!=', 'client')
                ->orderBy('nom')
                ->withTrashed()
                ->get();
        } else {
            $users = User::where('id', Auth::user()->id)
                ->withTrashed()
                ->get();
        }

        return view('pages.balances.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function balance($id)
    {
        $user = User::where('id', $id)->first();
        $devises = Devise::whereColumn('deviseEntree', '=', 'deviseSortie')
            ->whereNull('dateFin')
            ->get();
        return view('pages.balances.create', compact('devises', 'user'));
    }
    public function addBalance(BalanceRequest $request)
    {
        // Vérification des champs min et max en fonction de la devise d'entrée
        $deviseEntree = Devise::find($request->devise)->deviseEntree;
        $min = 0;
        $max = $deviseEntree === 'GNF' ? 50000000 : $this->convertToMaxEquivalent($request->devise, 5000000);
        // if ($request->min !=  $min || $request->max  !=  $max) {
        //     return redirect()->back()->with('error', 'Les valeurs pour les champs min et max sont invalides.');
        // }
        // Vérification si l'utilisateur a déjà une balance avec la même devise
        $existingBalance = Balance::where('userId', $request->userId)
            ->whereHas('detailBalance', function ($query) use ($request) {
                $query->where('deviseId', $request->devise);
            })
            ->first();

        if ($existingBalance) {
            return redirect()->back()->with('error', 'L\'utilisateur a déjà une balance avec la même devise.');
        }

        $balance = new Balance([
            'montant' => $request->montant,
            'userId' => $request->userId,
            'montantTotalComission' => 0,
            'creationUserId' => Auth::user()->id,
            'modificationUserId' => Auth::user()->id,
        ]);
        $balance->save();

        $detailBalance = new DetailBalance([
            'balanceId' => $balance->id,
            'deviseId' => $request->devise,
            'min' => $request->min,
            'max' => $request->max,
            'creationUserId' => Auth::user()->id,
            'modificationUserId' => Auth::user()->id,
        ]);
        $detailBalance->save();
        return redirect()->route('users.index')->with('success', 'La balance a été ajoutée avec succès.');
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Display the specified resource.
     */
    public function show(Balance $balance)
    {
        //
    }

    public function edit($id)
    {

        $balance = Balance::find($id);
        $devises = Devise::whereColumn('deviseEntree', '=', 'deviseSortie')
            ->whereNull('dateFin')
            ->get();
        if (!$balance) {
            return redirect()->route('balances.index')->with('error', 'La balance n\'existe pas.');
        }
        return view('pages.balances.edit', compact('balance', 'devises'));
    }
    private function convertToMaxEquivalent($deviseId, $maxEquivalentXOF)
    {
        $deviseSortie = Devise::where('deviseEntree', '=', 'XOF')->where('deviseSortie', '=', Devise::find($deviseId)->deviseEntree)->first();
        $courDevise = $deviseSortie ? $deviseSortie->courDevise : 1;

        return $maxEquivalentXOF * $courDevise;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BalanceRequest $request, $id)
    {

        // Vérification des champs min et max en fonction de la devise d'entrée
        $deviseEntree = Devise::find($request->devise)->deviseEntree;
        $min = 0;
        $max = $deviseEntree === 'GNF' ? 50000000 : $this->convertToMaxEquivalent($request->devise, 5000000);
        // if ($request->min !=  $min || $request->max  !=  $max) {
        //     return redirect()->back()->with('error', 'Les valeurs pour les champs min et max sont invalides.');
        // }
        $balance = Balance::find($id);
        if (!$balance) {
            return redirect()->route('balances.index')->with('error', 'La balance n\'existe pas.');
        }
        $balance->montant = $request->montant;
        $balance->montantTotalComission = $request->montantTotalComission;
        $balance->userId = $request->userId;
        $balance->modificationUserId = Auth::user()->id;

        $balance->save();
        $detailBalance = DetailBalance::where('balanceId', $balance->id)->first();
        $detailBalance->deviseId = $request->devise;
        $detailBalance->min = $request->min;
        $detailBalance->max = $request->max;
        $detailBalance->modificationUserId = Auth::user()->id;

        $detailBalance->save();
        return redirect()->route('balances.index')->with('success', 'La balance a été mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $balance = Balance::find($id);
        if (!$balance) {
            return redirect()->route('balances.index')->with('error', 'La balance n\'existe pas.');
        }
        $balance->delete();

        return redirect()->route('balances.index')->with('success', 'La balance a été suspendu avec succès.');
    }

    public function forceDestroy($id)
    {
        $balance = Balance::withTrashed()->find($id)->forceDelete();
        if (!$balance) {
            return redirect()->route('balances.index')->with('error', 'La balance n\'existe pas.');
        }

        return back()->with('success', 'La balance a bien été définitivement supprimé de la base de données.');
    }
    public function restore($id)
    {
        $balance = Balance::withTrashed()->find($id);

        if (!$balance) {
            return redirect()->route('balances.index')->with('error', 'La balance n\'existe pas.');
        }
        $balance->restore();

        return redirect()->route('balances.index')
            ->with('success', 'La balance a été restauré avec succès');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeviseRequest;
use App\Models\Devise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeviseController extends Controller
{
    public function index()
    {
        $devises = Devise::orderBy('dateDebut')->withTrashed()->get();
        return view('pages.devises.index', compact('devises'));
    }

    public function devises()
    {
        $latestBalance = Auth::user()
            ->balances()
            ->latest('created_at')
            ->first();
        $devises = Devise::whereNull('dateFin')
            ->where('deviseEntree', $latestBalance->detailBalance->devise->deviseEntree)
            ->get();
        return response()->json($devises);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.devises.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DeviseRequest $request)
    {
        $existingDevise = Devise::where('deviseEntree', $request->deviseEntree)
            ->where('deviseSortie', $request->deviseSortie)
            ->orderBy('dateDebut', 'desc')
            ->first();
        // dd($existingDevise);

        if ($existingDevise) {
            $existingDevise->dateFin = now()->format('Y-m-d');
            $existingDevise->save();
        }

        $devise = new Devise([
            'frequence' => $request->frequence,
            'deviseEntree' => $request->deviseEntree,
            'deviseSortie' => $request->deviseSortie,
            'courDevise' => $request->courDevise,
            'dateDebut' => $request->dateDebut,
            'dateFin' => null,
            'creationUserId' => Auth::user()->id,
            'modificationUserId' => Auth::user()->id,
        ]);
        $devise->save();

        return redirect()->route('devises.index')->with('success', 'La devise a été ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $devise = Devise::find($id);
        //TODO: redirectionner vers la page d'erreur 404 lorsqu'elle sera créée
        if (!$devise) {
            return redirect()->route('devises.index')->with('error', 'La devise n\'existe pas.');
        }
        return view('pages.devises.show', compact('devise'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $devise = Devise::find($id);
        if (!$devise) {
            return redirect()->route('devises.index')->with('error', 'La devise n\'existe pas.');
        }
        return view('pages.devises.edit', compact('devise'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DeviseRequest $request, $id)
    {
        $devise = Devise::find($id);
        if (!$devise) {
            return redirect()->route('devises.index')->with('error', 'La devise n\'existe pas.');
        }
        $devise->frequence = $request->frequence;
        $devise->deviseEntree = $request->deviseEntree;
        $devise->deviseSortie = $request->deviseSortie;
        $devise->courDevise = $request->courDevise;
        $devise->dateDebut = $request->dateDebut;
        $devise->modificationUserId = Auth::user()->id;

        $devise->save();
        return redirect()->route('devises.index')->with('success', 'La devise a été mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $devise = Devise::find($id);
        if (!$devise) {
            return redirect()->route('devises.index')->with('error', 'La devise n\'existe pas.');
        }
        $devise->delete();

        return redirect()->route('devises.index')->with('success', 'La devise a été suspendu avec succès.');
    }

    public function forceDestroy($id)
    {
        $devise = Devise::withTrashed()->find($id)->forceDelete();
        if (!$devise) {
            return redirect()->route('devises.index')->with('error', 'La devise n\'existe pas.');
        }

        return back()->with('success', 'La devise a bien été définitivement supprimé de la base de données.');
    }
    public function restore($id)
    {
        $devise = Devise::withTrashed()->find($id);

        if (!$devise) {
            return redirect()->route('devises.index')->with('error', 'La devise n\'existe pas.');
        }
        $devise->restore();

        return redirect()->route('devises.index')
            ->with('success', 'La devise a été restauré avec succès');
    }
}

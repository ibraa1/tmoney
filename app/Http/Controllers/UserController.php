<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Mail\PasswordEmail;
use App\Models\Balance;
use App\Models\DetailBalance;
use App\Models\Devise;
use App\Models\Pays;
use App\Models\User;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', '!=', 'client')
            ->orderBy('nom')
            ->withTrashed()
            ->get();

        // dd($users);
        return view('pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Pays::all();
        $villes = Ville::all();
        $devises = Devise::whereColumn('deviseEntree', '=', 'deviseSortie')
            ->whereNull('dateFin')
            ->get();
        // $devises = Devise::all();
        return view('pages.users.create', compact('countries', 'villes', 'devises'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        // Vérification des champs min et max en fonction de la devise d'entrée
        $deviseEntree = Devise::find($request->devise)->deviseEntree;
        $min = 0;
        $max = $deviseEntree === 'GNF' ? 50000000 : $this->convertToMaxEquivalent($request->devise, 5000000);
        if ($request->min !=  $min || $request->max  !=  $max) {
            return redirect()->back()->with('error', 'Les valeurs pour les champs min et max sont invalides.');
        }
        $user = new User([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'adresse' => $request->adresse,
            'ville_id' => $request->ville,
            'pays_id' => $request->pays,
            'numero_tel' => $request->numero_tel,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'creation_user_id' => Auth::user()->id,
            'modification_user_id' => Auth::user()->id,
        ]);

        if ($request->hasFile('image')) {
            $photo = $request->file('image');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('images/users'), $filename);
            $path = 'images/users/' . $filename;

            $user->image = $path;
        }
        $user->save();

        $balance = new Balance([
            'montant' => $request->montant,
            'userId' => $user->id,
            'montantTotalComission' => $request->montantTotalComission,
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

        Mail::to($user->email)->send(new PasswordEmail($user->nom, $request->password));

        return redirect()->route('users.index')->with('success', 'L\'utilisateur a été ajouté avec succès.');
    }

    private function convertToMaxEquivalent($deviseId, $maxEquivalentXOF)
    {
        $deviseSortie = Devise::where('deviseEntree', '=', 'XOF')->where('deviseSortie', '=', Devise::find($deviseId)->deviseEntree)->first();
        $courDevise = $deviseSortie ? $deviseSortie->courDevise : 1;

        return $maxEquivalentXOF * $courDevise;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);
        //TODO: redirectionner vers la page d'erreur 404 lorsqu'elle sera créée
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'L\'utilisateur n\'existe pas.');
        }
        return view('pages.users.show', compact('user'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $countries = Pays::all();
        $villes = Ville::all();
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'L\'utilisateur n\'existe pas.');
        }

        return view('pages.users.edit', compact('user', 'countries', 'villes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'L\'utilisateur n\'existe pas.');
        }
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->adresse = $request->adresse;
        $user->ville_id = $request->ville;
        $user->pays_id = $request->pays;
        $user->numero_tel = $request->numero_tel;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->modification_user_id = Auth::user()->id;

        if ($request->hasFile('image')) {
            $photo = $request->file('image');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('images/users'), $filename);
            $path = 'images/users/' . $filename;

            $user->image = $path;
        }
        $user->save();
        return redirect()->route('users.index')->with('success', 'L\'utilisateur a été mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Trouve le Controlleur spécifié dans la base de données
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'L\'utilisateur n\'existe pas.');
        }

        // // Supprime l'image associée au Controlleur, si elle existe
        // if ($user->image) {
        //     // Supprimez le fichier de l'image en utilisant la fonction `unlink`
        //     unlink(public_path($user->image));
        // }

        // Suspend le Controlleur de la base de données
        $user->delete();

        return redirect()->route('users.index')->with('success', 'L\'utilisateur a été suspendu avec succès.');
    }

    public function forceDestroy($id)
    {
        $user = User::withTrashed()->find($id)->forceDelete();
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'L\'utilisateur n\'existe pas.');
        }

        return back()->with('success', 'L\'utilisateur a bien été définitivement supprimé de la base de données.');
    }
    public function restore($id)
    {
        $user = User::withTrashed()->find($id);

        if (!$user) {
            return redirect()->route('users.index')->with('error', 'L\'utilisateur n\'existe pas.');
        }
        $user->restore();

        return redirect()->route('users.index')
            ->with('success', 'L\'utilisateur a été restauré avec succès');
    }
}

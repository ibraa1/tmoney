<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\Pays;
use App\Models\User;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit($id)
    {
        $countries = Pays::all();
        $villes = Ville::all();
        $user = User::find($id);
        // dd($user->balances[0]->detailBalance->devise->deviseEntree);
        if (!$user) {
            return redirect()->route('/')->with('error', 'L\'utilisateur n\'existe pas.');
        }

        return view('pages.profiles.editProfile', compact('user', 'countries', 'villes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileRequest $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('/')->with('error', 'L\'utilisateur n\'existe pas.');
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
        return redirect()->route('profile.edit', $user->id)->with('success', 'Informations mises à jour avec succès.');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function editPassword()
    {
        return view('pages.profiles.editPassword');
    }
    public function editPicture()
    {
        return view('pages.profiles.editProfilePicture');
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePassword(PasswordUpdateRequest $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('profile.editPassword', $id)->with('error', 'L\'utilisateur n\'existe pas.');
        }
        if (!Hash::check($request->oldPassword, Auth::user()->password)) {
            return redirect()->route('profile.editPassword', $id)->with('error', 'Le mot de passe actuel n\'est pas correct.');
        }
        $user->password = Hash::make($request->newPassword);
        $user->save();
        return redirect()->route('profile.edit', $user->id)->with('success', 'Mot de passe mis à jour avec succès.');
    }

    public function deleteProfilePicture()
    {
        $user = User::find(Auth::user()->id);
        $user->image = 'images/users/defaultUserPicture.jpg';
        $user->save();
        return redirect()->route('profile.edit', $user->id)->with('success', 'Photo supprimée avec succès.');
    }

    public function changeProfilePicture(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if ($request->hasFile('image')) {
            $photo = $request->file('image');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('images/users'), $filename);
            $path = 'images/users/' . $filename;
            $user->image = $path;
        }

        $user->save();
        return redirect()->route('profile.edit', $user->id)->with('success', 'Photo modifiée avec succès.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Rules\ReCaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.auth.login');
    }
    public function login(AuthRequest $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {
            return back()->with('error', 'Email ou mot de passe invalide.');
        }
        return redirect()->intended('/');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('getLogin');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('panel');
        }

        return view('auth.login');
    }

    public function login(loginRequest $request)
    {
        // 1️⃣ Autenticar SOLO email y password
        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()->withErrors([
                'email' => 'Credenciales incorrectas',
            ])->withInput();
        }

        // 2️⃣ Verificar si el usuario está activo
        if (Auth::user()->estado == 0) {
            Auth::logout();

            return back()->withErrors([
                'email' => 'Tu cuenta está desactivada',
            ]);
        }

        // 3️⃣ Regenerar sesión
        $request->session()->regenerate();

        return redirect()->route('panel');
    }
}

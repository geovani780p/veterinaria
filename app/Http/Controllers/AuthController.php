<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        $titulo_pagina = 'Login | Veterinaria';
        return view('modules.login.index', compact('titulo_pagina'));
    }

    // Autenticación real con Auth::attempt
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            if (!Auth::user()->activo) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return back()->withErrors(['email' => 'Tu usuario está inactivo. Contacta al administrador.'])->onlyInput('email');
            }
            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => 'Las credenciales no son válidas.',
        ])->onlyInput('email');
    }

    // Mostrar formulario de registro
    public function showRegister(): View
    {
        $titulo_pagina = 'Registro de usuario';
        return view('modules.register.index', compact('titulo_pagina'));
    }

    // Guardar nuevo usuario
    public function storeRegister(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home')->with('status', 'Registro exitoso. ¡Bienvenido!');
    }

    // Cerrar sesión
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('status', 'Sesión cerrada.');
    }
}

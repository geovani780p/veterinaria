<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UsuariosController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        $titulo_pagina = 'Administración de usuarios';
        $usuarios = User::all();
        return view('modules.usuarios.index', compact('titulo_pagina', 'user', 'usuarios'));
    }

    public function edit(User $user, Request $request): View|RedirectResponse
    {
        if ($request->user()->id !== $user->id) {
            return redirect()->route('home')->with('status', 'Solo puedes editar tu propio usuario.');
        }
        $titulo_pagina = 'Editar usuario';
        return view('modules.usuarios.edit', compact('titulo_pagina', 'user'));
    }

    public function update(User $user, Request $request): RedirectResponse
    {
        if ($request->user()->id !== $user->id) {
            return redirect()->route('home')->with('status', 'Solo puedes editar tu propio usuario.');
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->update($data);
        return redirect()->route('home')->with('status', 'Usuario actualizado.');
    }

    public function toggle(User $user, Request $request): RedirectResponse
    {
        $user->activo = $user->activo ? 0 : 1;
        $user->save();
        return redirect()->route('home')->with('status', 'Estado actualizado.');
    }

    public function updatePassword(User $user, Request $request): RedirectResponse
    {
        $data = $request->validate([
            'password' => ['required', 'confirmed', 'min:6'],
        ]);
        $user->password = $data['password']; // El modelo User lo hashea automáticamente
        $user->save();
        return redirect()->route('home')->with('status', 'Contraseña actualizada correctamente.');
    }
}

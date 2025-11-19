<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuariosController;

// Login
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');
Route::get('/', function () { return redirect()->route('login'); });

// Register deshabilitado por políticas internas (sin acceso público)

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Administración de usuarios (home tras login)
Route::middleware('auth')->group(function () {
	Route::get('/home', [UsuariosController::class, 'index'])->name('home');
	Route::get('/usuarios/{user}/edit', [UsuariosController::class, 'edit'])->name('usuarios.edit');
	Route::patch('/usuarios/{user}', [UsuariosController::class, 'update'])->name('usuarios.update');
	Route::patch('/usuarios/{user}/toggle', [UsuariosController::class, 'toggle'])->name('usuarios.toggle');
	Route::patch('/usuarios/{user}/password', [UsuariosController::class, 'updatePassword'])->name('usuarios.updatePassword');
});

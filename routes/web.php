<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

// ... Rutas de login que ya tenías
Route::get('/', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');


// Dashboard: Protegido por el middleware 'auth'
// Un usuario solo puede acceder si ha iniciado sesión.
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

// Logout: Ruta que acepta una solicitud POST para cerrar sesión
Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');
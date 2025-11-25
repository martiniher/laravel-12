<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Muestra el dashboard con la información del usuario autenticado.
     */
    public function index(Request $request): View
    {
        
        // Recupera al usuario autenticado (ya garantizado por el middleware 'auth')
        $user = Auth::user();

        // dump($user);
        // Lo sacamos de la request
        // dump($request->user());

        return view('dashboard.index', compact('user'));
    }

    /**
     * Cierra la sesión del usuario.
     */
    public function logout(Request $request): RedirectResponse
    {
        // Cierra la sesión del usuario
        Auth::logout();

        // Invalida la sesión actual
        $request->session()->invalidate();

        // Regenera el token CSRF para evitar ataques
        $request->session()->regenerateToken();

        // Redirige al usuario a la página de inicio o de login
        return redirect('/');
    }
}

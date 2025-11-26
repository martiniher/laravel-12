<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Muestra la vista de perfil del usuario.
     */
    public function index(): View
    {
        // 1. Usar el Gate para verificar el acceso.
        // Si el Gate 'view-profile' devuelve false, lanzará un error 403 (Unauthorized).
        //  Gate::authorize('view-profile');

        // 2. Si pasa el Gate, carga la vista.
        $user = Auth::user();

        return view('profile.index', compact('user'));
    }
}
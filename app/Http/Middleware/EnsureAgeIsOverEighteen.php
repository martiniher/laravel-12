<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAgeIsOverEighteen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    /*
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }
    */
    public function handle(Request $request, Closure $next): Response
    {
        // Supongamos que la edad viene en la URL como parámetro de consulta (?age=...)
        if ($request->age < 18) {
            // Si la edad es menor de 18, lo redirigimos a la página de inicio
            // con un mensaje de error.
            return redirect('/')->with('error', 'Debes ser mayor de 18 años para acceder aquí.');
        }

        // Si la comprobación pasa, permitimos que la petición continúe
        // hacia el controlador o el siguiente middleware en la cadena.
        return $next($request);
    }
}

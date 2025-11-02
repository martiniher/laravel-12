<?php
namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * Muestra una lista de todos los empleados.
     */
    public function index()
    {
        // 1. Obtener todos los empleados de la base de datos
        // El método all() devuelve una "Collection" (Colección) de modelos Empleado.
        $empleados = Empleado::all();

        // 2. Devolver la vista, pasando la colección de empleados.
        return view('empleados.index', [
            // Ahora pasamos la variable $empleados a la vista con el mismo nombre.
            'empleados' => $empleados
        ]);
    }
}


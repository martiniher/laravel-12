<?php
namespace App\Http\Controllers;

class EmpleadoController extends Controller
{
    public function index() {
        return view('empleados.index', [
            'name' => 'John Doe'
        ]);
    }
}

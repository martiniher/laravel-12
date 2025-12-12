<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\ExampleService; // Importamos el servicio.

class ExampleController extends Controller
{
    
    // INI - La manera larga de inyectar un servicio.
    private $exampleService;

    public function __construct(ExampleService $exampleService)
    {
        $this->exampleService = $exampleService;
    }
    // FIN
    
    /*
    // La manera corta de inyectar un servicio.
    public function __construct(private ExampleService $exampleService)
    {
    }
    */

    public function index(Request $request){
        $resultado = $this->exampleService->checkSuccess(['prueba' => 'dato de prueba']); //Usamos el servicio
        dd($resultado);
    }
}

# Servicios

Los Servicios se utilizan para centralizar y encapsular la lógica de negocio compleja, sacándola de los controladores y modelos. Esto mantiene tu código limpio, fácil de probar (testable) y reutilizable. Para poder utilizar estos Servicios de forma eficiente y desacoplada, se emplea el patrón de Inyección de Dependencias (DI) donde una clase no crea sus dependencias , sino que las recibe (o son "inyectadas") desde una fuente externa. Esto permite un código más flexible, modular y mucho más fácil de probar.

### Definición

```php
// app\Services\ExampleService.php

namespace App\Services;

class ExampleService
{
    public function checkSuccess(array $data)
    {
        // Aquí iría tu lógica:

        return [
            'status' => 'success',
            'message' => 'Order processed successfully.',
            'data' => $data
        ];
    }
}
```

### Uso en un controlador

```php
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

    public function index(Request $request){
        $resultado = $this->exampleService->checkSuccess(['prueba' => 'dato de prueba']); //Usamos el servicio
        dd($resultado);
    }
}
```

Creamos una carpeta y un fichero para el servicio: Ejemplo en la consola de Laragon:
```bash
mkdir -p app\Services
touch app\Services\ExampleService.php
```
```php
// app\Services\ExampleService.php

namespace App\Services;

class ExampleService
{
    public function checkSuccess(array $data)
    {
        // Aquí iría tu lógica:

        return [
            'status' => 'success',
            'message' => 'Order processed successfully.',
            'data' => $data
        ];
    }
}
```

Creamos el controlador

```bash
 php artisan make:Controller ExampleController
 ```
 ```php
// app\Http\Controllers\ExampleController.php

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

    public function index(Request $request){
        $resultado = $this->exampleService->checkSuccess(['prueba' => 'dato de prueba']); //Usamos el servicio
        dd($resultado);
    }
}
```

Enrutamos la petición al controlador.
```php
// routes\web.php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ExampleController;


Route::get('/', [ExampleController::class, 'index'])->name('index');
```

#### 1. Primer controlador
Creamos el controlador
```bash
php artisan make:controller EmpleadoController
```

Editamos en `app\Http\Controllers\EmpleadoController.php`
```bash
<?php
namespace App\Http\Controllers;

use Illuminate\View\View;

class EmpleadoController extends Controller
{
    public function index() {
        return view('empleados.index', [
            'name' => 'John Doe'
        ]);
    }
}
```

#### 2. Primera vista
Creamos la vista
```
php artisan make:view empleados.index
```

Editamos en `resources\views\empleados\index.blade.php`
```bash
<html>
    <body>
        <h1>Hello, {{ $name }}</h1>
    </body>
</html>
```

#### 3. Enrutamos la petición
Editamos en `routes\web.php`

```bash
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmpleadoController;

Route::get('/empleado', [EmpleadoController::class, 'index']);
```

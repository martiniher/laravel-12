### 1. Primer modelo
Creamos el primero modelo

```bash
php artisan make:model Empleado
```

El modelo se creara en `app\Models\Empleado.php`

### 2. Creamos la tabla en la BBDD y datos de ejemplo

```sql
CREATE TABLE empleados (
    id_empleado INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE,
    dni VARCHAR(15) UNIQUE NOT NULL,
    sexo CHAR(1),
    edad TINYINT,
    fecha_nacimiento DATE,
    curriculum VARCHAR(255)
);


INSERT INTO empleados (nombre, apellidos, email, dni, sexo, edad, fecha_nacimiento, curriculum)
VALUES ('Ana', 'García Pérez', 'ana.garcia@empresa.com', '12345678A', 'F', 35, '1990-05-15', 'Líder de proyecto con 10 años de experiencia en desarrollo Java.');

INSERT INTO empleados (nombre, apellidos, email, dni, sexo, edad, fecha_nacimiento, curriculum)
VALUES ('Javier', 'López Ruiz', 'javier.lopez@empresa.com', '87654321B', 'M', 24, '2001-08-20', 'Desarrollador Junior enfocado en front-end y metodologías ágiles.');

INSERT INTO empleados (nombre, apellidos, email, dni, sexo, edad, fecha_nacimiento, curriculum)
VALUES ('Marta', 'Torres Sánchez', 'marta.torres@empresa.com', '11223344C', 'F', 42, '1983-02-10', 'Especialista en RRHH y gestión de talento.');

```

### 3. Modificamos la ruta

```php
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmpleadoController;

Route::get('/empleados', [EmpleadoController::class, 'index']);

```

### 4. Modificamos la ruta

Modificamos el controlador

```php
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
```

### 5. Modificamos la vista
```blade
@if($empleados->isEmpty())
    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg shadow-md">
        <p class="font-bold">Información:</p>
        <p>No se encontraron empleados registrados en la base de datos.</p>
    </div>
@else
    <div class="shadow-lg overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-indigo-600 text-white">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                        Nombre Completo
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                        Edad
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Acciones</span>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($empleados as $empleado)
                    <tr class="hover:bg-indigo-50 transition duration-150 ease-in-out">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $empleado->id_empleado }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ $empleado->nombre }} {{ $empleado->apellidos }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ $empleado->email }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $empleado->edad }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="#" class="text-indigo-600 hover:text-indigo-900 transition duration-150">Ver Detalle</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
```

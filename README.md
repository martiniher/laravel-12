Original:
[https://laravel9.netlify.app/04-nivel-intermedio/](https://laravel9.netlify.app/04-nivel-intermedio/)

### 1.- Crear un Router
Las rutas son los puntos de entrada a nuestra aplicación. Cada vez que un usuario hace una petición a una de las rutas de la aplicación, Laravel trata la petición mediante un Router definido en el directorio routes, el cual será el encargado de direccionar la petición a un Controlador. Las rutas accesibles para navegadores estarán definidas en el archivo `routes/web.php` y aquellas accesibles para servicios web (webservices) estarán definidas en el archivo `routes/api.php´. A continuación se muestra un ejemplo:

```php
Route::get('/articulos', function () {
    return '¡Vamos a leer unos articulos!';
});
```

El código anterior muestra cómo se define una ruta básica. En este caso, cuando el usuario realice una petición sobre `/articulos`, nuestra aplicación ejecutará la función anónima definida. En este caso enviará una respuesta al usuario con el string '¡Vamos a leer unos articulos!'.

Podemos especificar tantas rutas como queramos:

```php
Route::get('/articulos', function () {
    return '¡Vamos a leer unos articulos!';
});

Route::get('/usuarios', function () {
    return 'Hay muchos usuarios en esta aplicación';
});
```
También es posible responder a peticiones de tipo POST, por ejemplo para recibir datos de formularios:

```php

Route::get('/articulos', function () {
    return '¡Vamos a leer unos articulos!';
});

Route::post('/articulos', function () {
    return '¡Vamos a insertar un artículo!';
});
```

Aparte de ejecutar las acciones definidas para cada ruta, Laravel ejecutará el middlewere específico en función del Router utilizado (por ejemplo, el middlewere relacionado con las peticiones web proveerá de funcionalidades como el estado de la sesión o la protección CSRF).

Ver las rutas creadas
La utilidad Artisan de Laravel nos provee de comandos muy útiles (por ejemplo, para crear controladores o migraciones). Disponemos de un comando concreto para mostrar todas las rutas de una aplicación de forma rápida. Basta con ejecutar el siguiente comando en la consola:

```bash
php artisan route:list
```

Si quieres que Laravel no muestre las rutas creadas por paquetes de terceros (vendor) puedes añadir el flag except-vendor al final:
```bash
php artisan route:list --except-vendor
```

Devolver un JSON
También es posible devolver un JSON. Laravel convertirá automáticamente cualquier array a JSON:

```php
Route::get('/articulos', function () {
    $articulos = [
        [
            "id" => 1,
            "titulo" => "Primer artículo..."
        ],
        [
            "id" => 1,
            "titulo" => "Segundo artículo..."
        ]
    ];
    return $articulos;
});
```

Parámetros en la ruta
Una URL puede contener información de nuestro interés. Laravel permite acceder a esta información de forma sencilla utilizando los parámetros de ruta:

```php
Route::get('articulos/{id}', function ($id) {
    return 'Vas a leer el artículo: '.$id;
});
```
Los parámetros de ruta vienen definidos entre llaves {} y se inyectan automáticamente en las callbacks. Es posible utilizar más de un parámetro de ruta:

```php
Route::get('articulos/{id}/usuario/{name}', function ($id, $name) {
    return 'Vas a leer el artículo: '.$id. ' del usuario' .$name;
});
```

Para indicar un parámetro como opcional, le tenemos que añadir el símbolo ? al final del parámentro. Le tendremos que añadir un valor por defecto para asegurarnos su correcto funcionamiento:

```php
Route::get('articulos/{id?}', function ($id = 0) {
    return 'Vas a leer el artículo: '.$id;
});
```

Acceder a la información de la petición
También es posible acceder a la información enviada en la petición mediante el método request(). Por ejemplo, el siguiente código devolverá el valor enviado para el parámetro **'fecha'** de la URL `/articulos?fecha=hoy`:

```php
Route::get('/articulos', function () {
    $fecha = request('fecha');
    return $fecha;
});
```

Rutas con nombre
Es posible asignar nombres a las rutas que sirvan para referirnos a ellas. De esta forma, en caso de que la URL de una ruta cambie, únicamente tendremos que cambiarlo en el router y no en todos los ficheros HTML donde estemos enlazando a dicha ruta.

Para especificar el nombre a una ruta debemos utilizar la función name(), la cual deberá recibir como parámetro el nombre que se desea asignar a la ruta:


```php
Route::get('/articulos', function () {
    return "Ruta con nombre!";
})->name('articulos.index');
```

En un futuro veremos cómo generar las URLs a partir de su nombre. Por ejemplo, en lugar de utilizar:
```html
<a href="/articulos">Ver artículos</a>
```
utilizaremos:
```html
<a href="{{ route('articulos.index') }}">Ver artículos</a>
```

#### Hands on! (2/7)
Añade a tu aplicación revistapp dos nuevas rutas. - `articulos/`: Devolverá un array de artículos en formato JSON. Asigna el nombre `articulos.index` a la ruta utilizando la función **name()**. - `articulos/{id}`: Devolverá la siguiente frase: "Gracias por leer el artículo con id: {id}". Asigna el nombre `articulos.show` a la ruta utilizando la función **name()**.

Solución

```php
Route::get('/articulos', function () {
    $articulos = [
        ["id" => 1, "titulo" => "Primer artículo..."],
        ["id" => 2, "titulo" => "Segundo artículo..."],
        ["id" => 3, "titulo" => "Tercer artículo..."],
    ];
    return $articulos;
})->name('articulos.index');

Route::get('articulos/{id}', function ($id) {
    $frase = "Gracias por leer el artículo con id: " . $id;
    return $frase;
})->name('articulos.show');
```

### Paso 2 - Crear una vista
Definiendo una vista sencilla
Las vistas son plantillas que contienen el HTML que enviará nuestra aplicación a los usuarios. Se almacenan en el directorio `/resources/views` de nuestro proyecto.

```html
<!-- vista almacenada en /resources/views/articulos.blade.php -->
<html>
    <body>
        <h1>¡Vamos a leer unos artículos!</h1>
    </body>
</html>
```

Tendrán la extensión `.blade.php` ya que Laravel utiliza el **motor de plantillas Blade**, como veremos más adelante.

Devolver una vista
Cargar y devolver una vista al usuario es tan sencillo como utilizar la función global (helper) view():

```php
Route::get('/articulos', function () {
    return view('articulos');
})->name('articulos');
```

Al indicarle el nombre de la vista como parámetro no es necesario indicar la ruta completa de la vista ni la extensión .blade.php. Laravel asume que las vistas estarán en la carpeta `/resources/views` y que tendrán la extensión `.blade.php`.
Acceder a datos desde la vista
Laravel utiliza el motor de plantillas Blade por defecto. Un motor de plantillas permite crear vistas empleando código HTML junto con código específico del motor empleado. De esta forma podremos mostrar información almacenada en variables, crear condiciones if/else, estructuras repetitivas, etc.

En Blade mostrar datos almacenados en variables es muy sencillo:

```php
<?php $nombre = "Nora"; ?>
<html>
    <body>
    <h1>Vamos a leer al escritor {{ $nombre }}</h1>
        </ul>
    </body>
</html>
```

Tal y como se puede ver en el ejemplo anterior, basta con escribir el nombre de la variable entre llaves {{ }}. Es una buena práctica evitar mezclar el código PHP con nuestras vistas, por lo que toda la información que necesitemos en las vistas la ubicaremos fuera de ellas. Existen distintas formas de pasarle variables a las vistas:

La primera opción sería utilizando el método **with()**, pasándole como parámetros el nombre de la variable y su valor:

```php
Route::get('/', function () {
    $nombre = "Nora";
    return view('saludo')->with('nombre', $nombre);
});
```

Otra forma sería enviándolo como array:

```php
Route::get('/', function () {
    $nombre = "Nora";
    return view('saludo')->with(['nombre' => $nombre]);
});
```
También podríamos pasar el array como segundo parámetro de la función view() y no utilizar with():
```php
Route::get('/', function () {
    $nombre = "Nora";
    return view('saludo',['nombre' => $nombre]);
});
```

Blade permite iterar por los datos de una colección o array. El siguiente ejemplo muestra cómo iterar por un array de strings de forma rápida:

```php
<!-- Vista almacenada en resources/views/articulos.blade.php -->
<html>
    <body>
    <h1>Vamos a leer al escritor {{ $nombre }}</h1>
        <h2>Estos son sus últimos artículos:</h2>
        <ul>
            @foreach ($articulos as $articulo)
                <li>{{ $articulo }}</li>
            @endforeach
        </ul>
    </body>
</html>
```

En el caso anterior, la vista muestra el valor de la variable nombre e itera por el array articulos, por lo que será necesario proporcionarle dichos datos en la llamada al método view():

```php
Route::get('/articulos', function () {
    $articulos = array('Primero', 'Segundo','Tercero', 'Último');
    return view('articulos', [
        'nombre' => 'Ane Aranceta',
        'articulos' => $articulos
    ]);
})->name('articulos');
```

El motor de plantillas Blade permite el uso de todo tipo de estructuras:

```php
@for ($i = 0; $i < 10; $i++)
    El valor actual es {{ $i }}
@endfor

@foreach ($users as $user)
    <p>El usuario: {{ $user->id }}</p>
@endforeach

@forelse($users as $user)
    <li>{{ $user->name }}</li>
@empty
    <p>No users</p>
@endforelse

@while (true)
    <p>Eso es un bucle infinito.</p>
@endwhile

@if (count($articulos) === 1)
    Hay un artículo.
@elseif (count($articulos) > 1)
    Hay varios artículos.
@else
    No hay ninguno.
@endif

@unless (Auth::check())
    No estas autenticado.
@endunless
```

Puedes encontrar toda la información acerca de Blade en la documentación oficial.

#### Hands on! (3/7)
Actualiza las rutas de tu aplicación para que comiencen a devolver vistas al usuario: - /articulos: Devolverá una vista que muestre los artículos en una tabla. La primera columna tendrá un enlace a la ruta del artículo, utilizando su id. La segunda columna contendrá el título del artículo. - articulos/{id}: Devolverá una vista que contenga un párrafo con la siguiente frase: "Gracias por leer el artículo con id {id}". También tendrá un enlace para voler a cargar ruta que muestra todos los arículos.

Solución
/resources/views/articulos/index.blade.php:

```php
<html>
<head>
    <title>RevistApp</title>
</head>
<body>
    <h1>Revistapp</h1>
    <h2>Listado artículos:</h2>
    <table>
        <tr><th>Enlace</th><th>Título</th></tr>
        @foreach ($articulos as $articulo)
        <tr>
            <td><a href="{{ route('articulos.show', $articulo['id']) }}">Ver</a></td>
            <td>{{ ($articulo['titulo']) }}</td>
        </tr>
        @endforeach
    </ul>
</body>
</html>
```

/resources/views/articulos/show.blade.php:

```php
<html>
<head>
    <title>RevistApp</title>
</head>
<body>
    <h1>Revistapp</h1>
    <h2>Detalle del artículo:</h2>
    <p>Gracias por leer el artículo con id: {{ $id }}</p>
    <a href="{{ route('articulos.index') }}">Volver</a>
</body>
</html>
```

```php
// routes/web.php:

Route::get('/articulos', function () {
    $articulos = [
        ["id" => 1, "titulo" => "Primer artículo..."],
        ["id" => 2, "titulo" => "Segundo artículo..."],
        ["id" => 3, "titulo" => "Tercer artículo..."],
    ];
    return view('articulos.index', [
        'articulos' => $articulos
    ]);
})->name('articulos.index');

Route::get('articulos/{id}', function ($id) {
    return view('articulos.show', [
        'id' => $id
    ]);
})->name('articulos.show');
```

#### Paso 4 - Crear un Controlador
Los controladores contienen la lógica para atender las peticiones recibidas. En otras palabras, un Controlador es una clase que agrupa el comportamiento de todas las peticiones relacionadas con una misma entidad. Por ejemplo, el controlador ArticuloController será el encargado de definir el comportamiento de acciones como: creación de un artículo, modificación de un artículo, búsqueda de artículos, etc.

Creando un Controller
Existen dos formas de crear un controlador:

Crear manualmente una clase que extienda de la clase Controller de Laravel dentro del directorio app/Http/Controllers.
Utilizar el comando de Artisan make:controller. Artisan es una herramienta que nos provee Laravel para interactuar con la aplicación y ejecutar instrucciones.
En este caso escogeremos la segunda opción y ejecutaremos el siguiente comando:

```bash
php artisan make:controller ArticuloController
```

De este modo Laravel creará automáticamente un controlador vacío, que vendrá a ser una subclase de la clase Controller:.

```php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticuloController extends Controller
{
    //
}
```

Como hemos comentado antes los controladores son los responsables de procesar las peticiones entrantes y devolver al cliente la respuesta. Es decir, el router únicamente tendrá que invocar al controlador correspondiente para que atienda la petición entrante.

En el siguiente ejemplo se muestra cómo añadirle métodos que devuelvan vistas (como se puede ver en el caso de la función de nombre show()). Tal y como se puede apreciar, moveremos la lógica de la aplicación del router al controlador.

```php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;

class ArticuloController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return View
     */
    public function show($id)
    {
        return view('articulos.show', [
            'id' => $id
        ]);
    }
}
```

Es posible añadir más opciones al comando make:controller, aunque el único obligatorio es el nombre del controlador. por ejemplo el flag --resource al comando anterior, Artisan incluirá en el controlador creado los siete métodos REST más comunes: index(), create(), store(), show(), edit(), update(), destroy():

```bash
php artisan make:controller ArticuloController --resource
```
Cada método tiene su función:

Tipo	URI	Método	Acción
- GET	/articulos	index	Muestra todos los artículos
- GET	/articulos/create	create	Muestra el formulario para crear un artículo
- POST	/articulos	store	Guarda un nuevo artículo a partir de la información recibida
- GET	/articulos/{id}	show	Muestra la información de un artículo específico
- GET	/articulos/{id}/edit	edit	Muestra el formulario de edición de un artículo que ya existe
- PUT/PATCH	/articulos/{id}	update	Guardar los cambios del artículo indicado a partir de la información recibida
- DELETE	/articulos/{id}	destroy	Elimina el artículo con el ID indicado

Enrutar el Controlador
El siguiente paso es incluir en el Router las llamadas a los métodos del Controlador. En este caso crearemos las siguientes como ejemplo:

```php
use App\Http\Controllers\ArticuloController;

Route::get('articulos/', [ArticuloController::class, 'index'])->name('articulos.index');
Route::get('articulos/{id}', [ArticuloController::class, 'show'])->name('articulos.show');
Route::get('articulos/create', [ArticuloController::class, 'create'])->name('articulos.create');
Route::post('articulos/', [ArticuloController::class, 'store'])->name('articulos.store');
```

De esta forma direccionaremos las peticiones a los métodos de los controladores. Recuerda que el router no debe incluir ninguna lógica de la aplicación, únicamente redireccionar las peticiones a los controladores.
Existe también otra forma más rápida para generar automáticamente las rutas a todos los métodos de nuestro controlador:

```php
Route::resource('articulos', ArticuloController::class);
```

Si ejecutamos el comando `php artisan route:list` podemos comprobar cómo ya disponemos de todas las rutas a nuestro recurso y que cada una apunta al método correspondiente en el controlador.

Esta opción de Route::resource también ofrece la posibilidad de generar únicamente las rutas que le indiquemos. El siguiente ejemplo muestra como generar únicamene las rutas index y create utilizando el método only():

```php
Route::resource('articulos', ArticuloController::class)->only([
    'index', 'create'
]);
```

#### Hands on! (4/7)
Crea un controlador llamado ArticuloController.php y mueve la lógica de las dos rutas del router articulos/ y articulos/{id} al nuevo controlador.

Solución
`/App/Http/Controllers/ArticuloController.php:`

```php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ArticuloController extends Controller
{

    public function index()
    {
        $articulos = [
            ["id" => 1, "titulo" => "Primer artículo..."],
            ["id" => 2, "titulo" => "Segundo artículo..."],
            ["id" => 3, "titulo" => "Tercer artículo..."],
        ];
        return view('articulos.index', [
            'articulos' => $articulos
        ]);
    }

    public function show($id)
    {
        return view('articulos.show', [
            'id' => $id
        ]);
    }
}
```
El router pasará a indicar el controlador y el método que se encargará de cada petición:

```php
use App\Http\Controllers\ArticuloController;

Route::get('articulos', [ArticuloController::class, 'index'])->name('articulos.index');
Route::get('articulos/{id}', [ArticuloController::class, 'show'])->name('articulos.show');
```

### Paso 5 - Crear la Migración (Migration)
Las Migraciones (Migrations) se utilizan para construir el esquema de la base de datos, es decir, crear y modificar las tablas que utilizará nuestra aplicación. Ejecuta el siguiente comando de Artisan para crear una nueva Migración para una tabla que llamaremos "articulos".

```bash
php artisan make:migration create_articulos_table --create=articulos
```
Laravel creará una nueva migración automáticamente en el directorio database/migrations. El nombre del archivo creado será el indicado en el comando anterior, en este caso create_articulos_table, precedido por un timestamp, por ejemplo: `2022_12_21_162755_create_articulos_table.php`.

El contenido de la clase creada será el siguiente:

```php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articulos');
    }
};
```
Tal y como puedes deducir del código anterior, una migración contiene 2 métodos:

`up()`: se utiliza para crear nuevas tablas, columnas o índices a la base de datos.
`down()`: se utiliza para revertir operaciones realizadas por el método up().
El siguiente paso es implementar el método up() para que cree las columnas tal y como queremos:

```php
public function up()
{
    Schema::create('articulos', function (Blueprint $table) {
        // Completar con los campos que queremos que contenta la tabla 'articulos':
        $table->id(); # Columna de tipo integer autoincremental (equivalente a UNSIGNED INTEGER)
        $table->string('titulo'); # Columna de tipo string (equivalente a VARCHAR)
        $table->text('contenido'); # Columna de tipo text (equivalente a TEXT)
        $table->timestamps(); # Crea las columnas created_at y updated_at de tipo TIMESTAMP.
    });
}

/**
 * Reverse the migrations.
 *
 * @return void
 */
public function down()
{
    Schema::dropIfExists('articulos');
}
```

Aparte de `id()`, `string()` o `integer()`, existen una gran variedad de tipos de columnas disponibles para definir las tablas. Puedes encontrarlas en la documentación oficial.

Una vez tenemos definida una migración, solo quedará ejecutarla para que así se ejecute en nuestra base de datos y aplique los cambios indicados. Para ejecutar las migraciones simplemente lanza el comando migrate de Artisan:

```bash
php artisan migrate
```

#### Hands on! (5/7)
Crea una migración para una tabla llamada articulos siguiendo los pasos anteriormente descritos. Completa la función up() para definir la tabla y lanza la migración.

### Paso 7 - Crear un Modelo
Laravel incluye por defecto Eloquent ORM, el cual hace de la interacción con la base de datos una tarea fácil. Tal y como dice la documentación oficial:

Each database table has a corresponding "Model" which is used to interact with that table. Models allow you to query for data in your tables, as well as insert new records into the table.

En otras palabras, cada tabla de la base de datos corresponde a un Modelo, el cual permite ejecutar operaciones sobre esa tabla (insertar o leer registros por ejemplo). Este patrón es conocido como Active Record Pattern.

El nombre del modelo será la forma singular del nombre asignado a la tabla de la base de datos. Por ejemplo: User será el modelo correspondiente a la tabla users.

Creando un Modelo
Vamos a crear un Modelo:

```bash
php artisan make:model Articulo
```

El comando anterior ha creado una clase llamada Articulo en el directorio app/Models (es el directorio por defecto para los modelos de Eloquent a partir de Laravel 8).

```
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    //
}
```

Por defecto un modelo de Eloquent almacena los registros en una tabla con el mismo nombre pero en plural. En este caso, Articulo interactuará con la tabla de la base de datos llamada articulos.

Consultando datos de la base de datos
Los modelos de Eloquent se pueden utilizar para recuperar información de las tablas relacionadas con ese modelo. Proporcionan métodos como los siguientes:

```php
use App\Models\Articulo;

// Recupera todos los modelos
$articulos = Articulo::all();

// Recupera un modelo a partir de su clave
$articulo = Articulo::find(1);

// Recupera el primer modelo que cumpla con los criterios indicados
$articulos = Articulo::where('active', 1)->first();

// Recupera los modelos que cumplan con los criterios indicados y de la forma indicada:
$articulos = Articulo::where('active', 1)
               ->orderBy('titulo', 'desc')
               ->take(10)
               ->get();
```
Es posible iterar por la colección que devuelven los métodos all(), get() o first() de la siguiente forma:

```php
foreach ($articulos as $articulo) {
    echo $articulo->titulo;
}
```

Es importante mencionar que los métodos como all() o get no devuelven arrays típicos de PHP si no que devuelven una instancia de la clase Collection de Laravel. La diferencia es que estas colecciones tienen métodos adicionales que pueden ayudarnos en distintas situaciones, como por ejemplo: last(), count(), sort(), merge(), filter(), ... Puedes encontrar la lista de estos métodos de ayuda aquí: https://laravel.com/docs/12.x/collections#available-methods

Insertar información en la base de datos
El flujo de interacción que seguirá un usuario para insertar nuevos registros (artículos en nuestro caso) será el siguiente: 1. Acceder a la página con el formulario para enviar los datos. La ruta a la que deberá acceder será la siguiente: articulos/create/ 2. Enviar los datos del formulario. La ruta que recibirá los datos será la siguiente: articulos/ (POST). 3. Una vez enviados los datos, si todo ha ido bien nuestra aplicación le mostrará una nueva página.

Por lo tanto, será necesario crear dos nuevas rutas que invoquen a los métodos create() y store() del controlador.

```php
// /routes/web.php
use App\Http\Controllers\ArticuloController;

Route::get('articulos', [ArticuloController::class, 'index'])->name('articulos.index');
Route::get('articulos/create', [ArticuloController::class, 'create'])->name('articulos.create');
Route::get('articulos/{id}', [ArticuloController::class, 'show'])->name('articulos.show');
Route::post('articulos/', [ArticuloController::class, 'store'])->name('articulos.store');
```
La ruta empleada para mostrar el formulario será de tipo GET y la encargada de almacenar los datos será de tipo POST.

A continuación será necesario implementar los métodos del controlador:

```php
namespace App\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Http\Request;

class ArticuloController extends Controller
{

    public function create()
    {
        return view('articulos.create');
    }

    public function store(Request $request)
    {
        //Validar la petición:
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' =>'required|string'
        ]);
        /* Si la validación falla se redirigirá al usuario 
        a la página previa. Si pasa la validación, el controlador 
        continuará ejecutándose.
        */

        // Insertar el artículo en la BBDD tras su validación.
        Articulo::create($validated);

        return redirect(route('articulos.index'));
    }
}
```

En el método `store()` se ha incluido una validación de los datos. Para conocer más acerca de las validaciones automáticas que Laravel puede hacer por nosotros, puedes visitar este enlace.

Si no se quiere validar los datos (no recomendado) se podría haber creado el nuevo artículo de la siguiente forma:

```php
    ...

    public function store(Request $request)
    {

        $articulo = new Articulo;
        $articulo->titulo = request('titulo');
        $articulo->contenido = request('contenido');
        $articulo->save();

        // Otra alternativa para la inserción:
        $articulo = Articulo::create([
            'titulo' => request('titulo'),
            'contenido' => request('contenido')
         ]);

        return redirect(route('articulos.index'));
    }
}
```

En el ejemplo anterior se puede apreciar que el método request() permite acceder a los datos enviados en la petición.

Por último, quedaría crear la vista que muestre el formulario:

`/resources/views/articulos/create.blade.php`:

```php
<html>
<head>
    <title>RevistApp</title>
</head>
<body>
    <h1>Revistapp</h1>
    <h2>Crear un artículo:</h2>

    <form method="POST" action="{{ route('articulos.store') }}">
        @csrf
        <p><label>Titulo: </label><input type="text" name="titulo"></p>
        <p><label>Contenido: </label><input type="text" name="contenido"></p>
        <button type="submit">Crear</button>
    </form>
    <a href="{{ route('articulos.index') }}">Volver</a>
</body>
</html>
```
La directiva @csrf agrega un campo oculto con el Token de usuario para que Laravel nos proteja automáticamente de ataques XSS o de suplantación de identidad. Es necesario agregar siempre esta directiva.
Valores por defecto de un modelo
Al crear una instancia nueva de un modelo, los atributos de la instancia no tendrán ningún valor establecido. Si queremos definir valores por defecto, es posible hacerlo de la siguiente forma:

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'publicado' => false,
    ];
}
```

El ejemplo anterior muestra cómo establecer el atributo publicado como false cada vez que creemos un nuevo objeto de la clase Articulo.

Alternativas a Eloquent ORM
Laravel también permite interactuar con la base de datos mediante otras técnicas distintas a Eloquent ORM. Las alternativas disponibles son:

- Raw SQL: se trata de ejecutar sentencias SQL directamente contra la base de datos. Tienes toda la información disponible aquí.
- Query Builder: es una interfaz de comunicación con la base de datos que permite lanzar prácticamente cualquier consulta. A diferencia de la anterior, no es tan eficiente en cuanto a rendimiento pero aporta otras ventajas como la seguridad y abstracción de base de datos. Tienes toda la información disponible aquí.


#### Hands on! (6/7)
Crea una vista para crear nuevos artículos y los métodos create() y store() en los controladores. De esta forma tu aplicación ya podrá crear artículos sin problemas. Tienes las soluciones en los códigos proporcionados junto con la explicación.

#### Hands on! (7/7)
Actualiza el método index() para que utilice los datos almacenados en la base de datos. Puedes utilizar el método all() para recoger todos los artículos de la base de datos.
Actualiza el método show() para que muestre el título y el contenido del artículo seleccionado.
Añade también en la página incial un enlace a la página de creación de artículos.
Solución
/App/Http/Controllers/ArticuloController.php:

```php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulo;

class ArticuloController extends Controller
{

    public function index()
    {
        $articulos = Articulo::all();
        return view('articulos.index', [
            'articulos' => $articulos
        ]);
    }

    public function show($id)
    {
        $articulo = Articulo::find($id);
        return view('articulos.show', [
            'articulo' => $articulo
        ]);
    }

    ...
}
```

Actualiza la vista index.blade.php para que utilice los datos correctamente y muestre el nuevo enlace:

```php
<!DOCTYPE html>
<html>
<head>
    <title>RevistApp</title>
</head>
<body>
    <h1>Revistapp</h1>
    <h2>Listado artículos:</h2>
    <a href="{{ route('articulos.create') }}">Crear nuevo</a>
    <table>
        <tr><th>Enlace</th><th>Título</th></tr>
        @foreach ($articulos as $articulo)
        <tr>
            <td><a href="{{ route('articulos.show', $articulo->id) }}">Ver</a></td>
            <td>{{ ($articulo->titulo) }}</td>
        </tr>
        @endforeach
    </ul>
</body>
</html>
```
Actualiza la vista `show.blade.php` para que utilice los datos reales del artículo seleccionado:

```php
<!DOCTYPE html>
<html>
<head>
    <title>RevistApp</title>
</head>
<body>
    <h1>Revistapp</h1>
    <h2>Detalle del artículo:</h2>
    <p>Titulo: {{ $articulo->titulo }}</p>
    <p>Contenido: {{ $articulo->contenido }}</p>
    <a href="{{ route('articulos.index') }}">Volver</a>
</body>
</html>
```

### Borrado de registros
El borrado de registros es un tema que suele traer complicaciones, debido a que desde una página HTML solo es posible enviar peticiones GET y POST (desde formularios). Por lo tanto, las alternativas son las siguientes:

Crear una ruta de tipo GET específica para el borrado. Por ejemplo: `/articulos/destroy/{id}`
Hacer la petición de tipo DELETE utilizando AJAX y especificando en la llamada el tipo de método: `'type': 'DELETE'`
Emular la llamada DELETE mediante el campo oculto _method. Para ello podemos utilizar los helpers o directivas de Laravel en un formulario para notificar que se trata de una petición de tipo DELETE:

```php
<form method="POST">
     @csrf
     @method("DELETE")

     <button type="submit">Eliminar</button>
</form>
```
Siguiendo con la última de las opciones, quedaría añadir la ruta de borrado al router e implementar el método `destroy()` del controlador:

```php
// Nueva ruta en /router/web.php:
Route::delete('/articulos/{articulo}', [ArticuloController::class, 'destroy'])->name('articulos.destroy');

// Método destroy() en ArticuloContoller:
public function destroy(Articulo $articulo)
{
    $articulo->delete();
    return redirect(route('articulos.index'));
}
```

El borrado de un modelo se puede hacer de forma sencilla invocando al método `delete()` del modelo.

#### Hands on!
Añade la opción de eliminar cualquier artículo de la aplicación.

### Actualizar un modelo
Al igual que ocurre con la creación de un nuevo modelo, para actualizar un modelo los pasos a seguir son los siguientes:

Crear una vista que contenga el formulario de actualización. La ruta en este caso será `/articulos/{articulo}/edit`.
Crear dos rutas que llamen a los métodos **edit()** y **update()** del controlador: el método **edit()** será el encargado de cargar la vista de actualización (creada en el punto anterior) y el método **update()** recibirá los datos del formulario enviados por el usuario y actualizará el modelo en la base de datos.
Solución
Nueva vista `/resources/views/articulos/edit.blade.php`:

```php
<html>
<head>
    <title>RevistApp</title>
</head>
<body>
    <h1>Revistapp</h1>
    <h2>Crear un artículo:</h2>

    <form method="POST" action="{{ route('articulos.update', $articulo) }}">
        @csrf
        @method('PUT')
        <p><label>Titulo: </label><input type="text" name="titulo" value="{{ $articulo->titulo }}"></p>
        <p><label>Contenido: </label><input type="text" name="contenido" value="{{ $articulo->contenido }}"></p>
        <button type="submit">Crear</button>
    </form>
    <a href="{{ route('articulos.index') }}">Volver</a>

</body>
</html>
```
En el código anterior puede verse cómo se han asignado los valores actuales a los atributos value de cada campo. Se ha utilizado la directiva **@method('PUT')** de Laravel para indicar que el método de envío será de tipo **PUT**.
Nuevas rutas añadidas a `/routes/web.php`:

```php
Route::get('/articulos/{articulo}/edit', [ArticuloController::class, 'edit'])->name('articulos.edit');
Route::put('/articulos/{articulo}', [ArticuloController::class, 'update'])->name('articulos.update');
```
En cuanto a los métodos de `ArticuloController.php`, se utilizará el método `update()` para actualizar el modelo:

```php
public function edit(Articulo $articulo)
{
    return view('articulos.edit', [
        'articulo' => $articulo
    ]);
}

public function update(Request $request, Articulo $articulo)
{
    $validated = $request->validate([
        'titulo' => 'required|string|max:255',
        'contenido' =>'required|string'
    ]);
    $articulo->update($validated);
    return redirect(route('articulos.show', $articulo));
}
```
### Validación de formularios
Realizar la validación de los campos del formulario
Laravel permite validar cualquier campo enviado por un formulario mediante el método validate. Tal y como ya habíamos hecho anteriormente:

```php
public function store(Request $request)
{
    //Validar la petición:
    $validated = $request->validate([
        'titulo' => 'required|string|max:255',
        'contenido' =>'required|string'
    ]);

    Articulo::create($validated);

    return redirect(route('articulos.index'));
}
```

Si la validación pasa correctamente el código seguirá ejecutándose de forma normal y corriente. Pero si la validación falla, se redirigirá al usuario a la página desde la que se ha realizado el envío del formulario.

Puedes ver todas las reglas de validación disponibles aquí.

Mostrar los errores en la vista
Todas las vistas de Laravel tienen disponible la variable llamada $errors. En el siguiente ejemplo puede verse cómo mostrar al usuario todos los errores detectados en la validación:

```php
<h1>Crear artículo</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
```

#### Directiva @error
La directiva **@error** permite comprobar si un campo concreto ha tenido algún error, y en caso afirmativo mostrar el mensaje de error de dicho campo. Se utilizará de la siguiente manera:

```php
<p>
    <label>Titulo: </label>
    <input type="text" name="titulo">
    @error('titulo')
    <small style="color:red;">{{ $message }}</small>
    @enderror
</p>
<p>
    <label>Titulo: </label>
    <input type="text" name="contenido">
    @error('contenido')
    <small style="color:red;">{{ $message }}</small>
    @enderror
</p>
```

En caso de error se mostrará el contenido indicado entre las etiquetas @error y @enderror. Además la variable $message estará disponible entre dichas etiquetas e incluirá el mensaje de error.

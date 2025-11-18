
#### 1.- Crear una nueva migración

```bash
php artisan make:migration create_empleados_table
```
Editamos el archivo:
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /*
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
        */

        Schema::create('empleados', function (Blueprint $table) {

            $table->id('id_empleado'); // Esto crea un campo BigInt, UNSIGNED, AUTO_INCREMENT, PRIMARY KEY.

            // Campos de texto obligatorios
            $table->string('nombre', 50)->nullable(false); // VARCHAR(50) NOT NULL
            $table->string('apellidos', 100)->nullable(false); // VARCHAR(100) NOT NULL

            // Campos de texto únicos y obligatorios
            $table->string('email', 100)->unique()->nullable(); // VARCHAR(100) UNIQUE (Permite NULL, si quieres que sea NOT NULL, quita ->nullable())
            $table->string('dni', 15)->unique()->nullable(false); // VARCHAR(15) UNIQUE NOT NULL

            // Campos opcionales
            $table->char('sexo', 1)->nullable(); // CHAR(1)
            $table->tinyInteger('edad')->nullable(); // TINYINT

            // Campo de fecha
            $table->date('fecha_nacimiento')->nullable(); // DATE

            // Campo de texto largo/ruta
            $table->string('curriculum', 255)->nullable(); // VARCHAR(255)

            // Laravel usa created_at y updated_at por defecto. Si no los necesitas, puedes quitarlos.
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
```
#### 2.- Creamos una nuevo archivo de semillas
```bash
    php artisan make:seeder EmpleadosSeeder
```
Editamos el archivo
```php
<?php
// database\seeders\EmpleadosSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpleadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        INSERT INTO empleados (nombre, apellidos, email, dni, sexo, edad, fecha_nacimiento, curriculum)
        VALUES ('Ana', 'García Pérez', 'ana.garcia@empresa.com', '12345678A', 'F', 35, '1990-05-15', 'Líder de proyecto con 10 años de experiencia en desarrollo Java.');

        INSERT INTO empleados (nombre, apellidos, email, dni, sexo, edad, fecha_nacimiento, curriculum)
        VALUES ('Javier', 'López Ruiz', 'javier.lopez@empresa.com', '87654321B', 'M', 24, '2001-08-20', 'Desarrollador Junior enfocado en front-end y metodologías ágiles.');

        INSERT INTO empleados (nombre, apellidos, email, dni, sexo, edad, fecha_nacimiento, curriculum)
        VALUES ('Marta', 'Torres Sánchez', 'marta.torres@empresa.com', '11223344C', 'F', 42, '1983-02-10', 'Especialista en RRHH y gestión de talento.');
        */
        DB::table('empleados')->insert([
            // Primer registro
            [
                'nombre' => 'Ana',
                'apellidos' => 'García Pérez',
                'email' => 'ana.garcia@empresa.com',
                'dni' => '12345678A',
                'sexo' => 'F',
                'edad' => 35,
                'fecha_nacimiento' => '1990-05-15',
                'curriculum' => 'Líder de proyecto con 10 años de experiencia en desarrollo Java.'
            ],
            // Segundo registro
            [
                'nombre' => 'Javier',
                'apellidos' => 'López Ruiz',
                'email' => 'javier.lopez@empresa.com',
                'dni' => '87654321B',
                'sexo' => 'M',
                'edad' => 24,
                'fecha_nacimiento' => '2001-08-20',
                'curriculum' => 'Desarrollador Junior enfocado en front-end y metodologías ágiles.'
            ],
            // Tercer registro
            [
                'nombre' => 'Marta',
                'apellidos' => 'Torres Sánchez',
                'email' => 'marta.torres@empresa.com',
                'dni' => '11223344C',
                'sexo' => 'F',
                'edad' => 42,
                'fecha_nacimiento' => '1983-02-10',
                'curriculum' => 'Especialista en RRHH y gestión de talento.'
            ],
        ]);
    }
}
```


#### 3.- Añadimor el archivo 

Para que funcione automáticamente tenemos que añadirlo al final del método `run`.
```php
// database/seeders/DatabaseSeeder.php

public function run(): void
{
    //...Otro código

    $this->call([
        EmpleadosSeeder::class, // <-- Añadir esta línea
        // Otros seeders si los tienes
    ]);
}
```

####4. Ejecución (Paso Final)
Solo faltaría añadir el comando final para ejecutar ambos procesos (Migración y Seeder):

4.1.- Ejecución de Migración y Semillas 🚀
```Bash
php artisan migrate --seed
```
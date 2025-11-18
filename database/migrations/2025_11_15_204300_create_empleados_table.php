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
<?php

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

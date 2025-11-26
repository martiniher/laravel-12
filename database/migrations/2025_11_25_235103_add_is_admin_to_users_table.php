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
        Schema::table('users', function (Blueprint $table) {
            // Añade la columna 'is_admin' como BOOLEAN (true/false).
            // Por defecto, se establecerá en FALSE para todos los usuarios existentes.
            $table->boolean('is_admin')->default(false)->after('email'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Elimina la columna 'is_admin' si haces un rollback.
            $table->dropColumn('is_admin');
        });
    }
};

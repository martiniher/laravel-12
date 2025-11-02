<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmpleadoController;

Route::get('/empleado', [EmpleadoController::class, 'index']);

<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\CargoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController; // Agrega este use

Route::get('/', function () {
    return view('welcome');
});

// Ruta para el index de empleados
Route::get('/empleado', [EmpleadoController::class, 'index'])->name('empleado.index');
Route::get('/empleado/create', [EmpleadoController::class, 'create'])->name('empleado.create');
Route::post('/empleado', [EmpleadoController::class, 'store'])->name('empleado.store');
Route::get('/empleado/{id}/edit', [EmpleadoController::class, 'edit'])->name('empleado.edit');
Route::put('/empleado/{id}', [EmpleadoController::class, 'update'])->name('empleado.update');
Route::get('/empleado/{id}', [EmpleadoController::class, 'show'])->name('empleado.show');
Route::delete('/empleado/{id}', [EmpleadoController::class, 'destroy'])->name('empleado.destroy');
Route::get('/empleado/locales/{local}/areas', [AreaController::class, 'getAreas']);
Route::get('/empleado/areas/{area}/cargos', [CargoController::class, 'getCargos']);

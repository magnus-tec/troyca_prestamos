<?php

use App\Http\Controllers\RegistroSocioController;
use Illuminate\Support\Facades\Route;

//inicio  vistas blade
Route::get('/', function () {
    return view('inicio');
})->name('inicio');

Route::get('/registrar-socios', [RegistroSocioController::class, 'index'])->name('registrar-socios');
Route::get('/nuevo-registro', [RegistroSocioController::class, 'create'])->name('nuevo-registro');

Route::post('/registro/datos-personales', [RegistroSocioController::class, 'storeDatosPersonales'])->name('registro.datos-personales.store');
// Make sure you have this route for displaying the datos-personales form
Route::get('/registro/datos-personales', [RegistroSocioController::class, 'create'])->name('registro.datos-personales');

Route::get('/registro/direccion', [RegistroSocioController::class, 'create'])->name('registro.direccion');
Route::post('/registro/direccion', [RegistroSocioController::class, 'storeDireccion'])->name('registro.direccion.store');
Route::get('/registro/laboral', [RegistroSocioController::class, 'create'])->name('registro.laboral');
Route::post('/registro/laboral', [RegistroSocioController::class, 'storeLaboral'])->name('registro.laboral.store');
Route::get('/registro/conyuge', [RegistroSocioController::class, 'create'])->name('registro.conyuge');
Route::post('/registro/conyuge', [RegistroSocioController::class, 'storeConyuge'])->name('registro.conyuge.store');
Route::get('/registro/beneficiarios', [RegistroSocioController::class, 'create'])->name('registro.beneficiarios');
Route::post('/registro/beneficiarios', [RegistroSocioController::class, 'storeBeneficiarios'])->name('registro.beneficiarios.store');

Route::get('/registro/{registro}/edit', [RegistroSocioController::class, 'edit'])->name('registro.edit');
Route::put('/registro/{registro}', [RegistroSocioController::class, 'update'])->name('registro.update');
Route::delete('/registro/{registro}', [RegistroSocioController::class, 'destroy'])->name('registro.destroy');
Route::get('/registro/{registro}/pdf', [RegistroSocioController::class, 'generarPDF'])->name('registro.generar-pdf');

<?php

use App\Http\Controllers\AporteAhorrosController;
use App\Http\Controllers\EstadoDeCuentaController;
use App\Http\Controllers\RegistroSocioController;
use Illuminate\Support\Facades\Route;

//inicio  vistas blade
Route::get('/', function () {
    return view('inicio');
})->name('inicio');

Route::get('/registrar-socios', [RegistroSocioController::class, 'index'])->name('registrar-socios');
Route::get('/nuevo-registro', [RegistroSocioController::class, 'create'])->name('nuevo-registro');

// ESTADO DE CUENTA
Route::get('/estado-de-cuenta', [EstadoDeCuentaController::class, 'index'])->name('estado-de-cuenta');
Route::get('/nuevo-prestamo', [EstadoDeCuentaController::class, 'create'])->name('registrar-prestamo');
Route::post('/guardar-prestamo', [EstadoDeCuentaController::class, 'store'])->name('guardar-prestamo');
Route::get('/prestamo/{id}/pdf', [EstadoDeCuentaController::class, 'generarPDF'])->name('prestamo-pdf');
Route::get('/prestamo/{id}/pagar', [EstadoDeCuentaController::class, 'generarPago'])->name('prestamo-pagar');
Route::get('/prestamo/pagar-cuota/{id}', [EstadoDeCuentaController::class, 'pagarCuota'])->name('prestamo-pagarCuota');

// APORTE Y AHORROS

Route::get('/aporte-ahorros', [AporteAhorrosController::class, 'index'])->name('aporte-ahorros');
Route::get('/nuevo-aporte-ahorro', [AporteAhorrosController::class, 'create'])->name('registrar-aporte');
Route::post('/guardar-aporte-ahorro', [AporteAhorrosController::class, 'store'])->name('guardar-aporte');
Route::get('/aporte/totalAportes/{id}', [AporteAhorrosController::class, 'totalAportes'])->name('obtener-total-aporte');
Route::post('/guardar-aporte', [AporteAhorrosController::class, 'store'])->name('guardar-aporte');
Route::get('/aporte/{id}/pdf', [AporteAhorrosController::class, 'generarPDF'])->name('aporte-pdf');



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

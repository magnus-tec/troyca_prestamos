<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistroSocioController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API routes for RegistroSocio
Route::prefix('registro-socio')->group(function () {
    Route::get('/', [RegistroSocioController::class, 'index']);
    Route::post('/', [RegistroSocioController::class, 'storeDatosPersonales']);
    Route::get('/{registro}', [RegistroSocioController::class, 'show']);
    Route::put('/{registro}', [RegistroSocioController::class, 'update']);
    Route::delete('/register/{registro}', [RegistroSocioController::class, 'destroy'])->name('register.destroy');
});

// Additional API routes for specific sections
Route::post('/registro-socio/direccion', [RegistroSocioController::class, 'storeDireccion']);
Route::post('/registro-socio/laboral', [RegistroSocioController::class, 'storeLaboral']);
Route::post('/registro-socio/conyuge', [RegistroSocioController::class, 'storeConyuge']);
Route::post('/registro-socio/beneficiarios', [RegistroSocioController::class, 'storeBeneficiarios']);

// Generate PDF route
Route::get('/registro-socio/{registro}/pdf', [RegistroSocioController::class, 'generarPDF']);

// Ruta para editar
Route::get('/{id}/edit', [RegistroSocioController::class, 'edit'])->name('register.edit');


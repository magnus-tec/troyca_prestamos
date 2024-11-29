<?php

use Illuminate\Http\Request;
use App\Http\Controllers\RegistroSocioController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('register')->name('register.')->group(function () {
    // Rutas para procesar formularios
    Route::post('/store', [RegistroSocioController::class, 'store'])->name('store');
    Route::put('/{id}', [RegistroSocioController::class, 'update'])->name('update');
    Route::delete('/{id}', [RegistroSocioController::class, 'destroy'])->name('destroy');

    // Rutas para las pestañas del formulario
    Route::post('/datos-personales', [RegistroSocioController::class, 'storeDatosPersonales'])->name('datos-personales.store');
    Route::post('/direccion', [RegistroSocioController::class, 'storeDireccion'])->name('direccion.store');
    Route::post('/laboral', [RegistroSocioController::class, 'storeLaboral'])->name('laboral.store');
    Route::post('/conyuge', [RegistroSocioController::class, 'storeConyuge'])->name('conyuge.store');
    Route::post('/beneficiarios', [RegistroSocioController::class, 'storeBeneficiarios'])->name('beneficiarios.store');

    // Ruta para editar
    Route::get('/{id}/edit', [RegistroSocioController::class, 'edit'])->name('edit');
});
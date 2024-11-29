<?php

use App\Http\Controllers\RegistroSocioController;
use Illuminate\Support\Facades\Route;

//inicio  vistas blade
Route::get('/', function () {
    return view('inicio');
})->name('inicio');

// Route::get('/registrar-socios', function () {
//     return view('registrar-socios');
// })->name('registrar-socios');

Route::get('/productos', function () {
    return view('productos');
})->name('productos');

Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

// Modifica la ruta de nuevo-registro para redirigir a datos-personales
Route::get('/nuevo-registro', function () {
    return view('nuevo-registro', ['activeTab' => 'datos-personales']);
})->name('nuevo-registro');
Route::prefix('registro')->name('registro.')->group(function () {

// Agrupa todas las rutas relacionadas con el registro
    // Rutas GET
    Route::get('/datos-personales', function () {
        return view('nuevo-registro', ['activeTab' => 'datos-personales']);
    })->name('datos-personales');

    Route::get('/direccion', function () {
        return view('nuevo-registro', ['activeTab' => 'direccion']);
    })->name('direccion');

    Route::get('/laboral', function () {
        return view('nuevo-registro', ['activeTab' => 'laboral']);
    })->name('laboral');

    Route::get('/conyuge', function () {
        return view('nuevo-registro', ['activeTab' => 'conyuge']);
    })->name('conyuge');

    Route::get('/beneficiarios', function () {
        return view('nuevo-registro', ['activeTab' => 'beneficiarios']);
    })->name('beneficiarios');

    // Rutas POST
    Route::post('/datos-personales', function () {
        // Aquí irá la lógica para procesar el formulario
        return redirect()->route('registro.direccion');
    })->name('datos-personales.store');

    Route::post('/direccion', function () {
        // Aquí irá la lógica para procesar el formulario
        return redirect()->route('registro.laboral');
    })->name('direccion.store');

    Route::post('/laboral', function () {
        // Aquí irá la lógica para procesar el formulario
        return redirect()->route('registro.conyuge');
    })->name('laboral.store');

    Route::post('/conyuge', function () {
        // Aquí irá la lógica para procesar el formulario
        return redirect()->route('registro.beneficiarios');
    })->name('conyuge.store');

    Route::post('/beneficiarios', function () {
        // Aquí irá la lógica para procesar el formulario
        return redirect()->route('registrar-socios')
            ->with('success', 'Registro completado con éxito');
    })->name('beneficiarios.store');

   
});
Route::get('/registrar-socios', [RegistroSocioController::class, 'index'])->name('registrar-socios');
Route::get('/register/{id}/pdf', [RegistroSocioController::class, 'generarPDF'])->name('register.generar-pdf');

<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/votaciones', function () {
    return view('votaciones');
})->middleware(['auth', 'verified'])->name('votacion');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/candidato', [AdminController::class, 'candidatoInicio'])->name('candidato.inicio');
    Route::get('/votaciones', [AdminController::class, 'votacionesInicio'])->name('votaciones.inicio');
    Route::get('/estadisticas', [AdminController::class, 'estadisticasInicio'])->name('estadisticas.inicio');

    //Candidato
    Route::post('/candidato', [AdminController::class, 'candidatoNuevo'])->name('candidato.nuevo');
    Route::post('/candidato/{id}', [AdminController::class, 'candidatoVotar'])->name('candidato.votar');
    Route::get('/candidato/{id}', [AdminController::class, 'candidatoEliminar'])->name('candidato.eliminar');
    Route::post('/candidato/{id}', [AdminController::class, 'candidatoEditar'])->name('candidato.editar');

    //Votaciones
    Route::post('/votaciones', [AdminController::class, 'votacionesNuevo'])->name('votaciones.nuevo');
    Route::post('/votaciones/votar/{id}', [AdminController::class, 'votacionesVotar'])->name('votaciones.votar');
    Route::get('/votaciones/{id}', [AdminController::class, 'votacionesEliminar'])->name('votaciones.eliminar');
    Route::post('/votaciones/{id}', [AdminController::class, 'votacionesEditar'])->name('votaciones.editar');

});

require __DIR__.'/auth.php';

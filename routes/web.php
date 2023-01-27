<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\EjercicioController;
use App\Http\Controllers\RespuestaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::resource('grupos', GrupoController::class);
Route::resource('ejercicios', EjercicioController::class);
Route::resource('respuesta', RespuestaController::class);

Route::get('/leccion/1', function () {
    return view('lecciones.uno');
})->name('lecciones.uno');
Route::get('/leccion/2', function () {
    return view('lecciones.dos');
})->name('lecciones.dos');
Route::get('/leccion/3', function () {
    return view('lecciones.tres');
})->name('lecciones.tres');
Route::get('/leccion/4', function () {
    return view('lecciones.cuatro');
})->name('lecciones.cuatro');

Route::get('/ejercicios-condicionales', [EjercicioController::class, 'condicionales'])->name('ejercicios.condicionales');
Route::get('/ejercicios-for', [EjercicioController::class, 'for'])->name('ejercicios.for');
Route::get('/ejercicios-while', [EjercicioController::class, 'while'])->name('ejercicios.while');

Route::get('/ejercicios-resolver/{id}', [EjercicioController::class, 'resolver'])->name('ejercicios.resolver');
Route::post('/guardar-respuestas', [EjercicioController::class, 'guardarRespuestas'])->name('ejercicios.guardarRespuestas');
Route::put('/editar-respuestas', [EjercicioController::class, 'editarRespuestas'])->name('ejercicios.editarRespuestas');
Route::get('/mi-avance', [EjercicioController::class, 'miavance'])->name('miavance');


require __DIR__.'/auth.php';

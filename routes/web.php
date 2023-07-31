<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MensajeController;
use App\Http\Controllers\FinanzaController;
use App\Http\Controllers\CarruselController;
use App\Http\Controllers\PrestacioneController;
use App\Http\Controllers\TrabajoController;
use App\Http\Controllers\EscalafonController;
use App\Http\Controllers\ConvocatoriaController;
use App\Http\Controllers\ProcesoController;
use App\Http\Controllers\NormatecaController;
use App\Http\Controllers\PieController;
use App\Http\Controllers\Admin\CenController;
use App\Http\Controllers\SeccioneController;
use App\Http\Controllers\UbicacionController;
use App\Http\Controllers\ContactanoController;
use App\Http\Controllers\AcercaController;
use App\Http\Controllers\ComisioneController;


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

Route::get('/', [PostController::class, 'index'])->name('posts.index');

Route::get('posts/{post}',[PostController::class, 'show'])->name('posts.show');

Route::get('category/{category}',[PostController::class, 'category'])->name('posts.category');

Route::get('/enviar-mensaje',[MensajeController::class, 'mostrarFormulario'])->name('mensaje.formulario');

Route::post('',[MensajeController::class, 'enviarMensaje'])->name('mensaje.enviar');

Route::delete('', [MensajeController::class, 'destroy'])->name('mensaje.destroy');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::resource('finanza', FinanzaController::class);
Route::resource('carrusel', CarruselController::class);
Route::resource('prestacione', PrestacioneController::class);
Route::resource('trabajo', TrabajoController::class);
Route::resource('escalafon', EscalafonController::class);
Route::resource('convocatoria', ConvocatoriaController::class);
Route::resource('proceso', ProcesoController::class);
Route::resource('normateca', NormatecaController::class);
Route::resource('pie', PieController::class);
Route::resource('cen', CenController::class);
Route::resource('seccione', SeccioneController::class);
Route::resource('ubicacion', UbicacionController::class);
Route::resource('contactano', ContactanoController::class);
Route::resource('acerca', AcercaController::class);
Route::resource('comisione', ComisioneController::class);





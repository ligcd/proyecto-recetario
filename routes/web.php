<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IngredientesController;
use App\Http\Controllers\ComentariosController;
use App\Http\Controllers\RecetasController;
use App\Http\Controllers\MenuController;

use Illuminate\Auth\Events\Verified;

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
    return view('landing');
});

Route::get('/inicio', [MenuController::class, 'inicio'])->middleware('auth','verified');


Route::get('recetaimg-descarga/{receta}', [RecetasController::class, 'descargar'])->name('recetaimg.descarga');

Route::resource('ingredientes', IngredientesController::class); 

Route::resource('comentarios', ComentariosController::class);

Route::resource('recetas', RecetasController::class);

//Asegura que el usuario esté verificado y autenticado para crear menús personales
Route::resource('menus', MenuController::class)->middleware(['auth', 'verified']);

//Routhe::middleware->group(function()){}para aahrupar normas y agregarles el auth
#en action="/comentario"> esto en formulario, dentro del action tiene que coincidir. 

#Route::get('comentario/pdf', [ComentariosController::class, 'pdf'])->name('comentario.pdf');
#Route::post('/', [ComentariosControllerntroller::class, 'create'])

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArbitroController;

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

// Routes to login
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

//rutas para arbitro
Route::get('listarArbitro', [ArbitroController::class, 'listarArbitro']);//Listar
Route::post('crearArbitro', [ArbitroController::class, 'crearArbitro']);//Crear
Route::get('consultarArbitro/{id}', [ArbitroController::class, 'consultarArbitro']);//Consultar
Route::put('editarArbitro/{id}', [ArbitroController::class, 'editarArbitro']); // Editar

//rutas para categoria
//Route::get('listarCategoria', [categoriaController::class, 'listarCategoria']);//Listar
//Route::post('crearCategoria', [categoriaController::class, 'crearCategoria']);//Crear
//Route::get('consultarArbitro/{id}', [categoriaController::class, 'consultarCategoria']);//Consultar
//Route::put('editarArbitro/{id}', [categoriaController::class, 'editarCategoria']); // Editar






// Protected Routes.
Route::middleware(['auth:sanctum'])->group(function () {
    // route to login security
    Route::get('logout', [AuthController::class, 'logout']);
});

<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SportsController;
use App\Http\Controllers\sponsorsController;

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


// Protected Routes.
Route::middleware(['auth:sanctum'])->group(function () {
    // route to login security
    Route::get('logout', [AuthController::class, 'logout']);
});

//rutas Deporte
Route::post('crearDeporte', [SportsController::class, 'crearDeporte']);
Route::get('listarDeportes', [SportsController::class, 'listarDeportes']);
Route::get('consultarDeportes/{id}', [SportsController::class, 'consultarDeportes']);
Route::put('editarDeportes/{id}', [SportsController::class, 'editarDeportes']);
Route::put('desactivarDeporte/{id}', [SportsController::class, 'desactivarDeporte']);

//rutas Patrocinadores
Route::post('crearPatrocinador', [sponsorsController::class, 'crearPatrocinador']);
Route::get('listarPatrocinadores', [sponsorsController::class, 'listarPatrocinadores']);
Route::get('consultarPatrocinadores/{id}', [sponsorsController::class, 'consultarPatrocinadores']);
Route::put('editarPatrocinadores/{id}', [sponsorsController::class, 'editarPatrocinadores']);
Route::put('desactivarPatrocinador/{id}', [sponsorsController::class, 'desactivarPatrocinador']);

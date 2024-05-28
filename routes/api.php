<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArbitroController;
use App\Http\Controllers\categoriaController;
use App\Http\Controllers\EventosController;
use App\Http\Controllers\SportsController;
use App\Http\Controllers\sponsorsController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\OrganizacionesController;


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
Route::put('desactivarArbitro/{id}', [ArbitroController::class, 'desactivarArbitro']);

//rutas para categoria
Route::get('listCat', [categoriaController::class, 'listCat']);//Listar
Route::post('crearCat', [categoriaController::class, 'crearCat']);//Crear
Route::get('consultarCat/{id}', [categoriaController::class, 'consultarCat']);//Consultar
Route::put('editarCat/{id}', [categoriaController::class, 'editarCat']); // Editar

//Rutas eventos
Route::get('listarEventos', [EventosController::class, 'listarEventos']); // listar
Route::post('crearEventos', [EventosController::class, 'crearEventos']);//Crear
Route::get('consultarEvento/{id}', [EventosController::class, 'consultarEvento']);//Consultar
Route::put('editarEvento/{id}', [EventosController::class, 'editarEvento']); // Editar
Route::put('desactivarEvento/{id}', [EventosController::class, 'desactivarEvento']);


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

// Rutas para municipios
Route::get('listarMunicipios', [MunicipioController::class, 'listarMunicipios']); // Listar
Route::post('crearMunicipio', [MunicipioController::class, 'crearMunicipio']); // Crear
Route::get('consultarMunicipio/{id}', [MunicipioController::class, 'consultarMunicipio']); // Consultar
Route::put('editarMunicipio/{id}', [MunicipioController::class, 'editarMunicipio']); // Editar
Route::put('desactivarMunicipio/{id}', [MunicipioController::class, 'desactivarMunicipio']); // Desactivar

// Rutas para organizaciones
Route::get('listarOrganizaciones', [OrganizacionesController::class, 'index']); // Listar
Route::post('crearOrganizacion', [OrganizacionesController::class, 'store']); // Crear
Route::get('consultarOrganizacion/{id}', [OrganizacionesController::class, 'show']); // Consultar
Route::put('editarOrganizacion/{id}', [OrganizacionesController::class, 'update']); // Editar
Route::put('desactivarOrganizacion/{id}', [OrganizacionesController::class, 'desactivar']); // Desactivar


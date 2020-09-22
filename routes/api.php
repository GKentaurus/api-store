<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\DocumentTypeController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\PriceListController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserCategoryController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//   return $request->user();
// });

/**
 * Rutas de USUARIO
 * TODO   Retirar los metodos que no se ocupen
 */
Route::resource('/users', UserController::class, [
  'only' => [
    'index',
    'show',
    'store',
    'update',
    'destroy'
  ]
]);

/**
 * Rutas de TIPODOC
 * TODO   Retirar los metodos que no se ocupen
 * REVIEW Es necesario asignarle una ruta?
 */
Route::resource('/document-types', DocumentTypeController::class, [
  'only' => [
    'index',
    'show',
    'store',
    'update',
    'destroy'
  ]
]);

/**
 * Rutas de DIRECCION
 * TODO   Obtener el usuario por sesión activa al servidor
 */
Route::get('/users/{id_user}/addresses', [AddressController::class, 'index']);
Route::get('/users/{id_user}/addresses/{id_address}', [AddressController::class, 'show']);
Route::post('/users/{id_user}/addresses', [AddressController::class, 'store']);
Route::put('/users/{id_user}/addresses/{id_address}', [AddressController::class, 'update']);
Route::delete('/users/{id_user}/addresses/{id_address}', [AddressController::class, 'delete']);

/**
 * Rutas de CATEGORIA_USUARIO
 * TODO   Retirar los metodos que no se ocupen
 * REVIEW Es necesario asignarle una ruta?
 */
Route::resource('/user-categories', UserCategoryController::class, [
  'only' => [
    'index',
    'show',
    'store',
    'update',
    'destroy'
  ]
]);

/**
 * Rutas de LISTA_PRECIOS
 * TODO   Retirar los metodos que no se ocupen
 * REVIEW Es necesario asignarle una ruta?
 */
Route::resource('/price-lists', PriceListController::class, [
  'only' => [
    'index',
    'show',
    'store',
    'update',
    'destroy'
  ]
]);

/**
 * Rutas de LISTA-PRECIOS
 * TODO   Retirar los metodos que no se ocupen
 * REVIEW Es necesario asignarle una ruta?
 */
Route::resource('/prices', PriceController::class, [
  'only' => [
    'index',
    'show',
    'store',
    'update',
    'destroy'
  ]
]);

/**
 * Rutas de PRODUCTO
 * TODO   Retirar los metodos que no se ocupen
 */
Route::resource('/products', ProductController::class, [
  'only' => [
    'index',
    'show',
    'store',
    'update',
    'destroy'
  ]
]);

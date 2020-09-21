<?php

use App\Http\Controllers\CategoriaUsuarioController;
use App\Http\Controllers\DireccionController;
use App\Http\Controllers\ListaPreciosController;
use App\Http\Controllers\PreciosController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\TipoDocController;
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
Route::resource('usuario', UsuarioController::class, [
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
Route::resource('tipodoc', TipoDocController::class, [
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
Route::get('usuario/{usuario}/direccion', [DireccionController::class, 'index']);
Route::get('usuario/{usuario}/direccion/{direccion}', [DireccionController::class, 'show']);
Route::post('usuario/{usuario}/direccion', [DireccionController::class, 'store']);
Route::put('usuario/{usuario}/direccion/{direccion}', [DireccionController::class, 'update']);
Route::delete('usuario/{usuario}/direccion/{direccion}', [DireccionController::class, 'delete']);

/**
 * Rutas de CATEGORIA_USUARIO
 * TODO   Retirar los metodos que no se ocupen
 * REVIEW Es necesario asignarle una ruta?
 */
Route::resource('categoria-usuario', CategoriaUsuarioController::class, [
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
Route::resource('lista-precios', ListaPreciosController::class, [
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
Route::resource('lista-precios', ListaPreciosController::class, [
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
Route::resource('precios', PreciosController::class, [
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
Route::resource('producto', ProductoController::class, [
  'only' => [
    'index',
    'show',
    'store',
    'update',
    'destroy'
  ]
]);

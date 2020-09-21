<?php

use App\Http\Controllers\DireccionController;
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

Route::resource('usuario', UsuarioController::class, [
  'only' => [
    'index',
    'show',
    'store',
    'update',
    'destroy'
  ]
]);

Route::resource('tipodoc', TipoDocController::class, [
  'only' => [
    'index',
    'show',
    'store',
    'update',
    'destroy'
  ]
]);

Route::get('usuario/{usuario}/direccion', [DireccionController::class, 'index']);
Route::get('usuario/{usuario}/direccion/{direccion}', [DireccionController::class, 'show']);
Route::post('usuario/{usuario}/direccion', [DireccionController::class, 'store']);
Route::put('usuario/{usuario}/direccion/{direccion}', [DireccionController::class, 'update']);
Route::delete('usuario/{usuario}/direccion/{direccion}', [DireccionController::class, 'delete']);

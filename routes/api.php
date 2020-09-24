<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartContentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DocumentTypeController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\PriceListController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestController;
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

/**
 * Ruta de TEST Unlogged
 */
Route::get('/test/unlogged', [TestController::class, 'unlogged']);

/**
 * Rutas de Passport
 */
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:api')->group(function () {
  /**
   * Ruta de TEST Logged
   */
  Route::get('/test/logged', [TestController::class, 'logged']);

  /**
   * Rutas de USER
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
   * Rutas de DOCUMENT TYPE
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
   * Rutas de ADDRESS
   * TODO   Obtener el usuario por sesión activa al servidor
   */
  Route::get('/users/{id_user}/addresses', [AddressController::class, 'index']);
  Route::get('/users/{id_user}/addresses/{id_address}', [AddressController::class, 'show']);
  Route::post('/users/{id_user}/addresses', [AddressController::class, 'store']);
  Route::put('/users/{id_user}/addresses/{id_address}', [AddressController::class, 'update']);
  Route::delete('/users/{id_user}/addresses/{id_address}', [AddressController::class, 'delete']);

  /**
   * Rutas de USER CATEGORY
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
   * Rutas de PRICE LIST
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
   * Rutas de PRICE
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
   * Rutas de PRODUCT
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

  /**
   * Rutas de CART
   * TODO   Retirar los metodos que no se ocupen
   */
  Route::get('/users/{id_user}/cart', [CartController::class, 'index']);
  Route::get('/users/{id_user}/cart/{id_cart}', [CartController::class, 'show']);
  Route::post('/users/{id_user}/cart', [CartController::class, 'store']);
  Route::put('/users/{id_user}/cart/{id_cart}', [CartController::class, 'update']);
  Route::delete('/users/{id_user}/cart/{id_cart}', [CartController::class, 'delete']);

  /**
   * Rutas de CART CONTENT
   * TODO   Retirar los metodos que no se ocupen
   */
  Route::get('/users/{id_user}/cart/{id_cart}', [CartContentController::class, 'index']);
  Route::get('/users/{id_user}/cart/{id_cart}/{id_cart_content}', [CartContentController::class, 'show']);
  Route::post('/users/{id_user}/cart/{id_cart}', [CartContentController::class, 'store']);
  Route::put('/users/{id_user}/cart/{id_cart}/{id_cart_content}', [CartContentController::class, 'update']);
  Route::delete('/users/{id_user}/cart/{id_cart}/{id_cart_content}', [CartContentController::class, 'delete']);
});

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
});

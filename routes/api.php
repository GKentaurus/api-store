<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartContentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CompanyController;
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

// SECTION Authentication routes
/**
 * ANCHOR Passport routes
 */
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// !SECTION End Authentication routes

Route::middleware('auth:api')->group(function () {
  // SECTION Admin routes
  Route::prefix('admin')->group(function () {
    /**
     * ANCHOR USER routes
     */
    Route::get('users', [UserController::class, 'showAllUsers']);
    Route::get('users/{id}', [UserController::class, 'showUserByAdmin']);
    Route::post('users/', [UserController::class, 'storeUserByAdmin']);
    Route::put('users/{id}', [UserController::class, 'updateUserByAdmin']);
    Route::delete('users/{id}', [UserController::class, 'deleteUserByAdmin']);

    /**
     * ANCHOR COMPANY routes
     */
    Route::get('companies', [CompanyController::class, 'showAllCompanies']);
    Route::get('companies/{id}', [CompanyController::class, 'showCompanyByAdmin']);
    Route::post('companies', [CompanyController::class, 'storeCompanyByAdmin']);
    Route::put('companies/{id}', [CompanyController::class, 'updateCompanyByAdmin']);
    Route::delete('companies/{id}', [CompanyController::class, 'destroyCompanyByAdmin']);

    /**
     * ANCHOR ADDRESS routes
     */
    Route::get('addresses', [AddressController::class, 'showAllAddresses']);
    Route::get('addresses/{id}', [AddressController::class, 'showAddressByAdmin']);
    Route::post('addresses', [AddressController::class, 'storeAddressByAdmin']);
    Route::put('addresses/{id}', [AddressController::class, 'updateAddressByAdmin']);
    Route::delete('addresses/{id}', [AddressController::class, 'destroyAddressByAdmin']);

    /**
     * ANCHOR CART routes
     */
    Route::get('carts', [CartController::class, 'showAllCartsByAdmin']);
    Route::get('carts/{idCart}', [CartController::class, 'showCartByAdmin']);
    Route::get('carts/{idCart}/clear', [CartController::class, 'showCartByAdmin']);

    /**
     * ANCHOR PRODUCT routes
     */
    Route::get('products', [ProductController::class, 'showAllProductsByAdmin']);
    Route::get('products/{id}', [ProductController::class, 'showProductByAdmin']);
    Route::post('products', [ProductController::class, 'storeProductByAdmin']);
    Route::put('products/{id}', [ProductController::class, 'updateProductByAdmin']);
    Route::delete('products/{id}', [ProductController::class, 'destroyProductByAdmin']);
  });
  // !SECTION End Admin routes

  // SECTION Customer (users) routes
  Route::prefix('users')->group(function () {
    /**
     * ANCHOR USER routes
     */

    Route::get('own', [UserController::class, 'showCurrentUser']);
    Route::put('own', [UserController::class, 'updateCurrentUser']);
    Route::delete('own', [UserController::class, 'deleteCurrentUser']);

    /**
     * ANCHOR COMPANY routes
     */
    Route::get('companies', [CompanyController::class, 'showUserCompanies']);
    Route::get('companies/{id}', [CompanyController::class, 'showUserCompany']);
    Route::post('companies', [CompanyController::class, 'storeUserCompany']);
    Route::put('companies/{id}', [CompanyController::class, 'updateUserCompany']);
    Route::delete('companies/{id}', [CompanyController::class, 'deleteUserCompany']);

    /**
     * ANCHOR ADDRESS routes
     */
    Route::get('companies/{idCompany}/addresses', [AddressController::class, 'showAllCompaniesAddresses']);
    Route::get('companies/{idCompany}/addresses/{idAddress}', [AddressController::class, 'showCompanyAddress']);
    Route::post('companies/{idCompany}/addresses', [AddressController::class, 'storeCompanyAddress']);
    Route::put('companies/{idCompany}/addresses/{idAddress}', [AddressController::class, 'updateCompanyAddress']);
    Route::delete('companies/{idCompany}/addresses/{idAddress}', [AddressController::class, 'deleteCompanyAddress']);

    /**
     * ANCHOR CART routes
     */
    Route::get('cart', [CartController::class, 'showUserCart']);
    Route::delete('cart', [CartController::class, 'clearUserCart']);

    /**
     * ANCHOR PRODUCT routes
     */
    Route::get('products', [ProductController::class, 'showAllProducts']);
    Route::get('products/{id}', [ProductController::class, 'showSpecificProduct']);
    Route::put('products/{id}/add', [ProductController::class, 'addProductToCart']);
    Route::put('products/{id}/sub', [ProductController::class, 'substractProductToCart']);
  });
  // !SECTION End Customer (users) routes
});

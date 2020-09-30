<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DocumentTypeController;
use App\Http\Controllers\OrderStatusController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserCategoryController;

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
     * ANCHOR DOCUMENT TYPES routes
     */
    Route::get('document-types', [DocumentTypeController::class, 'showAllDocumentTypesByAdmin']);
    Route::get('document-types/{id}', [DocumentTypeController::class, 'showDocumentTypeByAdmin']);
    Route::post('document-types', [DocumentTypeController::class, 'storeDocumentTypeByAdmin']);
    Route::put('document-types/{id}', [DocumentTypeController::class, 'updateDocumentTypeByAdmin']);
    Route::delete('document-types/{id}', [DocumentTypeController::class, 'destroyDocumentTypeByAdmin']);

    /**
     * ANCHOR USER routes
     */
    Route::get('users', [UserController::class, 'showAllUsersByAdmin']);
    Route::get('users/{id}', [UserController::class, 'showUserByAdmin']);
    Route::post('users', [UserController::class, 'storeUserByAdmin']);
    Route::put('users/{id}', [UserController::class, 'updateUserByAdmin']);
    Route::delete('users/{id}', [UserController::class, 'deleteUserByAdmin']);

    /**
     * ANCHOR USER CATEGORY routes
     */
    Route::get('user-categories', [UserCategoryController::class, 'showAllUserCategoriesByAdmin']);
    Route::get('user-categories/{id}', [UserCategoryController::class, 'showUserCategoryByAdmin']);
    Route::post('user-categories', [UserCategoryController::class, 'storeUserCategoryByAdmin']);
    Route::put('user-categories/{id}', [UserCategoryController::class, 'updateUserCategoryByAdmin']);
    Route::delete('user-categories/{id}', [UserCategoryController::class, 'destroyUserCategoryByAdmin']);

    /**
     * ANCHOR COMPANY routes
     */
    Route::get('companies', [CompanyController::class, 'showAllCompaniesByAdmin']);
    Route::get('companies/{id}', [CompanyController::class, 'showCompanyByAdmin']);
    Route::post('companies', [CompanyController::class, 'storeCompanyByAdmin']);
    Route::put('companies/{id}', [CompanyController::class, 'updateCompanyByAdmin']);
    Route::delete('companies/{id}', [CompanyController::class, 'destroyCompanyByAdmin']);

    /**
     * ANCHOR ADDRESS routes
     */
    Route::get('addresses', [AddressController::class, 'showAllAddressesByAdmin']);
    Route::get('addresses/{id}', [AddressController::class, 'showAddressByAdmin']);
    Route::post('addresses', [AddressController::class, 'storeAddressByAdmin']);
    Route::put('addresses/{id}', [AddressController::class, 'updateAddressByAdmin']);
    Route::delete('addresses/{id}', [AddressController::class, 'destroyAddressByAdmin']);

    /**
     * ANCHOR CART routes
     */
    Route::get('carts', [CartController::class, 'showAllCartsByAdmin']);
    Route::get('carts/{idCart}', [CartController::class, 'showCartByAdmin']);
    Route::delete('carts/{idCart}/clear', [CartController::class, 'showCartByAdmin']);

    /**
     * ANCHOR PRODUCT routes
     */
    Route::get('products', [ProductController::class, 'showAllProductsByAdmin']);
    Route::get('products/{id}', [ProductController::class, 'showProductByAdmin']);
    Route::post('products', [ProductController::class, 'storeProductByAdmin']);
    Route::put('products/{id}', [ProductController::class, 'updateProductByAdmin']);
    Route::delete('products/{id}', [ProductController::class, 'destroyProductByAdmin']);

    /**
     * ANCHOR ORDER routes
     */
    Route::get('orders', [OrderController::class, 'showAllOrders']);

    /**
     * ANCHOR ORDER STATUS routes
     */
    Route::get('order-statuses', [OrderStatusController::class, 'showAllOrderStatusesByAdmin']);
    Route::get('order-statuses/{id}', [OrderStatusController::class, 'showOrderStatusByAdmin']);
    Route::post('order-statuses', [OrderStatusController::class, 'storeOrderStatusByAdmin']);
    Route::put('order-statuses/{id}', [OrderStatusController::class, 'updateOrderStatusByAdmin']);
    Route::delete('order-statuses/{id}', [OrderStatusController::class, 'destroyOrderStatusByAdmin']);

    /**
     * ANCHOR PAYMENT METHOD routes
     */
    Route::get('payment-methods', [PaymentMethodController::class, 'showAllPaymentMethodsByAdmin']);
    Route::get('payment-methods/{id}', [PaymentMethodController::class, 'showPaymentMethodByAdmin']);
    Route::post('payment-methods', [PaymentMethodController::class, 'storePaymentMethodByAdmin']);
    Route::put('payment-methods/{id}', [PaymentMethodController::class, 'updatePaymentMethodByAdmin']);
    Route::delete('payment-methods/{id}', [PaymentMethodController::class, 'destroyPaymentMethodByAdmin']);
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
    Route::delete('companies/{id}', [CompanyController::class, 'destroyUserCompany']);

    /**
     * ANCHOR ADDRESS routes
     */
    Route::get('companies/{company_id}/addresses', [AddressController::class, 'showAllCompanyAddresses']);
    Route::get('companies/{company_id}/addresses/{idAddress}', [AddressController::class, 'showCompanyAddress']);
    Route::post('companies/{company_id}/addresses', [AddressController::class, 'storeCompanyAddress']);
    Route::put('companies/{company_id}/addresses/{idAddress}', [AddressController::class, 'updateCompanyAddress']);
    Route::delete('companies/{company_id}/addresses/{idAddress}', [AddressController::class, 'destroyCompanyAddress']);

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

    /**
     * ANCHOR ORDER routes
     */
    Route::post('orders', [OrderController::class, 'createOrder']);
    Route::delete('orders', [OrderController::class, 'cancelOrder']);
  });
  // !SECTION End Customer (users) routes
});

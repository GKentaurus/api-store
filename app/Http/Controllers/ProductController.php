<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\PriceList;
use App\Models\UserCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\ApiController;
use App\Models\CartContent;

class ProductController extends ApiController
{
  // SECTION User methods
  /**
   * ANCHOR Display all products.
   *
   * @return \App\Traits\ApiResponse
   */
  public function showAllProducts()
  {
    $userCategory = auth('api')->user()->user_category_id;
    $priceList = UserCategory::all()->find($userCategory)->price_list_id;
    $products = PriceList::find($priceList)->products;

    return $this->showAll($products);
  }

  /**
   * ANCHOR Display specific product.
   *
   * @param int $product_id
   * @return \App\Traits\ApiResponse
   */
  public function showSpecificProduct($product_id)
  {
    $userCategory = auth('api')->user()->user_category_id;
    $priceList = UserCategory::all()->find($userCategory)->price_list_id;
    $products = PriceList::find($priceList)->products;

    return $this->showOne($products->find($product_id));
  }

  /**
   * ANCHOR Add product to user's cart.
   *
   * @param \Illuminate\Http\Request $request
   * @param int $product_id
   * @return \App\Traits\ApiResponse
   */
  public function addProductToCart(Request $request, $product_id)
  {
    $rules = [
      'quantityToAdd' => 'required|min:1'
    ];
    $this->validate($request, $rules);
    $form = $request->only(['quantityToAdd']);

    $qty = intval($form['quantityToAdd']);

    $user = auth('api')->user();

    $cart = Cart::firstOrCreate([
      'user_id' => $user->id,
      'active' => 1,
    ]);

    $cartContent = CartContent::firstOrNew([
      'cart_id' => $cart->id,
      'product_id' => $product_id,
    ]);

    $priceList = UserCategory::all()->find($user->user_category_id)->price_list_id;
    $product = PriceList::find($priceList)->products->find($product_id);

    $cartContent->quantity += $qty;
    $cartContent->price = $product->pivot->price;

    $cartContent->save();

    return $cartContent;
  }

  /**
   * ANCHOR Substract product to user's cart.
   *
   * @param \Illuminate\Http\Request $request
   * @param int $product_id
   * @return \App\Traits\ApiResponse
   */
  public function substractProductToCart(Request $request, $product_id)
  {
    $rules = [
      'quantityToSubstract' => 'required|min:1'
    ];
    $this->validate($request, $rules);
    $form = $request->only(['quantityToSubstract']);

    $qty = intval($form['quantityToSubstract']);

    $user = auth('api')->user();

    $cart = Cart::firstOrCreate([
      'user_id' => $user->id,
      'active' => 1,
    ]);

    $cartContent = CartContent::all()
      ->where('cart_id', $cart->id)
      ->where('product_id', $product_id)
      ->first();

    if (gettype($cartContent) != "NULL" && $cartContent->quantity > 0) {
      $cartContent->quantity -= $qty;
      $cartContent->save();

      if ($cartContent->quantity <= 0) {
        CartContent::destroy($cartContent->id);
      }
    } else {
      return $this->errorResponse('Producto no encontrado en Cart', 403);
    }

    return $cartContent;
  }
  // !SECTION End User methods

  // SECTION Admin methods
  /**
   * ANCHOR Display all products.
   *
   * @return \App\Traits\ApiResponse
   */
  public function showAllProductsByAdmin()
  {
    if (Gate::allows('isAdmin')) {
      $products = Product::all();

      foreach ($products as $product) {
        $product->priceLists;
      }

      return $this->showAll($products);
    } else {
      return $this->errorResponse('Acceso no autorizado', 403);
    }
  }

  /**
   * ANCHOR Store a new product
   *
   * @param \Illuminate\Http\Request $request
   * @return \App\Traits\ApiResponse
   */
  public function storeProductByAdmin(Request $request)
  {
    if (Gate::allows('isAdmin')) {
      $rules = [
        'model' => 'required|min:5',
        'description' => 'required|min:10',
        'barcode' => 'required|digits_between:7,15',
        'quantity' => 'required|numeric',
        'active' => 'required|numeric',
      ];

      $this->validate($request, $rules);

      $form = $request->only([
        'model',
        'description',
        'barcode',
        'quantity',
        'active',
      ]);

      $product = Product::create($form);

      return $this->showOne($product);
    } else {
      return $this->errorResponse('Acceso no autorizado', 403);
    }
  }

  /**
   * ANCHOR Show a new product
   *
   * @param int $product_id
   * @return \App\Traits\ApiResponse
   */
  public function showProductByAdmin($product_id)
  {
    if (Gate::allows('isAdmin')) {
      $product = Product::findOrFail($product_id);
      $product->priceLists;
      return $this->showOne($product);
    } else {
      return $this->errorResponse('Acceso no autorizado', 403);
    }
  }

  /**
   * ANCHOR Show a new product
   *
   * @param \Illuminate\Http\Request $request
   * @param int $product_id
   * @return \App\Traits\ApiResponse
   */
  public function updateProductByAdmin(Request $request, $product_id)
  {
    if (Gate::allows('isAdmin')) {
      $product = Product::findOrFail($product_id);
      $product->fill($request->only([
        'model',
        'description',
        'barcode',
        'quantity',
        'active',
      ]));

      $product->save();
      $product->priceLists;
      return $this->showOne($product);
    } else {
      return $this->errorResponse('Acceso no autorizado', 403);
    }
  }

  /**
   * ANCHOR Delete a new product
   *
   * @param int $product_id
   * @return \App\Traits\ApiResponse
   */
  public function destroyProductByAdmin($product_id)
  {
    if (Gate::allows('isAdmin')) {
      Product::destroy($product_id);
      return $this->successResponse('El productco ' . $product_id . ' ha sido eliminado.', 201);
    } else {
      return $this->errorResponse('Acceso no autorizado', 403);
    }
  }
  // !SECTION End Admin methods
}

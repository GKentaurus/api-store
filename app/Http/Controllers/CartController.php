<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartContent;
use Illuminate\Http\Request;

class CartController extends ApiController
{
  // SECTION User methods
  /**
   * ANCHOR Display the lastest cart for the user.
   *
   * @return \App\Traits\ApiResponse
   */
  public function showLastestCart()
  {
    $user = auth('api')->user()->id;

    $cart = Cart::all()
      ->where('idUser', $user)
      ->where('active', 1)
      ->sortByDesc('updated_at')
      ->first();

    $total = 0;
    foreach ($cart->cartContent as $product) {
      $total += $product->quantity * $product->price;
    }

    $cart['total'] = $total;

    return $this->showOne($cart);
  }
  // !SECTION End User methods

  // SECTION Admin methods
  /**
   * ANCHOR Display all carts.
   *
   * @return \App\Traits\ApiResponse
   */
  public function showAllCarts()
  {
    $cart = Cart::all();

    $counter = $cart->map(function ($item, $key) {
      $total = 0;
      foreach ($item->cartContent as $product) {
        $total += $product->quantity * $product->price;
      }

      $item['subtotal'] = $total;
      return $item;
    });

    return $counter;
  }

  /**
   * ANCHOR Display a specific carts.
   *
   * @return \App\Traits\ApiResponse
   */
  public function showSpecificCarts($id)
  {
    $cart = Cart::findOrFail($id);
    $total = 0;
    foreach ($cart->cartContent as $product) {
      $total += $product->quantity * $product->price;
    }
    $cart['total'] = $total;
    return $this->showOne($cart);
  }
  // !SECTION End Admin methods
}

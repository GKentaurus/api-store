<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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
  public function showAllCartsByAdmin()
  {
    if (Gate::allows('isAdmin')) {
      $cart = Cart::all();

      $carts = $cart->map(function ($item) {
        $total = 0;
        foreach ($item->cartContent as $product) {
          $total += $product->quantity * $product->price;
        }

        $item['subtotal'] = $total;
        return $item;
      });

      return $this->showAll($carts);
    } else {
      return $this->errorResponse('Acceso no autorizado', 403);
    }
  }

  /**
   * ANCHOR Display a specific carts.
   *
   * @return \App\Traits\ApiResponse
   */
  public function showSpecificCartsByAdmin($id)
  {
    if (Gate::allows('isAdmin')) {
      $cart = Cart::findOrFail($id);
      $total = 0;
      foreach ($cart->cartContent as $product) {
        $total += $product->quantity * $product->price;
      }
      $cart['total'] = $total;
      return $this->showOne($cart);
    } else {
      return $this->errorResponse('Acceso no autorizado', 403);
    }
  }
  // !SECTION End Admin methods
}

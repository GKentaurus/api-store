<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends ApiController
{
  // SECTION User methods
  /**
   * ANCHOR Create a new order from the current cart.
   *
   * @return \App\Traits\ApiResponse
   */
  public function createOrder()
  {
    $user = auth('api')->user()->id;

    $cart = Cart::firstOrCreate([
      'user_id' => $user,
      'active' => 1
    ]);

    $order = Order::firstOrCreate([
      'cart_id' => $cart->id,
      'order_status_id' => 1,
      'payment_method_id' => 1
    ]);

    $order->cart;

    return $this->showOne($order);
  }

  /**
   * ANCHOR Create a new order from the current cart.
   *
   * @return \App\Traits\ApiResponse
   */
  public function cancelOrder()
  {
    $user = auth('api')->user()->id;

    $cart = Cart::firstOrCreate([
      'user_id' => $user,
      'active' => 1
    ]);

    Order::where([
      'cart_id' => $cart->id,
      'order_status_id' => 1,
      'payment_method_id' => 1
    ])->delete();

    return $this->successResponse('La orden ha sido eliminada', 200);
  }
  // !SECTION End User methods

  // SECTION Admin methods
  /**
   * ANCHOR Get all orders
   *
   * @return \App\Traits\ApiResponser
   */
  public function showAllOrders()
  {
    return $this->showAll(Order::all());
  }
  // !SECTION End Admin methods
}

<?php

namespace App\Http\Controllers;

use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OrderStatusController extends ApiController
{
  // SECTION Admin methods
  /**
   * ANCHOR Show all Order statuses
   *
   * @return \App\Traits\ApiResponse
   */
  public function showAllOrderStatusesByAdmin()
  {
    if (Gate::allows('isAdmin')) {
      return $this->showAll(OrderStatus::all());
    } else {
      return $this->errorResponse(config('message.errors.unauthorized'), 403);
    }
  }

  /**
   * ANCHOR Show specific order status
   *
   * @param  int  $order_status_id
   * @return \App\Traits\ApiResponse
   */
  public function showOrderStatusByAdmin($order_status_id)
  {
    if (Gate::allows('isAdmin')) {
      return $this->showOne(OrderStatus::findOrFail($order_status_id));
    } else {
      return $this->errorResponse(config('message.errors.unauthorized'), 403);
    }
  }

  /**
   * ANCHOR Create an store a new order status
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \App\Traits\ApiResponse
   */
  public function storeOrderStatusByAdmin(Request $request)
  {
    if (Gate::allows('isAdmin')) {
      $rules = [
        'sortOrder' => 'required|numeric',
        'name' => 'required|min:3',
        'active' => 'required',
      ];

      $this->validate($request, $rules);

      $form = $request->only([
        'sortOrder',
        'name',
        'active',
      ]);

      $orderStatus = OrderStatus::create($form);

      return $this->showOne($orderStatus);
    } else {
      return $this->errorResponse(config('message.errors.unauthorized'), 403);
    }
  }

  /**
   * ANCHOR Update a specific order status
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $order_status_id
   * @return \App\Traits\ApiResponse
   */
  public function updateOrderStatusByAdmin(Request $request, $order_status_id)
  {
    if (Gate::allows('isAdmin')) {
      $orderStatus = OrderStatus::finOrFail($order_status_id);
      $orderStatus->fill($request->only([
        'sortOrder',
        'name',
        'active',
      ]));

      $orderStatus->save();

      return $this->showOne($orderStatus);
    } else {
      return $this->errorResponse(config('message.errors.unauthorized'), 403);
    }
  }

  /**
   * ANCHOR Delete a specific order status
   *
   * @param  int  $order_status_id
   * @return \App\Traits\ApiResponse
   */
  public function destroyOrderStatusByAdmin($order_status_id)
  {
    if (Gate::allows('isAdmin')) {
      OrderStatus::destroy($order_status_id);
      return $this->successResponse(config('message.actions.delete'), 200);
    } else {
      return $this->errorResponse(config('message.errors.unauthorized'), 403);
    }
  }
  // !SECTION End Action methods
}

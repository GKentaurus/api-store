<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Gate;

class PaymentMethodController extends ApiController
{
  // SECTION Admin methods
  /**
   * ANCHOR Show all payment method
   *
   * @return \App\Traits\ApiResponse
   */
  public function showAllPaymentMethodsByAdmin()
  {
    if (Gate::allows('isAdmin')) {
      return $this->showAll(PaymentMethod::all());
    } else {
      return $this->errorResponse(config('message.errors.unauthorized'), 403);
    }
  }

  /**
   * ANCHOR Show specific payment method
   *
   * @param  int $payment_method_id
   * @return \App\Traits\ApiResponse
   */
  public function showPaymentMethodByAdmin($payment_method_id)
  {
    if (Gate::allows('isAdmin')) {
      return $this->showOne(PaymentMethod::findOrFail($payment_method_id));
    } else {
      return $this->errorResponse(config('message.errors.unauthorized'), 403);
    }
  }

  /**
   * ANCHOR Create an store a new payment method
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \App\Traits\ApiResponse
   */
  public function storePaymentMethodByAdmin(Request $request)
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

      $paymentMethod = PaymentMethod::create($form);

      return $this->showOne($paymentMethod);
    } else {
      return $this->errorResponse(config('message.errors.unauthorized'), 403);
    }
  }

  /**
   * ANCHOR Update a specific payment method
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int $payment_method_id
   * @return \App\Traits\ApiResponse
   */
  public function updatePaymentMethodByAdmin(Request $request, $payment_method_id)
  {
    if (Gate::allows('isAdmin')) {
      $paymentMethod = PaymentMethod::finOrFail($payment_method_id);
      $paymentMethod->fill($request->only([
        'sortOrder',
        'name',
        'active',
      ]));

      $paymentMethod->save();

      return $this->showOne($paymentMethod);
    } else {
      return $this->errorResponse(config('message.errors.unauthorized'), 403);
    }
  }

  /**
   * ANCHOR Delete a specific payment method
   *
   * @param  int $payment_method_id
   * @return \App\Traits\ApiResponse
   */
  public function destroyPaymentMethodByAdmin($payment_method_id)
  {
    if (Gate::allows('isAdmin')) {
      PaymentMethod::destroy($payment_method_id);
      return $this->successResponse(config('message.actions.delete'), 200);
    } else {
      return $this->errorResponse(config('message.errors.unauthorized'), 403);
    }
  }
  // !SECTION End Action methods
}

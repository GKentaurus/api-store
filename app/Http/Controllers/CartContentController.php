<?php

namespace App\Http\Controllers;

use App\Models\CartContent;
use Illuminate\Http\Request;

class CartContentController extends ApiController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index($cart)
  {
    return $this->showAll(CartContent::all()->where('idCart', $cart));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $rules = [
      'idCart' => 'required',
      'idProduct' => 'required',
      'quantity' => 'required',
      'price' => 'required',
    ];

    $this->validate($request, $rules);
    $form = $request->all();
    $cartContent = CartContent::create($form);

    return $this->showOne($cartContent);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($cartContent, $cart)
  {
    return $this->showOne(CartContent::findOfFail($cartContent)->where('idCart', $cart));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $cartContent)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($cartContent, $cart)
  {
    if (CartContent::findOrFail($cartContent)->idCart == $cart) {
      CartContent::destroy($cartContent);
    } else {
      return $this->errorResponse('El objeto requerido del carrito no corresponde al carro indicado', 401);
    }
  }
}

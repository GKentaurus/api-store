<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\Product;

class ProductController extends ApiController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return $this->showAll(Product::all());
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
      'model' => 'required|min:5',
      'description' => 'required|min:5|max:255',
      'barcode' => 'required|digits_between:7,15',
      'quantity' => 'required',
      'active' => 'required',
    ];

    $this->validate($request, $rules);
    $form = $request->all();
    $product = Product::create($form);

    return $this->showOne($product);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($product)
  {
    return $this->showOne(Product::findOrFail($product));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $product)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($product)
  {
    Product::destroy($product);
  }
}

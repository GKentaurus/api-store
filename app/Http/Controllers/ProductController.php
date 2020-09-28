<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\Price;
use App\Models\PriceList;
use App\Models\Product;
use App\Models\UserCategory;

class ProductController extends ApiController
{
  // SECTION User methods
  /**
   * ANCHOR Display all carts.
   *
   * @return \App\Traits\ApiResponse
   */
  public function showAllProducts()
  {
    $userCategory = auth('api')->user()->category;
    $priceList = UserCategory::findOrFail($userCategory)->idPriceList;

    $products = Product::all();

    return $products;
  }
  // !SECTION End User methods

  // SECTION Admin methods

  // !SECTION End Admin methods
}

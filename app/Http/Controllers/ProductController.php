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
   * ANCHOR Display all products.
   *
   * @return \App\Traits\ApiResponse
   */
  public function showAllProducts()
  {
    $userCategory = auth('api')->user()->user_category_id;
    $priceList = UserCategory::all()->find($userCategory)->price_list_id;
    $products = PriceList::find($priceList)->products;

    return $products;
  }
  // !SECTION End User methods

  // SECTION Admin methods

  // !SECTION End Admin methods
}

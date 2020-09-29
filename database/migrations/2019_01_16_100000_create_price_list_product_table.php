<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriceListProductTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('price_list_product', function (Blueprint $table) {
      $table->id();
      $table->double('price');
      $table->timestamps();
      $table->softDeletes();
      $table->foreignId('product_id')->constrained('products');
      $table->foreignId('price_list_id')->constrained('price_lists');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('prices');
  }
}

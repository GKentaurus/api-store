<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartContentsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('cart_contents', function (Blueprint $table) {
      $table->id();
      $table->foreignId('cart_id')->constrained('carts')->require();
      $table->foreignId('product_id')->constrained('products')->require();
      $table->integer('quantity')->require();
      $table->double('price')->require();
      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('cart_contents');
  }
}

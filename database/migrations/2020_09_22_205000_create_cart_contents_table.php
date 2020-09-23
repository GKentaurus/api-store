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
    if (!Schema::hasTable('cart_contents') || Config::get('app.dropCartContents', true)) {
      Schema::create('cart_contents', function (Blueprint $table) {
        $table->id();
        $table->foreignId('idCart')->constrained('carts')->require();
        $table->foreignId('idProduct')->constrained('products')->require();
        $table->integer('quantity')->require();
        $table->double('price')->require();
        $table->timestamps();
        $table->softDeletes();
      });
    }
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    if (Config::get('app.dropCartContents', false)) {
      Schema::dropIfExists('cart_contents');
    }
  }
}

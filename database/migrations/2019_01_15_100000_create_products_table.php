<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    if (!Schema::hasTable('products') || Config::get('app.dropProducts', true)) {
      Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('model')->unique();
        $table->string('description');
        $table->string('barcode')->unique();
        $table->integer('quantity');
        $table->tinyInteger('active');
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
    if (Config::get('app.dropProducts', false)) {
      Schema::dropIfExists('products');
    }
  }
}

<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    if (!Schema::hasTable('prices') || Config::get('app.dropPrices', true)) {

      Schema::create('prices', function (Blueprint $table) {
        $table->id();
        $table->foreignId('idProduct')->constrained('products');
        $table->foreignId('idPriceList')->constrained('price_lists')->default(1);
        $table->double('price');
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
    if (Config::get('app.dropPrices', false)) {
      Schema::dropIfExists('prices');
    }
  }
}

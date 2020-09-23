<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriceListsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    if (!Schema::hasTable('price_lists') || Config::get('app.dropPriceLists', true)) {
      Schema::create('price_lists', function (Blueprint $table) {
        $table->id();
        $table->string('listName')->require()->unique();
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
    if (Config::get('app.dropPriceLists', false)) {
      Schema::dropIfExists('price_lists');
    }
  }
}

<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCategoriesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    if (!Schema::hasTable('user_categories') || Config::get('app.dropUserCategories', true)) {
      Schema::create('user_categories', function (Blueprint $table) {
        $table->id();
        $table->string('categoryName')->require();
        $table->foreignId('idPriceList')->constrained('price_lists');
        $table->tinyInteger('active')->default(1)->require();
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
    if (Config::get('app.dropUserCategories', false)) {
      Schema::dropIfExists('user_categories');
    }
  }
}

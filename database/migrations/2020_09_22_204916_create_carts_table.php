<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    if (!Schema::hasTable('carts') || Config::get('app.dropCarts', true)) {

      Schema::create('carts', function (Blueprint $table) {
        $table->id();
        $table->foreignId('idUser')->constrained('users');
        $table->tinyInteger('active')->default(1);
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
    if (Config::get('app.dropCarts', false)) {
      Schema::dropIfExists('carts');
    }
  }
}

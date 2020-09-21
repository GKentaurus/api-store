<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreciosTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('precios', function (Blueprint $table) {
      $table->id();
      $table->foreignId('idProducto')->constrained('productos');
      $table->foreignId('idListaPrecios')->constrained('lista_precios');
      $table->string('precio');
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
    Schema::dropIfExists('precios');
  }
}

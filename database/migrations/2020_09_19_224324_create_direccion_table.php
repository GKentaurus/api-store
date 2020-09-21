<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDireccionTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('direccion', function (Blueprint $table) {
      $table->id();
      $table->foreignId('idUsuario')->constrained('users');
      $table->string('nombreDireccion')->require();
      $table->string('dirLinea1')->require();
      $table->string('dirLinea2');
      $table->string('ciudad')->require();
      $table->string('departamento')->require();
      $table->string('pais')->require();
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
    Schema::dropIfExists('direccion');
  }
}

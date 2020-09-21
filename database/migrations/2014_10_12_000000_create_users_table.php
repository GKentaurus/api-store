<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('pNombre');
      $table->string('sNombre');
      $table->string('pApelido');
      $table->string('sApelido');
      $table->unsignedSmallInteger('tipoDoc');
      $table->string('numDoc')->unique();
      $table->unsignedSmallInteger('digVerif');
      $table->string('email')->unique();
      $table->timestamp('email_verified_at')->nullable();
      $table->string('contrasena');
      $table->string('telefPpal');
      $table->rememberToken();
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
    Schema::dropIfExists('users');
  }
}

<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
      $table->bigIncrements('id');
      $table->string('firstName')->require();
      $table->string('lastName')->require();
      $table->string('mobileNumber')->require();
      $table->tinyInteger('age')->require();
      $table->string('email')->unique()->require();
      $table->timestamp('email_verified_at')->nullable();
      $table->tinyInteger('sendEmails')->default(1)->require();
      $table->string('password')->require();
      $table->tinyInteger('termsAndConditions');
      $table->foreignId('user_category_id')->constrained('user_categories')->default(1);
      $table->tinyInteger('isAdmin')->default(0)->require();
      $table->tinyInteger('active')->default(1)->require();
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

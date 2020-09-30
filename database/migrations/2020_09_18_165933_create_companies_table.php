<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('companies', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->foreignId('user_id')->constrained('users');
      $table->string('name')->require();
      $table->foreignId('documentType')->constrained('document_types');
      $table->string('documentNumber')->require();
      $table->string('verificationDigit')->require();
      $table->string('billingEmail')->require();
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
    Schema::dropIfExists('companies');
  }
}

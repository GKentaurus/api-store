<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    if (!Schema::hasTable('addresses') || Config::get('app.dropAddresses', true)) {
      Schema::create('addresses', function (Blueprint $table) {
        $table->id();
        $table->foreignId('idCompany')->constrained('companies');
        $table->string('addressName')->require();
        $table->string('addressLine1')->require();
        $table->string('addressLine2');
        $table->string('city')->require();
        $table->string('state')->require();
        $table->string('country')->require();
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
    if (Config::get('app.dropAddresses', false)) {
      Schema::dropIfExists('addresses');
    }
  }
}

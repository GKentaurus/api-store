<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentTypesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    if (!Schema::hasTable('document_types') || Config::get('app.dropDocumentTypes', true)) {
      Schema::create('document_types', function (Blueprint $table) {
        $table->id();
        $table->string('abbreviation')->unique();
        $table->string('documentDescription');
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
    if (Config::get('app.dropDocumentTypes', false)) {
      Schema::dropIfExists('document_types');
    }
  }
}

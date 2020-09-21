<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriaUsuarioTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    if (!Schema::hasTable('categoria_usuario')) {
      Schema::create('categoria_usuario', function (Blueprint $table) {
        $table->id();
        $table->string('nombreCategoria')->require();
        $table->foreignId('idListaPrecios')->constrained('lista_precios');
        $table->boolean('activo')->require();
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
    // Schema::dropIfExists('categoria_clientes');
  }
}

<?php

namespace Database\Seeders;

use App\Models\CategoriaUsuario;
use App\Models\Direccion;
use App\Models\ListaPrecios;
use App\Models\Precios;
use App\Models\Producto;
use App\Models\TipoDoc;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    TipoDoc::factory()->times(4)->create();
    ListaPrecios::factory()->times(5)->create();
    Producto::factory()->times(50)->create();
    Precios::factory()->times(50)->create();
    CategoriaUsuario::factory()->times(5)->create();
    User::factory()->times(15)->create();
    Direccion::factory()->times(30)->create();
  }
}

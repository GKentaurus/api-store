<?php

namespace Database\Seeders;

use App\Models\Cart;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
  /**
   * Run the Cart database seeds.
   *
   * @return void
   */
  public function run()
  {
    /**
     * Setup the cart factory on config\app.php
     */
    Cart::factory()->times(config('seeder.cartTable'), 4)->create();
  }
}

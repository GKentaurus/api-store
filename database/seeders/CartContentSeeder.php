<?php

namespace Database\Seeders;

use App\Models\CartContent;
use Illuminate\Database\Seeder;

class CartContentSeeder extends Seeder
{
  /**
   * Run the Cart Content database seeds.
   *
   * @return void
   */
  public function run()
  {
    /**
     * Setup the cart content factory on config\app.php
     */
    CartContent::factory()->times(config('seeder.seedCardContentTable'))->create();
  }
}

<?php

namespace Database\Seeders;

use App\Models\Price;
use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
  /**
   * Run the price database seeds.
   *
   * @return void
   */
  public function run()
  {

    for ($i = 1; $i <= config('aap.seedPriceListTable', 4); $i++) { //  Cantidad de listas
      for ($j = 1; $j <= config('aap.seedProductTable', 5); $j++) { //  Cantidad de productos
        Price::factory()->create([
          'product_id' => $j,
          'price_list_id' => $i,
          'price' => random_int(100, 500),
        ]);
      }
    }

    /**
     * Setup the price factory on config\app.php
     */
    $qty = config('app.seedPriceTable', 4) - config('aap.seedPriceListTable', 4);
    $qty = $qty <= 0 ?  0 : $qty;
    if ($qty > 0) {
      Price::factory()->times($qty)->create();
    }
  }
}

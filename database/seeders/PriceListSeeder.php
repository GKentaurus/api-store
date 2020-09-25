<?php

namespace Database\Seeders;

use App\Models\PriceList;
use Illuminate\Database\Seeder;

class PriceListSeeder extends Seeder
{
  /**
   * Run the price list database seeds.
   *
   * @return void
   */
  public function run()
  {
    $listName = ['General', 'Clientes recurrentes', 'Clientes especiales', 'VIP'];
    for ($i = 0; $i < count($listName); $i++) {
      PriceList::factory()->create([
        'listName' => $listName[$i],
      ]);
    }

    /**
     * Setup the price list factory on config\app.php
     */
    $qty = config('app.seedPriceListTable', 4) - count($listName);
    $qty = $qty <= 0 ?  0 : $qty;
    if ($qty > 0) {
      PriceList::factory()->times($qty)->create();
    }
  }
}

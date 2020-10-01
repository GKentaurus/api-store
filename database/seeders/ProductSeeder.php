<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
  /**
   * Run the product database seeds.
   *
   * @return void
   */
  public function run()
  {
    $model = ['vino001', 'vino002', 'vino003', 'spaguetti001', 'queso001'];
    $description = [
      'Vino añejado 3 años',
      'Vino añejado 5 años',
      'vino añejado 10 años',
      'Spaguetti Veneciano',
      'Queso holandes',
    ];
    for ($i = 0; $i < count($model); $i++) {
      Product::factory()->create([
        'model' => $model[$i],
        'description' => $description[$i],
        'barcode' => '771010000' . ($i + 1),
        'quantity' => random_int(50, 200),
        'active' => 1,
      ]);
    }

    /**
     * Setup the product factory on config\app.php
     */
    $qty = config('seeder.productTable', 5) - count($model);
    $qty = $qty <= 0 ?  0 : $qty;
    if ($qty > 0) {
      Product::factory()->times($qty)->create();
    }
  }
}

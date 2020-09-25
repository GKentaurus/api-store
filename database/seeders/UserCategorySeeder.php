<?php

namespace Database\Seeders;

use App\Models\UserCategory;
use Illuminate\Database\Seeder;

class UserCategorySeeder extends Seeder
{
  /**
   * Run the user category database seeds.
   *
   * @return void
   */
  public function run()
  {
    $categories = ['General', 'Clientes recurrentes', 'Clientes especiales', 'VIP'];
    for ($i = 0; $i < count($categories); $i++) {
      UserCategory::factory()->create([
        'categoryName' => $categories[$i],
        'idPriceList' => $i + 1,
        'active' => 1,
      ]);
    }
    /**
     * Setup the user cetegory factory on config\app.php
     */
    $qty = config('app.seedUserCategoryTable', 4) - count($categories);
    $qty = $qty <= 0 ?  0 : $qty;
    if ($qty > 0) {
      UserCategory::factory()->times($qty)->create();
    }
  }
}

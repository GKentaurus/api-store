<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
  /**
   * Run the product category database seeds.
   *
   * @return void
   */
  public function run()
  {
    /**
     * Setup the product cetegory factory on config\app.php
     */
    ProductCategory::factory()->times(config('seeder.seedProductCategoryTable', 5))->create();
  }
}

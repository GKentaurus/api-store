<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\DocumentType;
use App\Models\Price;
use App\Models\PriceList;
use App\Models\Product;
use App\Models\User;
use App\Models\UserCategory;
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
    DocumentType::factory()->times(4)->create();
    PriceList::factory()->times(5)->create();
    Product::factory()->times(50)->create();
    Price::factory()->times(50)->create();
    UserCategory::factory()->times(5)->create();
    User::factory()->times(15)->create();
    Address::factory()->times(30)->create();
  }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CartSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\OrderSeeder;
use Database\Seeders\PriceSeeder;
use Database\Seeders\AddressSeeder;
use Database\Seeders\CompanySeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\PriceListSeeder;
use Database\Seeders\CartContentSeeder;
use Database\Seeders\OrderStatusSeeder;
use Database\Seeders\DocumentTypeSeeder;
use Database\Seeders\UserCategorySeeder;
use Database\Seeders\PaymentMethodSeeder;
use Database\Seeders\ProductCategorySeeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    /**
     * Define la cantidad de elementos "adicionales" a crearse por cada Factory
     * Algunos de los Factories ya información predeterminada
     */
    $this->call([
      DocumentTypeSeeder::class,
      PriceListSeeder::class,
      ProductSeeder::class,
      PriceSeeder::class,
      UserCategorySeeder::class,
      UserSeeder::class,
      CompanySeeder::class,
      AddressSeeder::class,
      // CartSeeder::class,
      // CartContentSeeder::class,
      ProductCategorySeeder::class,
      OrderStatusSeeder::class,
      PaymentMethodSeeder::class,
      // OrderSeeder::class,
    ]);
  }
}

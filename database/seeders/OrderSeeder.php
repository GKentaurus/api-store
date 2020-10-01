<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
  /**
   * Run the order database seeds.
   *
   * @return void
   */
  public function run()
  {
    /**
     * Setup the order factory on config\app.php
     */
    Order::factory()->times(config('seeder.orderTable'))->create();
  }
}

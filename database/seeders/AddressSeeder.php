<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
  /**
   * Run the Address database seeds.
   *
   * @return void
   */
  public function run()
  {
    /**
     * Setup the address factory on config\app.php
     */
    Address::factory()->times(config('app.seedAddressTable'))->create();
  }
}

<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
  /**
   * Run the company database seeds.
   *
   * @return void
   */
  public function run()
  {
    /**
     * Setup the company factory on config\app.php
     */
    Company::factory()->times(config('seeder.seedCompanyTable'))->create();
  }
}

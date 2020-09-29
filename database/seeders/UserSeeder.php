<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
  /**
   * Run the user category database seeds.
   *
   * @return void
   */
  public function run()
  {
    $users = [
      [
        'firstName' => 'Clara',
        'lastName' => 'Dominguez',
        'mobileNumber' => '3165554778',
        'age' => 22,
        'email' => 'correo1@correo.com',
        'sendEmails' => 1,
        'password' => bcrypt('123456'),
        'termsAndConditions' => 1,
        'user_category_id' => 1,
        'isAdmin' => 1,
      ],
      [
        'firstName' => 'Teresa',
        'lastName' => 'Perez',
        'mobileNumber' => '316569879',
        'age' => 49,
        'email' => 'correo2@correo.com',
        'sendEmails' => 1,
        'password' => bcrypt('456789'),
        'termsAndConditions' => 1,
        'user_category_id' => 2,
        'isAdmin' => 0,
      ],
      [
        'firstName' => 'Camilo',
        'lastName' => 'Ramirez',
        'mobileNumber' => '3151144589',
        'age' => 22,
        'email' => 'correo3@correo.com',
        'sendEmails' => 1,
        'password' => bcrypt('789123'),
        'termsAndConditions' => 1,
        'user_category_id' => 3,
        'isAdmin' => 0,
      ],
      [
        'firstName' => 'Daniel',
        'lastName' => 'Soto',
        'mobileNumber' => '3196332587',
        'age' => 22,
        'email' => 'correo4@correo.com',
        'sendEmails' => 1,
        'password' => bcrypt('123789'),
        'termsAndConditions' => 1,
        'user_category_id' => 4,
        'isAdmin' => 0,
      ],
    ];

    for ($i = 0; $i < count($users); $i++) {
      User::factory()->create($users[$i]);
    }
    /**
     * Setup the user factory on config\app.php
     */
    $qty = config('app.seedUserTable', 4) - count($users);
    $qty = $qty <= 0 ?  0 : $qty;
    if ($qty > 0) {
      User::factory()->times($qty)->create();
    }

    $users = User::all();

    foreach ($users as $user) {
      $user->createToken('accessToken')->accessToken;
    }
  }
}

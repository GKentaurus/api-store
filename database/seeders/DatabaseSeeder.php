<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Price;
use App\Models\Address;
use App\Models\Product;
use App\Models\PriceList;
use App\Models\DocumentType;
use App\Models\UserCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
    $documentTypes = 0;
    $priceLists = 0;
    $products = 0;
    $prices = 0;
    $userCategories = 0;
    $users = 0;
    $addresses = 10;

    /**
     * ANCHOR Document Type
     */
    $abbreviation = ['C.C.', 'C.E.', 'PASS', 'NIT'];
    $documentDescription = ['Cédula de Ciudadanía', 'Cédula de Extranjería', 'Pasaporte', 'NIT'];
    for ($i = 0; $i < count($abbreviation); $i++) {
      DocumentType::factory()->create([
        'abbreviation' => $abbreviation[$i],
        'documentDescription' => $documentDescription[$i],
      ]);
    }
    DocumentType::factory()->times($documentTypes)->create();

    /**
     * ANCHOR Price List
     */
    $listName = ['General', 'Clientes recurrentes', 'Clientes especiales', 'VIP'];
    for ($i = 0; $i < count($listName); $i++) {
      PriceList::factory()->create([
        'listName' => $listName[$i],
      ]);
    }
    PriceList::factory()->times($priceLists)->create();

    /**
     * ANCHOR Product
     */
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
    Product::factory()->times($products)->create();

    /**
     * ANCHOR Price
     */
    for ($i = 1; $i <= 4; $i++) { //  Cantidad de listas
      for ($j = 1; $j <= 5; $j++) { //  Cantidad de productos
        Price::factory()->create([
          'idProduct' => $j,
          'idPriceList' => $i,
          'price' => random_int(100, 500),
        ]);
      }
    }
    Price::factory()->times($prices)->create();

    /**
     * ANCHOR User Category
     */
    $categories = ['General', 'Clientes recurrentes', 'Clientes especiales', 'VIP'];
    for ($i = 0; $i < count($categories); $i++) {
      UserCategory::factory()->create([
        'categoryName' => $categories[$i],
        'idPriceList' => $i + 1,
        'active' => 1,
      ]);
    }
    UserCategory::factory()->times($userCategories)->create();

    /**
     * ANCHOR User
     */
    User::factory()->create([
      'firstName' => 'Clara',
      'lastName' => 'Dominguez',
      'documentType' => 1,
      'documentNumber' => '2119115698',
      'verificationDigit' => '1',
      'email' => 'correo1@correo.com',
      'sendEmails' => 1,
      'password' => bcrypt('123pormi'),
      'mobileNumber' => '3165554778',
      'category' => 1,
    ]);
    User::factory()->create([
      'firstName' => 'Teresa',
      'lastName' => 'Martinez',
      'documentType' => 2,
      'documentNumber' => '114587621',
      'verificationDigit' => '7',
      'email' => 'correo2@correo.com',
      'sendEmails' => 1,
      'password' => bcrypt('123pormi'),
      'mobileNumber' => '3156668987',
      'category' => 2,
    ]);
    User::factory()->create([
      'firstName' => 'Pepito',
      'lastName' => 'Perez',
      'documentType' => 3,
      'documentNumber' => '10014181351771',
      'verificationDigit' => '8',
      'email' => 'correo3@correo.com',
      'sendEmails' => 1,
      'password' => bcrypt('123pormi'),
      'mobileNumber' => '3187844521',
      'category' => 3,
    ]);
    User::factory()->create([
      'firstName' => 'Andres',
      'lastName' => 'Ramirez',
      'documentType' => 4,
      'documentNumber' => '900220777',
      'verificationDigit' => '8',
      'email' => 'correo4@correo.com',
      'sendEmails' => 1,
      'password' => bcrypt('123pormi'),
      'mobileNumber' => '3112544784',
      'category' => 4,
    ]);
    User::factory()->times($users)->create();

    $users = User::all();

    foreach ($users as $user) {
      $user->createToken('accessToken')->accessToken;
    }

    /**
     * ANCHOR Address
     */
    Address::factory()->times($addresses)->create();
  }
}

<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
  /**
   * Run the document type database seeds.
   *
   * @return void
   */
  public function run()
  {
    $abbreviation = ['C.C.', 'C.E.', 'PASS', 'NIT'];
    $documentDescription = [
      'Cédula de Ciudadanía',
      'Cédula de Extranjería',
      'Pasaporte',
      'NIT',
    ];
    for ($i = 0; $i < count($abbreviation); $i++) {
      DocumentType::factory()->create([
        'abbreviation' => $abbreviation[$i],
        'documentDescription' => $documentDescription[$i],
      ]);
    }

    /**
     * Setup the document type factory on config\app.php
     */
    $qty = config('app.seedDocumentTypeTable', 4) - count($abbreviation);
    $qty = $qty <= 0 ?  0 : $qty;
    DocumentType::factory()->times($qty)->create();
  }
}

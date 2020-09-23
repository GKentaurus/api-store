<?php

namespace Database\Factories;

use App\Models\DocumentType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DocumentTypeFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = DocumentType::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    $abbreviations = array('NIT', 'C.C.', 'C.E.', 'PASS');
    $documents = array('NIT', 'Cédula de Ciudadanía', 'Cédula de Extranjería', 'Pasaporte');
    return [
      'abbreviation' => $this->faker->unique()->word(), // 'b',
      'documentDescription' => $this->faker->paragraph(1),
    ];
  }
}

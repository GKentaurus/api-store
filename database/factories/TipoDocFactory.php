<?php

namespace Database\Factories;

use App\Models\TipoDoc;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TipoDocFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = TipoDoc::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    $siglas = array('NIT', 'C.C.', 'C.E.', 'PASS');
    $documentos = array('NIT', 'Cédula de Ciudadanía', 'Cédula de Extranjería', 'Pasaporte');
    return [
      'sigla' => $this->faker->unique()->randomElement($array = array('NIT', 'C.C.', 'C.E.', 'PASS')), // 'b',
      'nombreDoc' => $this->faker->word,
    ];
  }
}

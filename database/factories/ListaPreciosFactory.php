<?php

namespace Database\Factories;

use App\Models\ListaPrecios;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ListaPreciosFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = ListaPrecios::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'nombreLista' => $this->faker->firstName,
    ];
  }
}

<?php

namespace Database\Factories;

use App\Models\Precios;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PreciosFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Precios::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'idProducto' => $this->faker->numberBetween($min = 1, $max = 50),
      'idListaPrecios' => $this->faker->numberBetween($min = 1, $max = 5),
      'precio' => $this->faker->numberBetween($min = 100, $max = 10000),
    ];
  }
}

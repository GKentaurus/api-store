<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductoFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Producto::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'referencia' => $this->faker->unique()->word,
      'descripcion' => $this->faker->text($maxNbChars = 200),
      'codigoEAN' => $this->faker->numberBetween($min = 1111111111111, $max = 9999999999999),
      'cantidad' => $this->faker->numberBetween($min = 0, $max = 100),
      'activo' => true,
    ];
  }
}

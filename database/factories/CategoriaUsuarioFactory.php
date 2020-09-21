<?php

namespace Database\Factories;

use App\Models\CategoriaUsuario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoriaUsuarioFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = CategoriaUsuario::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'nombreCategoria' => $this->faker->firstName,
      'idListaPrecios' => $this->faker->numberBetween($min = 1, $max = 5),
      'activo' => true
    ];
  }
}

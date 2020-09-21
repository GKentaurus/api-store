<?php

namespace Database\Factories;

use App\Models\Direccion;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DireccionFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Direccion::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'idUsuario' => $this->faker->numberBetween($min = 1, $max = 10),
      'nombreDireccion' => $this->faker->cityPrefix . ' ' . $this->faker->citySuffix,
      'dirLinea1' => $this->faker->address,
      'dirLinea2' => $this->faker->secondaryAddress,
      'ciudad' => $this->faker->city,
      'departamento' => $this->faker->state,
      'pais' => $this->faker->country
    ];
  }
}

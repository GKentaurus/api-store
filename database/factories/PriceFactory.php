<?php

namespace Database\Factories;

use App\Models\Price;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PriceFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Price::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'idProduct' => $this->faker->numberBetween($min = 1, $max = 50),
      'idPriceList' => $this->faker->numberBetween($min = 1, $max = 5),
      'price' => $this->faker->numberBetween($min = 100, $max = 10000),
    ];
  }
}

<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Product::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'model' => $this->faker->unique()->word,
      'description' => $this->faker->text($maxNbChars = 200),
      'barcode' => $this->faker->numberBetween($min = 1111111111111, $max = 9999999999999),
      'quantity' => $this->faker->numberBetween($min = 0, $max = 200),
      'active' => 1,
    ];
  }
}

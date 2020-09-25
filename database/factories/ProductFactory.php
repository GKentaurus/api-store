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
      'barcode' => '771010' . $this->faker->numberBetween(config('app.seedProductTable', 5), 9999),
      'quantity' => $this->faker->numberBetween(50, 200),
      'active' => 1,
    ];
  }
}

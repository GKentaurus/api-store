<?php

namespace Database\Factories;

use App\Models\CartContent;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CartContentFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = CartContent::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'idCart' => $this->faker->numberBetween(1, config('app.seedCartTable', 4)),
      'idProduct' => $this->faker->numberBetween(1, config('app.seedProductTable', 5)),
      'quantity' => $this->faker->numberBetween(1, 10),
      'price' => $this->faker->numberBetween(100, 500),
    ];
  }
}

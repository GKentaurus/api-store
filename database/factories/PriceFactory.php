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
      'product_id' => $this->faker->numberBetween(1, config('app.seedProductTable'), 5),
      'price_list_id' => $this->faker->numberBetween(1, config('app.seedPriceListTable'), 4),
      'price' => $this->faker->numberBetween(100, 500),
    ];
  }
}

<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Order::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'idCart' => $this->faker->numberBetween(1, config('app.seedOrderTable', 4)),
      'idOrderStatus' => $this->faker->numberBetween(1, config('app.seedOrderStatusTable', 7)),
      'idPaymentMethod' => $this->faker->numberBetween(1, config('app.seedPaymentMethodTable', 4)),
    ];
  }
}

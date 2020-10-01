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
      'cart_id' => $this->faker->numberBetween(1, config('seeder.orderTable', 4)),
      'order_status_id' => $this->faker->numberBetween(1, config('seeder.orderStatusTable', 7)),
      'payment_method_id' => $this->faker->numberBetween(1, config('seeder.paymentMethodTable', 4)),
    ];
  }
}

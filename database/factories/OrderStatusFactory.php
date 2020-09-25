<?php

namespace Database\Factories;

use App\Models\OrderStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderStatusFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = OrderStatus::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'sortOrder' => $this->faker->numberBetween(8, config('app.seedOrderStatusTable', 7)),
      'name' => $this->faker->paragraph(2),
      'active' => 1,
    ];
  }
}

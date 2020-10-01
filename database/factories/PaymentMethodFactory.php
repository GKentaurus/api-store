<?php

namespace Database\Factories;

use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PaymentMethodFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = PaymentMethod::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'sortOrder' => $this->faker->numberBetween(8, config('seeder.paymentMethodTable', 7)),
      'name' => $this->faker->paragraph(2),
      'active' => 1,
    ];
  }
}

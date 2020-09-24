<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AddressFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Address::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'idCompany' => $this->faker->numberBetween($min = 1, $max = 4),
      'addressName' => $this->faker->cityPrefix . ' ' . $this->faker->citySuffix,
      'addressLine1' => $this->faker->address,
      'addressLine2' => $this->faker->secondaryAddress,
      'city' => $this->faker->city,
      'state' => $this->faker->state,
      'country' => $this->faker->country
    ];
  }
}

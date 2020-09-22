<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = User::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'firstName' => $this->faker->firstName,
      'lastName' => $this->faker->lastName,
      'documentType' => $this->faker->numberBetween($min = 1, $max = 4),
      'documentNumber' => $this->faker->numberBetween($min = 100000, $max = 999999999),
      'verificationDigit' => $this->faker->numberBetween($min = 0, $max = 9),
      'email' => $this->faker->safeEmail,
      'password' => $this->faker->password($min = 8, $max = 20),
      'mobileNumber' => $this->faker->e164PhoneNumber,
      'category' => $this->faker->numberBetween($min = 1, $max = 5),
    ];
  }
}

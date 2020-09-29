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
      'mobileNumber' => $this->faker->e164PhoneNumber,
      'age' => $this->faker->numberBetween(18, 99),
      'email' => $this->faker->safeEmail,
      'sendEmails' => $this->faker->boolean(70),
      'password' => bcrypt($this->faker->password($min = 8, $max = 20)),
      'termsAndConditions' => 1,
      'user_category_id' => $this->faker->numberBetween($min = 1, $max = 5),
      'isAdmin' => 0,
    ];
  }
}

<?php

namespace Database\Factories;

use App\Models\UserCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserCategoryFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = UserCategory::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'categoryName' => $this->faker->firstName,
      'idPriceList' => $this->faker->numberBetween($min = 1, $max = 5),
      'active' => true
    ];
  }
}

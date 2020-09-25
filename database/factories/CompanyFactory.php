<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CompanyFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Company::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'idUser' => $this->faker->numberBetween(1, config('app.seedUserTable', 4)),
      'companyName' => $this->faker->name,
      'documentType' => $this->faker->numberBetween(1, config('app.seedDocumentTypeTable', 4)),
      'documentNumber' => $this->faker->numberBetween(1000000, 1199999999),
      'verificationDigit' => $this->faker->numberBetween(0, 9),
      'billingEmail' => $this->faker->safeEmail,
    ];
  }
}

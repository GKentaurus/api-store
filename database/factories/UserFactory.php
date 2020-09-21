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
  protected $numeroDocumento;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'pNombre' => $this->faker->firstName,
      'sNombre' => $this->faker->firstName,
      'pApelido' => $this->faker->lastName,
      'sApelido' => $this->faker->lastName,
      'tipoDoc' => $this->faker->numberBetween($min = 1, $max = 4),
      'numDoc' => $this->faker->numberBetween($min = 100000000, $max = 999999999),
      'digVerif' => $this->faker->numberBetween($min = 0, $max = 9),
      'email' => $this->faker->safeEmail,
      'contrasena' => $this->faker->password($min = 8, $max = 20),
      'telefPpal' => $this->faker->e164PhoneNumber,
      'categoria' => $this->faker->numberBetween($min = 1, $max = 5),
    ];
  }

  public function fakerNumDoc()
  {
    $this->numeroDocumento = $this->faker->numberBetween($min = 100000000, $max = 999999999);
    return $this->numeroDocumento;
  }

  public function digVerif($documento)
  {
    $serie = [71, 67, 59, 53, 47, 43, 41, 37, 29, 23, 19, 17, 13, 7, 3, 0];
    $documento = strval($documento);
    $serie = array_reverse($serie);
    $documento = array_reverse(str_split($documento));
    $sum = 0;
    for ($i = 1; $i <= count($documento); $i++) {
      $sum = $sum + ($serie[$i] * $documento[$i - 1]);
    }
    $decimal = ($sum % 11);

    $form['digVerif'] = $decimal > 1 ? 11 - $decimal : $decimal;
  }
}

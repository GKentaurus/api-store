<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
  /**
   * Run the payment method database seeds.
   *
   * @return void
   */
  public function run()
  {
    $paymentMethods = [
      [
        'sortOrder' => 0,
        'name' => 'Efectivo',
        'active' => 1,
      ],
      [
        'sortOrder' => 1,
        'name' => 'PSE (Pagos en Línea)',
        'active' => 1,
      ],
      [
        'sortOrder' => 2,
        'name' => 'Tarjeta crédito',
        'active' => 1,
      ],
      [
        'sortOrder' => 3,
        'name' => 'Transferencia bancaria',
        'active' => 1,
      ],
    ];

    for ($i = 0; $i < count($paymentMethods); $i++) {
      PaymentMethod::factory()->create($paymentMethods[$i]);
    }

    /**
     * Setup the payment method factory on config\app.php
     */
    $qty = config('app.seedPaymentMethodTable', 7) - count($paymentMethods);
    $qty = $qty <= 0 ?  0 : $qty;
    if ($qty > 0) {
      PaymentMethod::factory()->times($qty)->create();
    }
  }
}

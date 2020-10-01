<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
  /**
   * Run the order status database seeds.
   *
   * @return void
   */
  public function run()
  {
    $orderStatus = [
      [
        'sortOrder' => 0,
        'name' => 'Cancelado',
        'active' => 1,
      ],
      [
        'sortOrder' => 1,
        'name' => 'Pendiente por pago',
        'active' => 1,
      ],
      [
        'sortOrder' => 2,
        'name' => 'Confirmando pago',
        'active' => 1,
      ],
      [
        'sortOrder' => 3,
        'name' => 'Pagado',
        'active' => 1,
      ],
      [
        'sortOrder' => 4,
        'name' => 'En tránsito',
        'active' => 1,
      ],
      [
        'sortOrder' => 5,
        'name' => 'Entregado',
        'active' => 1,
      ],
      [
        'sortOrder' => 6,
        'name' => 'Devuelto',
        'active' => 1,
      ],
    ];
    for ($i = 0; $i < count($orderStatus); $i++) {
      OrderStatus::factory()->create($orderStatus[$i]);
    }

    /**
     * Setup the order status factory on config\app.php
     */

    $qty = config('seeder.orderStatusTable', 7) - count($orderStatus);
    $qty = $qty <= 0 ?  0 : $qty;
    if ($qty > 0) {
      OrderStatus::factory()->times($qty)->create();
    }
  }
}

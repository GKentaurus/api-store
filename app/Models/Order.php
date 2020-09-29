<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
  use HasFactory, Notifiable, SoftDeletes;

  protected $table = "orders";

  protected $fillable = [
    'cart_id',
    'order_status_id',
    'payment_method_id'
  ];

  protected $hidden = [];

  protected $casts = [];

  public function cart()
  {
    return $this->belongsTo(Cart::class);
  }
}

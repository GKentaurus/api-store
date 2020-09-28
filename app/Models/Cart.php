<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Cart extends Model
{
  use HasFactory, Notifiable, SoftDeletes;

  protected $table = "carts";

  protected $fillable = [
    'idUser',
    'active',
  ];

  protected $hidden = [];

  protected $casts = [];

  public function order()
  {
    return $this->hasOne(Order::class);
  }

  public function cartContent()
  {
    return $this->hasMany(CartContent::class, 'idCart');
  }
}

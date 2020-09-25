<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class CartContent extends Model
{
  use HasFactory, Notifiable, SoftDeletes;

  protected $table = "cart_contents";
  protected $fillable = [
    'idCart',
    'idProduct',
    'quantity',
    'price'
  ];

  protected $hidden = [];

  protected $casts = [];
}

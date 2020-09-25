<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class OrderStatus extends Model
{
  use HasFactory, Notifiable, SoftDeletes;

  protected $table = "order_statuses";

  protected $fillable = [
    'sortOrder',
    'name',
    'active',
  ];

  protected $hidden = [];

  protected $casts = [];
}

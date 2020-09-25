<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class PaymentMethod extends Model
{
  use HasFactory, Notifiable, SoftDeletes;

  protected $table = "payment_methods";

  protected $fillable = [
    'sortOrder',
    'name',
    'active'
  ];

  protected $hidden = [];

  protected $casts = [];
}

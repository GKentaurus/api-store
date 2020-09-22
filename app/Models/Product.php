<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
  use HasFactory, Notifiable, SoftDeletes;

  protected $table = 'products';

  protected $fillable = [
    'model',
    'description',
    'barcode',
    'quantity',
    'active',
  ];

  protected $hidden = [];

  protected $casts = [];
}

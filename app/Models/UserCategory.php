<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserCategory extends Model
{
  use HasFactory, Notifiable, SoftDeletes;

  protected $table = 'user_categories';

  protected $fillable = [
    'categoryName',
    'idPriceList',
    'active'
  ];

  protected $hidden = [];

  protected $casts = [];
}

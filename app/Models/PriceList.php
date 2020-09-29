<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class PriceList extends Model
{
  use HasFactory, Notifiable, SoftDeletes;

  protected $table = 'price_lists';

  protected $fillable = [
    'listName'
  ];

  protected $hidden = [];

  protected $casts = [];

  public function prices()
  {
    return $this->hasMany(Price::class);
  }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Price extends Model
{
  use HasFactory, Notifiable, SoftDeletes;

  protected $table = 'prices';

  protected $fillable = [
    'idProduct',
    'idPriceList',
    'price'
  ];

  protected $hidden = [];

  protected $casts = [];

  public function priceList()
  {
    return $this->belongsTo(PriceList::class, 'id');
  }
}

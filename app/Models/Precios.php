<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Precios extends Model
{
  use HasFactory, Notifiable, SoftDeletes;

  protected $table = 'precios';

  protected $fillable = [
    'idPrecio',
    'idProducto',
    'idListaPrecios',
    'precio'
  ];

  protected $hidden = [];

  protected $casts = [];

  // public function idListaPrecios()
  // {
  //   return $this->belongsTo(ListaPrecios::class, 'id', 'idListaPrecios');
  // }

  // public function idProducto()
  // {
  //   return $this->belongsTo(Producto::class, 'id', 'idProducto');
  // }
}

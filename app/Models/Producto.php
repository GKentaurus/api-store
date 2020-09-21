<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
  use HasFactory, Notifiable, SoftDeletes;

  protected $table = 'productos';

  protected $fillable = [
    'referencia',
    'descripcion',
    'codigoEAN',
    'cantidad',
    'activo',
  ];

  protected $hidden = [];

  protected $casts = [];
}

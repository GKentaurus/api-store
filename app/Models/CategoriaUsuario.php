<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoriaUsuario extends Model
{
  use HasFactory, Notifiable, SoftDeletes;

  protected $table = 'categoria_usuario';

  protected $fillable = [
    'nombreCategoria',
    'idListaPrecios',
    'activo'
  ];

  protected $hidden = [];

  protected $casts = [];

  // public function idListaPrecios()
  // {
  //   return $this->belongsTo(ListaPrecios::class, 'idListaPrecios', 'id');
  // }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Direccion extends Model
{
  use HasFactory, Notifiable, SoftDeletes;

  protected $table = 'direccion';

  protected $fillable = [
    'nombreDireccion',
    'dirLinea1',
    'dirLinea2',
    'ciudad',
    'departamento',
    'pais'
  ];

  protected $hidden = [];

  protected $casts = [];

  // public function idUsuario()
  // {
  //   return $this->belongsTo(User::class, 'id', 'idUsuario');
  // }
}

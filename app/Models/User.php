<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
  use HasFactory, Notifiable, SoftDeletes;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  protected $table = 'users';

  protected $fillable = [
    'pNombre',
    'sNombre',
    'pApelido',
    'sApelido',
    'tipoDoc',
    'numDoc',
    'digVerif',
    'email',
    'contrasena',
    'telefPpal',
    'categoria'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'contrasena', 'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  // public function tipoDoc()
  // {
  //   return $this->belongsTo(TipoDoc::class, 'tipoDoc', 'id');
  // }

  // public function categoriaCliente()
  // {
  //   return $this->belongsTo(CategoriaUsuario::class, 'id', 'categoria');
  // }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
  use HasFactory, Notifiable, SoftDeletes;

  protected $table = 'addresses';

  protected $fillable = [
    'idCompany',
    'addressName',
    'addressLine1',
    'addressLine2',
    'city',
    'state',
    'country'
  ];

  protected $hidden = [];

  protected $casts = [];

  // public function idUsuario()
  // {
  //   return $this->belongsTo(User::class, 'id', 'idUsuario');
  // }
}

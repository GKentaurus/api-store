<?php

namespace App\Models;

use App\Models\Company;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  protected $table = 'users';

  protected $fillable = [
    'firstName',
    'lastName',
    'mobileNumber',
    'age',
    'email',
    'sendEmails',
    'password',
    'termsAndConditions',
    'user_category_id',
    'isAdmin',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function companies()
  {
    return $this->hasMany(Company::class, 'user_id');
  }
}

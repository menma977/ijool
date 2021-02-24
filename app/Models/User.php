<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * Class User
 * @package App\Models
 * @property string name
 * @property string code
 * @property string username
 * @property string email
 * @property string password
 * @property string email_verified_at
 * @property string created_at
 * @property string updated_at
 */
class User extends Authenticatable implements MustVerifyEmail
{
  use HasFactory, Notifiable, SoftDeletes, HasApiTokens;

  protected $with = ["profile", "doge"];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name',
    'code',
    'username',
    'email',
    'password',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'id',
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function profile()
  {
    return $this->hasOne(Profile::class, "user_id", "id");
  }

  public function doge()
  {
    return $this->hasOne(Doge::class, "user_id", "id");
  }
}

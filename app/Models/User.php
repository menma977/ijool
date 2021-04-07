<?php

namespace App\Models;

use App\Notifications\PasswordReset;
use App\Notifications\Registered;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use phpDocumentor\Reflection\Types\Integer;

/**
 * Class User
 * @package App\Models
 * @property Integer id
 * @property string role
 * @property string name
 * @property string code
 * @property string username
 * @property string email
 * @property string password
 * @property int suspend
 * @property int subscribe
 * @property string email_verified_at
 * @property string created_at
 * @property string updated_at
 */
class User extends Authenticatable implements MustVerifyEmail
{
  use HasFactory, Notifiable, HasApiTokens;

  protected $with = ["profile", "doge", "trading", "permission"];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'role',
    'name',
    'code',
    'username',
    'email',
    'password',
    'suspend',
    'subscribe',
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

  /**
   * @return HasOne
   */
  public function profile(): HasOne
  {
    return $this->hasOne(Profile::class, "user_id", "id");
  }

  /**
   * @return HasOne
   */
  public function doge(): HasOne
  {
    return $this->hasOne(Doge::class, "user_id", "id");
  }

  /**
   * @return HasOne
   */
  public function trading(): HasOne
  {
    return $this->hasOne(Trading::class, "user_id", "id");
  }

  /**
   * @return HasMany
   */
  public function permission(): HasMany
  {
    return $this->hasMany(Permission::class, "user_id", "id");
  }

  public function pin(): HasMany
  {
    return $this->hasMany(Pin::class, "user_id", "id");
  }

  public function sendEmailVerificationNotification()
  {
    $this->notify(new Registered($this->doge));
  }

  public function sendPasswordResetNotification($token)
  {
    $this->notify(new PasswordReset($token));
  }
}

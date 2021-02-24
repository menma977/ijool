<?php

namespace App\Models;

use App\Providers\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Doge
 * @package App\Models
 * @property string id
 * @property integer user_id
 * @property string username
 * @property string password
 * @property string wallet
 * @property string cookie
 * @property string created_at
 * @property string updated_at
 */
class Doge extends Model
{
  use HasFactory, Uuid;

  protected $keyType = "string";

  protected $fillable = [
    'user_id',
    'username',
    'wallet',
    'cookie',
  ];

  protected $hidden = [
    'id',
    'password',
  ];

  public function user()
  {
    return $this->belongsTo(User::class, "user_id", "id");
  }
}

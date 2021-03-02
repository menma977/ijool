<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Bank
 * @package App\Models
 * @property string id
 * @property string username
 * @property string password
 * @property string wallet
 * @property string cookie
 * @property string created_at
 * @property string updated_at
 */
class Bank extends Model
{
  use HasFactory;

  protected $fillable = [
    'username',
    'wallet',
    'cookie',
  ];

  protected $hidden = [
    'id',
    'password',
  ];
}

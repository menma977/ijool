<?php

namespace App\Models;

use App\Providers\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Subscribe
 * @package App\Models
 * @property string id
 * @property integer user_id
 * @property integer price
 * @property boolean is_finished
 * @property string created_at
 * @property string updated_at
 * @property string expired_at
 */
class Subscribe extends Model
{
  use HasFactory, Uuid;

  protected $keyType = "string";

  protected $fillable = [
    'user_id',
    'price',
    'is_finished',
    'expired_at',
  ];

  protected $hidden = [
    'id'
  ];
}

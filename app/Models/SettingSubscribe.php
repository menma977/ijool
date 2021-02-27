<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SettingSubscribe
 * @package App\Models
 * @property integer id
 * @property string price
 * @property string discount_price
 * @property string created_at
 * @property string updated_at
 */
class SettingSubscribe extends Model
{
  use HasFactory;

  protected $fillable = [
    'price',
    'discount_price',
  ];

  protected $hidden = [
    'id'
  ];
}

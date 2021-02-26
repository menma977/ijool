<?php

namespace App\Models;

use App\Providers\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MarketPrice
 * @package App\Models
 * @property string id
 * @property string buy
 * @property string sell
 * @property string last
 * @property string high
 * @property string low
 * @property string created_at
 * @property string updated_at
 */
class MarketPrice extends Model
{
  use HasFactory, Uuid;

  protected $keyType = "string";

  protected $fillable = [
    'buy',
    'sell',
    'last',
    'high',
    'low',
  ];

  protected $hidden = [
    'id'
  ];
}

<?php

namespace App\Models;

use App\Providers\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Bill
 * @package App\Models
 * @property string id
 * @property integer from
 * @property integer to
 * @property string value
 * @property Boolean status
 * @property string send_at
 * @property string created_at
 * @property string updated_at
 */
class Bill extends Model
{
  use HasFactory, Uuid;

  protected $keyType = "string";

  protected $fillable = [
    'from',
    'to',
    'value',
    'status',
    'send_at',
  ];

  protected $hidden = [
    'id'
  ];
}

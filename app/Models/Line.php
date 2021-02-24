<?php

namespace App\Models;

use App\Providers\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Line
 * @package App\Models
 * @property string id
 * @property integer user_id
 * @property string mate
 * @property string is_verified
 * @property string created_at
 * @property string updated_at
 */
class Line extends Model
{
  use HasFactory, Uuid;

  protected $keyType = "string";

  protected $fillable = [
    'user_id',
    'mate',
    'is_verified',
  ];

  protected $hidden = [
    'id'
  ];
}

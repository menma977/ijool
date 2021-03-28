<?php

namespace App\Models;

use App\Providers\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Version
 * @package App\Models
 * @property string id
 * @property integer desktop_code
 * @property string desktop_name
 * @property integer apk_code
 * @property string apk_name
 */
class Version extends Model
{
  use HasFactory, Uuid;

  protected $keyType = "string";

  protected $fillable = [
    'desktop_code',
    'desktop_name',
    'apk_code',
    'apk_name',
  ];

  protected $hidden = [
    'id'
  ];
}

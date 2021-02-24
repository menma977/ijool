<?php

namespace App\Models;

use App\Providers\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Profile
 * @package App\Models
 * @property string id
 * @property integer user_id
 * @property string image
 * @property string country
 * @property string city
 * @property string created_at
 * @property string updated_at
 */
class Profile extends Model
{
  use HasFactory, Uuid;

  protected $keyType = "string";

  protected $fillable = [
    'user_id',
    'image',
    'country',
    'city',
  ];

  protected $hidden = [
    'id'
  ];

  public function user()
  {
    return $this->belongsTo(User::class, "user_id", "id");
  }
}

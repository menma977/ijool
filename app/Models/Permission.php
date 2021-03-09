<?php

namespace App\Models;

use App\Providers\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Permission
 * @package App\Models
 * @property string id
 * @property integer user_id
 * @property integer role_id
 * @property string created_at
 * @property string updated_at
 */
class Permission extends Model
{
  use HasFactory, Uuid;

  protected $with = ["role"];

  protected $keyType = "string";

  protected $fillable = [
    'user_id',
    'role_id',
  ];

  protected $hidden = [
    'id'
  ];

  /**
   * @return HasOne
   */
  public function role(): HasOne
  {
    return $this->hasOne(Role::class, "id", "role_id");
  }

  /**
   * @return BelongsTo
   */
  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class, "user_id", "id");
  }
}

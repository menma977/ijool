<?php

namespace App\Models;

use App\Providers\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Trading
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
class Trading extends Model
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

  /**
   * @return BelongsTo
   */
  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class, "user_id", "id");
  }
}

<?php

namespace App\Models;

use App\Providers\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Pin
 * @package App\Models
 * @property string id
 * @property integer user_id
 * @property integer debit
 * @property integer credit
 * @property string created_at
 * @property string updated_at
 */
class Pin extends Model
{
  use HasFactory, Uuid;

  protected $keyType = "string";

  protected $fillable = [
    'debit',
    'credit',
  ];

  protected $hidden = [
    'id',
    'user_id',
  ];

  /**
   * @return BelongsTo
   */
  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class, "user_id", "id");
  }

  /**
   * @param $user_id
   * @return int
   */
  public static function total($user_id): int
  {
    return self::where("user_id", $user_id)->sum("debit") - self::where("user_id", $user_id)->sum("credit");
  }
}

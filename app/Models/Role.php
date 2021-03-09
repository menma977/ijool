<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Role
 * @package App\Models
 * @property integer id
 * @property string name
 * @property string created_at
 * @property string updated_at
 */
class Role extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
  ];

  protected $hidden = [
    'id'
  ];

  /**
   * @return BelongsTo
   */
  public function permissions(): BelongsTo
  {
    return $this->belongsTo(Permission::class, "id", "role_id");
  }
}

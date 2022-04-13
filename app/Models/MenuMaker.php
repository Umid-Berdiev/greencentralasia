<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuMaker extends Model
{
  protected $table = 'menumakers';
  protected $guarded = [];

  /**
   * Get the parent that owns the MenuMaker
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function parent()
  {
    return $this->belongsTo(self::class, 'parent_id', 'group')->where('parent_id', 0);
  }

  /**
   * Get all of the children for the MenuMaker
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function children()
  {
    return $this->hasMany(self::class, 'parent_id', 'group')->where('language_id', current_language()->id);
  }
}

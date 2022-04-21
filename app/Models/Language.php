<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
  protected $table = 'languages';
  protected $fillable = ['id', 'language_name', 'language_prefix', 'status'];

  /**
   * Get all of the documents for the Language
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function documents()
  {
    return $this->hasMany(Document::class, 'language_id', 'id');
  }
}

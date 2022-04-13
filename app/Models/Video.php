<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
  protected $table = 'videogalleries';
  protected $guarded = [];

  public function category()
  {
    return $this->belongsTo(Videoalbum::class, 'category_id', 'group');
  }
}

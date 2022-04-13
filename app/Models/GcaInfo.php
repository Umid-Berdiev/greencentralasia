<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GcaInfo extends Model
{
  public function news()
  {
    $lang_id = current_language()->id;

    return $this->hasMany(Post::class, 'gcainfo_id', 'id')
      ->where('language_id', $lang_id)
      ->where('category_group_id', '!=', '1615268167');
  }
}

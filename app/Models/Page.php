<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
  protected $fillable = ['title', 'description', 'content', 'language_id', 'page_group_id', 'page_category_group_id'];

  public function category()
  {
    return $this->belongsTo(PageCategory::class, 'page_category_group_id', 'category_group_id');
  }
}

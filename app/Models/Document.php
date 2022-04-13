<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
  protected $table = 'docs';
  protected $guarded = [];

  public function category()
  {
    return $this->belongsTo(DocumentCategory::class, 'doc_category_id', 'group');
  }
}

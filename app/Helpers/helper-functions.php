<?php

use App\Models\Language;
use App\Models\Visitor;

function current_language()
{
  $currentLocale = app()->currentLocale() ? app()->currentLocale() : 'en';

  $model = Language::where('status', '1')->where("language_prefix", $currentLocale)->first();

  return $model;
}

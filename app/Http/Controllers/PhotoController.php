<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Tender;
use Illuminate\Support\Facades\DB;

class PhotoController extends Controller
{
  public function ViewPhoto()
  {
    $lang_id = current_language()->id;
    $tenders = Tender::take(3)->where('title', '<>', '')->where('language_id', $lang_id)->orderBy('id', 'desc')->get();
    $events = DB::table("events")
      ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
      ->leftJoin("languages", "languages.id", "=", "events.language_id")
      ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
      ->where('events.title', '<>', '')
      ->where("events.language_id", $lang_id)
      ->where("eventcategories.language_id", $lang_id)->take(5)->orderBy('id', 'desc')->get();
    $model = DB::table("photogallerycategories")
      ->select(['photogallerycategories.*', 'languages.language_name'])
      ->leftJoin("languages", "languages.id", "=", "photogallerycategories.language_id")
      ->where("photogallerycategories.language_id", $lang_id)
      ->orderBy('id', 'desc')
      ->paginate(10);

    $category = DB::table("photogallerycategories")
      ->select(['photogallerycategories.*', 'languages.language_name'])
      ->leftJoin("languages", "languages.id", "=", "photogallerycategories.language_id")
      ->where("photogallerycategories.language_id", $lang_id)->get();

    return view('gca.media', [
      'newscat' => $category,
      'table' => $model,
      'tenders' => $tenders,
      'events' => $events,
    ]);
  }
}

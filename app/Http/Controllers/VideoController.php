<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Tender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VideoController extends Controller
{
  public function ViewVideo()
  {
    $lang_id = current_language()->id;
    $model = "";
    $tenders = Tender::take(3)
      ->where('title', '<>', '')
      ->where('language_id', $lang_id)
      ->orderBy('id', 'desc')
      ->get();

    $events = DB::table("events")
      ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
      ->leftJoin("languages", "languages.id", "=", "events.language_id")
      ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
      ->where('events.title', '<>', '')
      ->where("events.language_id", $lang_id)
      ->where("eventcategories.language_id", $lang_id)
      ->take(5)
      ->orderBy('id', 'desc')
      ->get();

    $category = DB::table("videogallerycategories")
      ->select(['videogallerycategories.*', 'languages.language_name'])
      ->leftJoin("languages", "languages.id", "=", "videogallerycategories.language_id")
      ->where("videogallerycategories.language_id", $lang_id)
      ->get();

    $model = DB::table("videogallerycategories")
      ->select(['videogallerycategories.*', 'languages.language_name'])
      ->leftJoin("languages", "languages.id", "=", "videogallerycategories.language_id")
      ->where("videogallerycategories.language_id", $lang_id)
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('gca.video', [
      'newscat' => $category,
      'table' => $model,
      'tenders' => $tenders,
      'events' => $events,
    ]);
  }
}

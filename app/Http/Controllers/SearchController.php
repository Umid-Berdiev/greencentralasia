<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Sorovvote;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Tender;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class SearchController extends Controller
{
  public function index(Request $request)
  {
    $lang_id = current_language()->id;
    $events = null;
    $events = DB::table("events")
      ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
      ->leftJoin("languages", "languages.id", "=", "events.language_id")
      ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
      ->where("events.language_id", $lang_id)
      ->where("eventcategories.language_id", $lang_id)->take(5)->get();
    $tenders = Tender::take(3)->where('language_id', $lang_id)->get();
    $search = $request->input("search");
    $posts = DB::select("select * from `posts` where `language_id` = '$lang_id' and `title` LIKE '%$search%' ");
    $page = DB::select("select * from `pages` where `language_id` = '$lang_id' and `title` LIKE '%$search%' ");
    $doc = DB::select("select * from `docs` where `language_id` = $lang_id and `title` LIKE '%$search%' ");
    $event = DB::select("select * from `events` where `language_id` = '$lang_id' and `title` LIKE '%$search%' ");
    $tenderss = DB::select("select * from `tenders` where `language_id` = '$lang_id' and `title` LIKE '%$search%' ");

    return view('gca.search')
      ->with('posts', $posts)
      ->with('pages', $page)
      ->with('docs', $doc)
      ->with('events', $event)
      ->with('tenderss', $tenderss)
      ->with('events', $events)
      ->with('tenders', $tenders);
  }

  public function allin($lang_id, $name_tip, $category_id, Request $request)
  {
    $model = "";
    $tenders = Tender::take(3)->where('title', '<>', '')->where('language_id', $lang_id)->orderBy('id', 'desc')->get();
    $events = DB::table("events")
      ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
      ->leftJoin("languages", "languages.id", "=", "events.language_id")
      ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
      ->where('events.title', '<>', '')
      ->where("events.language_id", $lang_id)
      ->where("eventcategories.language_id", $lang_id)->take(5)->orderBy('id', 'desc')->get();

    switch ($name_tip) {
      case "doc":
        $model = DB::table("docs")
          ->select(['docs.*', 'languages.language_name', 'doccategories.category_name'])
          ->leftJoin("languages", "languages.id", "=", "docs.language_id")
          ->leftJoin("doccategories", "doccategories.group", "=", "docs.doc_category_id")
          ->where('docs.title', '<>', '')
          ->where("docs.language_id", $lang_id)
          ->where("docs.doc_category_id", "=", $category_id)
          ->where("doccategories.language_id", $lang_id)
          ->orderBy('id', 'desc')
          ->paginate(10);

        $category = DB::table("doccategories")
          ->select(['doccategories.*', 'languages.language_name'])
          ->leftJoin("languages", "languages.id", "=", "doccategories.language_id")
          ->where("doccategories.language_id", $lang_id)->get();

        $curcat = DB::table("doccategories")
          ->where('group', '=', $category_id)
          ->where("language_id", $lang_id)
          ->first();

        return view('gca.docs', [
          'newscat' => $category,
          'table' => $model,
          'curcat' => $curcat,
          'tenders' => $tenders,
          'events' => $events,
        ]);
        break;
      case "event":
        if ($request->has('date')) {
          $model = DB::table("events")
            ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
            ->leftJoin("languages", "languages.id", "=", "events.language_id")
            ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
            ->where('events.title', '<>', '')
            ->whereDate("datestart", $request->date)
            ->where("events.language_id", $lang_id)
            ->where("events.event_category_id", "=", $category_id)
            ->where("eventcategories.language_id", $lang_id)
            ->orderBy('id', 'desc')
            ->paginate(10);
        } else {
          $model = DB::table("events")
            ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
            ->leftJoin("languages", "languages.id", "=", "events.language_id")
            ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
            ->where('events.title', '<>', '')
            ->where("events.language_id", $lang_id)
            ->where("events.event_category_id", "=", $category_id)
            ->where("eventcategories.language_id", $lang_id)
            ->orderBy('id', 'desc')
            ->paginate(10);
        }

        $category = DB::table("eventcategories")
          ->select(['eventcategories.*', 'languages.language_name'])
          ->leftJoin("languages", "languages.id", "=", "eventcategories.language_id")
          ->where("eventcategories.language_id", $lang_id)->get();

        $curcat = DB::table("eventcategories")
          ->where('group', '=', $category_id)
          ->where("language_id", $lang_id)
          ->first();

        return view('gca.events', [
          'newscat' => $category,
          'table' => $model,
          'curcat' => $curcat,
          'tenders' => $tenders,
          'events' => $events,
        ]);;
        break;
      case "tender":
        $model = DB::table("tenders")
          ->select(['tenders.*', 'languages.language_name', 'tendercategories.category_name'])
          ->leftJoin("languages", "languages.id", "=", "tenders.language_id")
          ->leftJoin("tendercategories", "tendercategories.group", "=", "tenders.tender_category_id")
          ->where('tenders.deadline', '>=', Carbon::now())
          ->where('tenders.title', '<>', '')
          ->where("tenders.language_id", $lang_id)
          ->where("tenders.tender_category_id", "=", $category_id)
          ->where("tendercategories.language_id", $lang_id)
          ->orderBy('id', 'desc')
          ->paginate(10);

        $category = DB::table("tendercategories")
          ->select(['tendercategories.*', 'languages.language_name'])
          ->leftJoin("languages", "languages.id", "=", "tendercategories.language_id")
          ->where("tendercategories.language_id", $lang_id)->get();

        $curcat = DB::table("tendercategories")
          ->where('group', '=', $category_id)
          ->where("language_id", $lang_id)
          ->first();

        return view('tender', [
          'newscat' => $category,
          'table' => $model,
          'curcat' => $curcat,
          'tenders' => $tenders,
          'events' => $events,
        ]);
        break;
      case "video":

        $category = DB::table("videogallerycategories")
          ->select(['videogallerycategories.*', 'languages.language_name'])
          ->leftJoin("languages", "languages.id", "=", "videogallerycategories.language_id")
          ->where("videogallerycategories.language_id", $lang_id)->get();

        $curcat = DB::table("videogallerycategories")
          ->where('group', '=', $category_id)
          ->where("language_id", $lang_id)
          ->first();

        $model = DB::table("videogallerycategories")
          ->select(['videogallerycategories.*', 'languages.language_name'])
          ->leftJoin("languages", "languages.id", "=", "videogallerycategories.language_id")
          ->where("videogallerycategories.group", "=", $category_id)
          ->where("videogallerycategories.language_id", $lang_id)
          ->orderBy('id', 'desc')
          ->paginate(10);

        return view('gca.video', [
          'newscat' => $category,
          'table' => $model,
          'tenders' => $tenders,
          'events' => $events,
          'curcat' => $curcat,
        ]);

        break;
      case "photo":
        $model = DB::table("photogallerycategories")
          ->select(['photogallerycategories.*', 'languages.language_name'])
          ->leftJoin("languages", "languages.id", "=", "photogallerycategories.language_id")
          ->where('photogallerycategories.group', '=', $category_id)
          ->where("photogallerycategories.language_id", $lang_id)
          ->orderBy('id', 'desc')
          ->paginate(10);

        $category = DB::table("photogallerycategories")
          ->select(['photogallerycategories.*', 'languages.language_name'])
          ->leftJoin("languages", "languages.id", "=", "photogallerycategories.language_id")
          ->where("photogallerycategories.language_id", $lang_id)->get();

        $curcat = DB::table("photogallerycategories")
          ->where('group', '=', $category_id)
          ->where("language_id", $lang_id)
          ->first();

        return view('gca.media', [
          'newscat' => $category,
          'table' => $model,
          'tenders' => $tenders,
          'events' => $events,
          'curcat' => $curcat,
        ]);
    }
  }

  public function allinin($lang_id, $name_tip, $category_id, $id)
  {
    $model = "";
    $tenders = Tender::take(3)->where('language_id', $lang_id)->get();
    $events = DB::table("events")
      ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
      ->leftJoin("languages", "languages.id", "=", "events.language_id")
      ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
      ->where("events.language_id", $lang_id)
      ->where("eventcategories.language_id", $lang_id)->take(5)->get();
    switch ($name_tip) {
      case "doc":
        $model = DB::table("docs")
          ->select(['docs.*', 'languages.language_name', 'doccategories.category_name'])
          ->leftJoin("languages", "languages.id", "=", "docs.language_id")
          ->leftJoin("doccategories", "doccategories.group", "=", "docs.doc_category_id")
          ->where("docs.language_id", $lang_id)
          ->where("docs.doc_category_id", "=", $category_id)
          ->where("docs.group", "=", $id)
          ->where("doccategories.language_id", $lang_id)
          ->first();

        $category = DB::table("doccategories")
          ->select(['doccategories.*', 'languages.language_name'])
          ->leftJoin("languages", "languages.id", "=", "doccategories.language_id")
          ->where("doccategories.language_id", $lang_id)->get();

        $curcat = DB::table("doccategories")
          ->where('group', '=', $category_id)
          ->where("language_id", $lang_id)
          ->first();

        return view('gca.doc', [
          'newscat' => $category,
          'table' => $model,
          'events' => $events,
          'tenders' => $tenders,
          'curcat' => $curcat,
        ]);
        break;
      case "event":
        // dd(1);
        $events = DB::table("events")
          ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
          ->leftJoin("languages", "languages.id", "=", "events.language_id")
          ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
          ->where("events.language_id", $lang_id)
          ->where("eventcategories.language_id", $lang_id)->take(5)->get();
        $model = DB::table("events")
          ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
          ->leftJoin("languages", "languages.id", "=", "events.language_id")
          ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
          ->where("events.language_id", $lang_id)
          ->where("events.event_category_id", "=", $category_id)
          ->where("events.group", "=", $id)
          ->where("eventcategories.language_id", $lang_id)
          ->first();

        $category = DB::table("eventcategories")
          ->select(['eventcategories.*', 'languages.language_name'])
          ->leftJoin("languages", "languages.id", "=", "eventcategories.language_id")
          ->where("eventcategories.language_id", $lang_id)->get();

        $curcat = DB::table("eventcategories")
          ->where('group', '=', $category_id)
          ->where("language_id", $lang_id)
          ->first();
        return view('gca.eventin', [
          'newscat' => $category,
          'table' => $model,
          'tenders' => $tenders,
          'events' => $events,
          'curcat' => $curcat,
        ]);;
        break;
      case "tender":
        $events = DB::table("events")
          ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
          ->leftJoin("languages", "languages.id", "=", "events.language_id")
          ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
          ->where("events.language_id", $lang_id)
          ->where("eventcategories.language_id", $lang_id)->take(5)->get();
        $model = DB::table("tenders")
          ->select(['tenders.*', 'languages.language_name', 'tendercategories.category_name'])
          ->leftJoin("languages", "languages.id", "=", "tenders.language_id")
          ->leftJoin("tendercategories", "tendercategories.group", "=", "tenders.tender_category_id")
          ->where("tenders.language_id", $lang_id)
          ->where("tenders.tender_category_id", "=", $category_id)
          ->where("tenders.group", "=", $id)
          ->where("tendercategories.language_id", $lang_id)
          ->first();


        $category = DB::table("tendercategories")
          ->select(['tendercategories.*', 'languages.language_name'])
          ->leftJoin("languages", "languages.id", "=", "tendercategories.language_id")
          ->where("tendercategories.language_id", $lang_id)->get();

        $curcat = DB::table("tendercategories")
          ->where('group', '=', $category_id)
          ->where("language_id", $lang_id)
          ->first();

        return view('tenderin', [
          'newscat' => $category,
          'table' => $model,
          'curcat' => $curcat,
          'evnets' => $events,
          'tenders' => $tenders,
        ]);
        break;
      case "video":
        $events = DB::table("events")
          ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
          ->leftJoin("languages", "languages.id", "=", "events.language_id")
          ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
          ->where("events.language_id", $lang_id)
          ->where("eventcategories.language_id", $lang_id)->take(5)->get();

        $model = DB::table("videogalleries")
          ->select(['videogalleries.*', 'languages.language_name'])
          ->leftJoin("languages", "languages.id", "=", "videogalleries.language_id")
          ->where("videogalleries.language_id", $lang_id)
          ->where("videogalleries.category_id", "=", $category_id)
          ->orderBy('created_at', 'desc')
          ->paginate(10);
        $category = DB::table("videogallerycategories")
          ->select(['videogallerycategories.*', 'languages.language_name'])
          ->leftJoin("languages", "languages.id", "=", "videogallerycategories.language_id")
          ->where("videogallerycategories.language_id", $lang_id)->get();

        $curcat = DB::table("videogallerycategories")
          ->where('group', '=', $category_id)
          ->where("language_id", $lang_id)
          ->first();
        return view('gca.videoin', [
          'newscat' => $category,
          'table' => $model,
          'events' => $events,
          'tenders' => $tenders,
          'curcat' => $curcat,
        ]);
        break;
      case "photo":
        $events = DB::table("events")
          ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
          ->leftJoin("languages", "languages.id", "=", "events.language_id")
          ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
          ->where("events.language_id", $lang_id)
          ->where("eventcategories.language_id", $lang_id)->take(5)->get();
        $model = DB::table("photogalleries")
          ->select(['photogalleries.*', 'languages.language_name'])
          ->leftJoin("languages", "languages.id", "=", "photogalleries.language_id")
          ->where("photogalleries.language_id", $lang_id)
          ->where("photogalleries.category_id", "=", $category_id)
          ->paginate(10);
        $category = DB::table("photogallerycategories")
          ->select(['photogallerycategories.*', 'languages.language_name'])
          ->leftJoin("languages", "languages.id", "=", "photogallerycategories.language_id")
          ->where("photogallerycategories.language_id", $lang_id)->get();
        $curcat = DB::table("photogallerycategories")
          ->where('group', '=', $category_id)
          ->where("language_id", $lang_id)
          ->first();
        return view('gca.mediain', [
          'newscat' => $category,
          'table' => $model,
          'evnets' => $events,
          'curcat' => $curcat,
          'tenders' => $tenders,
        ]);
        break;
    }
  }

  public function download(Request $request)
  {
    // dd($request->all());
    $type = $request->input("type");
    $id = $request->input("id");
    //PDF file is stored under project/public/download/info.

    switch ($type) {
      case "video":
        $bk = DB::table("videogallerycategories")
          ->where("group", "=", $id)->first();
        return response()->download(storage_path("app/public/upload/" . $bk->cover));
        break;
      case "event":
        $bk = DB::table("events")
          ->where("group", "=", $id)->first();
        return response()->download(storage_path("app/public/upload/" . $bk->cover));
        break;
      case "tenders":
        $bk = DB::table("tenders")
          ->where("group", "=", $id)->first();
        return response()->download(storage_path("app/public/upload/" . $bk->cover));
        break;
      case "videoin":
        $bk = DB::table("videogalleries")
          ->where("videogalleries.id", "=", $id)->first();
        $fileContents = File::get(storage_path("app/public/upload/" . $bk->cover));
        $response = Response::make($fileContents, 200);
        $response->header('Content-Type', "video/mp4");
        $i = 0;
        return $response;
        break;
      case "photo":
        $bk = DB::table("photogallerycategories")
          ->where("group", "=", $id)->first();
        return response()->download(storage_path("app/public/upload/" . $bk->cover));
        break;
      case "docs":
        $bk = DB::table("docs")
          ->where("group", "=", $id)->first();
        return response()->download(storage_path("app/public/upload/" . $bk->files));
        break;
      case "photoin":
        $bk = DB::table("photogalleries")
          ->where("photogalleries.id", "=", $id)->first();
        return response()->download(storage_path("app/public/upload/" . $bk->cover));
        break;

      case "post":
        $bk = DB::table("posts")
          ->where("posts.group", "=", $id)->first();
        return response()->download(storage_path("app/public/upload/" . $bk->cover));
        break;
      case "page":
        $bk = DB::table("pages_groups")
          ->where("pages_groups.id", "=", $id)->first();
        return response()->download(storage_path("app/public/photos/1/" . $bk->photo_url));
        break;
      case "doc":
        $bk = DB::table("docs")
          ->where("docs.id", "=", $id)->first();
        return response()->download(storage_path("app/public/upload/" . $bk->files));
        break;
      case "statistica":
        $bk = DB::table("statisticas")
          ->where("id", "=", $id)->first();
        return response()->download(storage_path("app/public/upload/" . $bk->photo_url));
        break;
      case "raxbariyat":
        $bk = DB::table("raxbariyats")
          ->where("id", "=", $id)->first();
        return response()->download(storage_path("app/public/upload/" . $bk->photo_url));
        break;
      case "link":
        $bk = DB::table("links")
          ->where("id", "=", $id)->first();
        return response()->download(storage_path("app/public/upload/" . $bk->photo_url));
        break;
      case "years":
        $bk = DB::table("years")
          ->where("id", "=", $id)->first();
        return response()->download(storage_path("app/public/upload/" . $bk->photo_url));
        break;
    }
  }

  public static function Images($url)
  {
    return response()->download(storage_path("app/public/upload/" . $url));
  }

  public function TenderFilter(Request $request)
  {
    $lang_id = current_language()->id;
    $tenders = Tender::take(3)->where('language_id', $lang_id)->get();
    $events = DB::table("events")
      ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
      ->leftJoin("languages", "languages.id", "=", "events.language_id")
      ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
      ->where("events.language_id", $lang_id)
      ->where("eventcategories.language_id", $lang_id)->take(5)->get();
    if ($request->has('start') && $request->has('finish') && $request->input('status') == 0) {
      $model = DB::table("tenders")
        ->select(['tenders.*', 'languages.language_name', 'tendercategories.category_name'])
        ->leftJoin("languages", "languages.id", "=", "tenders.language_id")
        ->leftJoin("tendercategories", "tendercategories.group", "=", "tenders.tender_category_id")
        ->whereBetween('tenders.created_at', array($request->start, $request->finish))
        ->where('tenders.deadline', '>=', Carbon::now())
        ->where('tenders.title', '<>', '')
        ->where("tenders.language_id", $lang_id)
        ->where("tenders.tender_category_id", "=", $request->cutcat)
        ->where("tendercategories.language_id", $lang_id)
        ->orderBy('id', 'desc')
        ->paginate(10);
    } elseif ($request->has('start') && $request->has('finish') && $request->input('status') == 1) {
      $model = DB::table("tenders")
        ->select(['tenders.*', 'languages.language_name', 'tendercategories.category_name'])
        ->leftJoin("languages", "languages.id", "=", "tenders.language_id")
        ->leftJoin("tendercategories", "tendercategories.group", "=", "tenders.tender_category_id")
        ->whereBetween('tenders.created_at', array($request->start, $request->finish))
        ->where('tenders.deadline', '<', Carbon::now())
        ->where('tenders.title', '<>', '')
        ->where("tenders.language_id", $lang_id)
        ->where("tenders.tender_category_id", "=", $request->cutcat)
        ->where("tendercategories.language_id", $lang_id)
        ->orderBy('id', 'desc')
        ->paginate(10);
    }
    if ($request->input('status') == 0) {
      $model = DB::table("tenders")
        ->select(['tenders.*', 'languages.language_name', 'tendercategories.category_name'])
        ->leftJoin("languages", "languages.id", "=", "tenders.language_id")
        ->leftJoin("tendercategories", "tendercategories.group", "=", "tenders.tender_category_id")
        ->where('tenders.deadline', '>=', Carbon::now())
        ->where('tenders.title', '<>', '')
        ->where("tenders.language_id", $lang_id)
        ->where("tenders.tender_category_id", "=", $request->cutcat)
        ->where("tendercategories.language_id", $lang_id)
        ->orderBy('id', 'desc')
        ->paginate(10);
    } else {
      $model = DB::table("tenders")
        ->select(['tenders.*', 'languages.language_name', 'tendercategories.category_name'])
        ->leftJoin("languages", "languages.id", "=", "tenders.language_id")
        ->leftJoin("tendercategories", "tendercategories.group", "=", "tenders.tender_category_id")
        ->where('tenders.deadline', '<', Carbon::now())
        ->where('tenders.title', '<>', '')
        ->where("tenders.language_id", $lang_id)
        ->where("tenders.tender_category_id", "=", $request->cutcat)
        ->where("tendercategories.language_id", $lang_id)
        ->orderBy('id', 'desc')
        ->paginate(10);
    }

    $category = DB::table("tendercategories")
      ->select(['tendercategories.*', 'languages.language_name'])
      ->leftJoin("languages", "languages.id", "=", "tendercategories.language_id")
      ->where("tendercategories.language_id", $lang_id)->get();

    $curcat = DB::table("tendercategories")
      ->where('group', '=', $request->cutcat)
      ->where("language_id", $lang_id)
      ->first();

    return view('tender', [
      'newscat' => $category,
      'table' => $model,
      'curcat' => $curcat,
      'tenders' => $tenders,
      'events' => $events
    ]);
  }

  public function sorov(Request $request)
  {
    $lang_id = current_language()->id;
    $savol = DB::table("sorovnomas")
      ->select(['sorovnomas.*', 'languages.language_name'])
      ->leftJoin("languages", "languages.id", "=", "sorovnomas.language_id")
      ->where("sorovnomas.language_id", $lang_id)
      ->first();
    $type = DB::table("sorovvotes")->where("ip", "=", Session::getId())->first();
    if ($type) {
      $tb = DB::table("sorovnoma_atters")
        ->select(['sorovnoma_atters.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "sorovnoma_atters.language_id")
        ->where("sorovnoma_atters.language_id", "=", $this->current_lang_id())
        ->where("sorovnoma_atters.savol_id", "=", $savol->group)->get();

      $total = 0;
      foreach ($tb as $value) {
        $tot = Sorovvote::where("javob_grp_id", "=", $value->group)->count();
        $total += $tot;
      }

      $table_return = [];
      foreach ($tb as $key => $value) {
        $counts = (\App\Http\Controllers\Admin\SorovnomaController::getsorovs($value->group) * 100) / $total;
        array_push($table_return, ['text' => $value->javob, 'count' => $counts, 'count_round' => round($counts)]);
      }

      return [
        'savol' => $savol->savol,
        'javob' => $table_return,
        'type' => 'stat',
      ];
    } else {
      $tb = DB::table("sorovnoma_atters")
        ->select(['sorovnoma_atters.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "sorovnoma_atters.language_id")
        ->where("sorovnoma_atters.language_id", $lang_id)
        ->where("sorovnoma_atters.savol_id", "=", $savol->group)->get();
      return [
        'savol' => $savol->savol,
        'javob' => $tb,
        'type' => 'check',
      ];
    }
  }

  public function EventFilter(Request $request)
  {
    $lang_id = current_language()->id;
    $tenders = Tender::take(3)->where('language_id', $lang_id)->get();
    $events = DB::table("events")
      ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
      ->leftJoin("languages", "languages.id", "=", "events.language_id")
      ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
      ->where("events.language_id", $lang_id)
      ->where("eventcategories.language_id", $lang_id)->take(5)->get();

    $model = DB::table("events")
      ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
      ->leftJoin("languages", "languages.id", "=", "events.language_id")
      ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
      ->whereBetween('events.created_at', array($request->start, $request->finish))
      ->where('events.title', '<>', '')
      ->where("events.language_id", $lang_id)
      ->where("events.event_category_id", "=", $request->cutcat)
      ->where("eventcategories.language_id", $lang_id)
      ->orderBy('id', 'desc')
      ->paginate(10);

    $category = DB::table("eventcategories")
      ->select(['eventcategories.*', 'languages.language_name'])
      ->leftJoin("languages", "languages.id", "=", "eventcategories.language_id")
      ->where("eventcategories.language_id", $lang_id)->get();

    $curcat = DB::table("eventcategories")
      ->where('group', '=', $request->cutcat)
      ->where("language_id", $lang_id)
      ->first();

    return view('event', [
      'newscat' => $category,
      'table' => $model,
      'curcat' => $curcat,
      'tenders' => $tenders,
      'events' => $events
    ]);
  }
}

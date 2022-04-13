<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Event;
use App\Models\Language;
use App\Models\Statistics;
use App\Models\Raxbariyat;
use Carbon\CarbonPeriod;
use App\Models\Post;
use App\Models\Tender;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FrontController extends Controller
{
  public function index()
  {
    $lang_id = current_language()->id;
    // dd($lang_id);
    $eventsDate = Event::select('datestart', 'dateend')->get();
    $eventDates = [];

    foreach ($eventsDate as $item) {
      $dateRange = CarbonPeriod::create($item->datestart, $item->dateend);

      foreach ($dateRange as $date) {
        $eventDates[] = $date->format('Y-m-d');
      }
    }

    $statisticas = Statistics::where('photo_url', '<>', '')->where("language_id", "=", $lang_id)->orderBy('id', 'desc')->take(10)->get();

    // $events = DB::table("events")
    //   ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
    //   ->leftJoin("languages", "languages.id", "=", "events.language_id")
    //   ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
    //   ->where('events.title', '<>', '')
    //   ->where("events.language_id", "=", $lang_id)
    //   ->where("eventcategories.language_id", "=", $lang_id)->take(5)
    //   ->orderBy('id', 'desc')->where('title', '<>', '')
    //   ->orderBy('id', 'desc')->take(2)
    //   ->get();

    $events = Event::where('language_id', $lang_id)
      ->whereDate('dateend', '>=', now())
      ->with('category')
      // ->with('language')
      ->latest()
      ->take(3)
      ->get();

    $photos = DB::table("photogalleries")
      ->select(['photogalleries.*', 'languages.language_name', 'photogallerycategories.title'])
      ->leftJoin("languages", "languages.id", "=", "photogalleries.language_id")
      ->leftJoin("photogallerycategories", "photogallerycategories.group", "=", "photogalleries.category_id")
      ->where("photogalleries.language_id", "=", $lang_id)
      ->where("photogallerycategories.language_id", "=", $lang_id)
      ->orderBy('created_at', 'desc')
      ->get();

    $videos = DB::table("videogalleries")
      ->select(['videogalleries.*', 'languages.language_name', 'videogallerycategories.title'])
      ->leftJoin("languages", "languages.id", "=", "videogalleries.language_id")
      ->leftJoin("videogallerycategories", "videogallerycategories.group", "=", "videogalleries.category_id")
      ->where("videogalleries.language_id", "=", $lang_id)
      ->where("videogallerycategories.language_id", "=", $lang_id)
      ->orderBy('created_at', 'desc')
      ->get();

    $media_gallery = $photos->merge($videos)->sortByDesc('created_at');
    // dd($media_gallery);

    $docs = Document::where('doc_category_id', 1603263016)
      ->where('language_id', $lang_id)
      ->orderBy('id', 'desc')
      ->get();

    if (count($docs) >= 4) {
      $docs->take(3);
    }

    // $posts = Post::where('category_group_id', '=', '1603259067')->where('language_id', '=', $lang_id)->orderBy('id', 'desc')->where('title', '<>', '')->take(2)->get();
    // $posts_publications = Post::where('category_group_id', '=', '1603259189')->where('language_id', '=', $lang_id)->orderBy('id', 'desc')->where('title', '<>', '')->take(3)->get();
    $posts = Post::where('language_id', $lang_id)->where("category_group_id", "!=", "1615268167")->latest()->take(4)->get();
    $posts_publications = Post::where('language_id', $lang_id)->where("category_group_id", "!=", "1615268167")->latest()->skip(3)->take(4)->get();

    $posts_for = Post::where('category_group_id', '=', '1603259067')->where('language_id', '=', $lang_id)->orderBy('id', 'desc')->where('title', '<>', '')->get();

    if (count($posts_for) > 4)
      $posts_for->random(4);

    // $languages = Language::get();
    $tenders = Tender::where('title', '<>', '')->where('language_id', '=', $lang_id)->orderBy('id', 'desc')->where('title', '<>', '')->take(3)->get();
    $suv_xujaliks = DB::table('pages')
      ->leftJoin('pages_groups', 'pages_groups.id', 'pages.page_group_id')
      ->leftJoin('languages', 'languages.id', 'pages.language_id')
      ->select('pages.*', 'languages.language_name', 'languages.language_prefix', 'pages_groups.photo_url')
      ->where('pages.title', '<>', '')
      ->where('pages.page_category_group_id', 1)
      ->where('languages.language_prefix', app()->currentLocale())
      ->get();

    return view('gca.index')
      ->with('suv_xujaliks', $suv_xujaliks)
      ->with('posts', $posts)
      ->with('posts_for', $posts_for)
      ->with('statisticas', $statisticas)
      ->with('tenders', $tenders)
      ->with('eventDates', $eventDates)
      ->with('docs', $docs)
      ->with('media_gallery', $media_gallery)
      ->with('posts_publications', $posts_publications)
      ->with('events', $events);
  }

  public function getStatistika()
  {
    $lang_id = current_language()->id;
    $posts = Post::take(6)->where('category_group_id', '=', '1545735855')->where('language_id', $lang_id)->orderBy('id', 'desc')->where('title', '<>', '')->get();
    $tenders = Tender::take(3)->where('title', '<>', '')->where('language_id', $lang_id)->orderBy('id', 'desc')->where('title', '<>', '')->get();
    $statistica = Statistics::where('photo_url', '<>', '')->where('language_id', $lang_id)->paginate(10);

    return view('statistica')
      ->with('posts', $posts)
      ->with('tenders', $tenders)
      ->with('table', $statistica);
  }

  public function getRaxbariyat()
  {
    $lang_id = current_language()->id;
    $posts = Post::take(6)->where('category_group_id', '=', '1545735855')->where('language_id', $lang_id)->orderBy('id', 'desc')->where('title', '<>', '')->get();
    $languages = Language::get();
    $tenders = Tender::take(3)->where('title', '<>', '')->where('language_id', $lang_id)->orderBy('id', 'desc')->where('title', '<>', '')->get();
    $raxbariyat = Raxbariyat::where('fio', '<>', '')->where('language_id', $lang_id)->paginate(10);

    return view('raxbariyat')
      ->with('posts', $posts)
      ->with('tenders', $tenders)
      ->with('raxbariyat', $raxbariyat);
  }

  public function page(Request $request)
  {
    $lang_id = current_language()->id;

    $events = DB::table("events")
      ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
      ->leftJoin("languages", "languages.id", "=", "events.language_id")
      ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
      ->where('events.title', '<>', '')
      ->where("events.language_id", $lang_id)
      ->where("eventcategories.language_id", $lang_id)->take(5)
      ->orderBy('id', 'desc')
      ->get();

    $tenders = Tender::take(3)->where('title', '<>', '')->where('language_id', $lang_id)->orderBy('id', 'desc')->get();
    $page_categories = DB::table('pages')
      ->leftJoin('pages_groups', 'pages_groups.id', 'pages.page_group_id')
      ->leftJoin('languages', 'languages.id', 'pages.language_id')
      ->leftJoin('pages_categories', 'pages_categories.category_group_id', 'pages.page_category_group_id')
      ->select('pages.*', 'languages.language_name', 'languages.language_prefix', 'pages_groups.photo_url', 'pages_categories.category_name')
      ->where('pages_groups.status', '=', 1)
      ->where('pages.page_category_group_id', $request->category_id)
      ->where('pages_categories.language_id', $lang_id)
      ->where('pages.language_id', $lang_id)
      ->get();

    $page = DB::table('pages')
      ->leftJoin('pages_groups', 'pages_groups.id', 'pages.page_group_id')
      ->leftJoin('languages', 'languages.id', 'pages.language_id')
      ->leftJoin('pages_categories', 'pages_categories.category_group_id', 'pages.page_category_group_id')
      ->select('pages.*', 'languages.language_name', 'languages.language_prefix', 'pages_groups.photo_url', 'pages_categories.category_name')
      ->where('pages_groups.status', '=', 1)
      ->where('pages.page_category_group_id', $request->category_id)
      ->where('pages.page_group_id', $request->id)
      ->where('pages_categories.language_id', $lang_id)
      ->where('pages.language_id', $lang_id)
      ->first();

    return view('gca.pages')
      ->with('page_categories', $page_categories)
      ->with('events', $events)
      ->with('tenders', $tenders)
      ->with('page', $page);
  }

  public function pages(Request $request)
  {
    $lang_id = current_language()->id;

    $events = DB::table("events")
      ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
      ->leftJoin("languages", "languages.id", "=", "events.language_id")
      ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
      ->where('events.title', '<>', '')
      ->where("events.language_id", $lang_id)
      ->where("eventcategories.language_id", $lang_id)->take(5)
      ->orderBy('id', 'desc')
      ->get();
    $tenders = Tender::take(3)->where('title', '<>', '')->where('language_id', $lang_id)->orderBy('id', 'desc')->get();
    $page_categories = DB::table('pages')
      ->leftJoin('pages_groups', 'pages_groups.id', 'pages.page_group_id')
      ->leftJoin('languages', 'languages.id', 'pages.language_id')
      ->leftJoin('pages_categories', 'pages_categories.category_group_id', 'pages.page_category_group_id')
      ->select('pages.*', 'languages.language_name', 'languages.language_prefix', 'pages_groups.photo_url', 'pages_categories.category_name')
      ->where('pages_groups.status', '=', 1)
      ->where('pages.page_category_group_id', $request->category_id)
      ->where('pages_categories.language_id', $lang_id)
      ->where('pages.language_id', $lang_id)
      ->get();

    return view('pages_cat')
      ->with('page_categories', $page_categories)
      ->with('tenders', $tenders)
      ->with('events', $events);
  }

  public function post($category_id, $id)
  {
    $lang_id = current_language()->id;
    $events = DB::table("events")
      ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
      ->leftJoin("languages", "languages.id", "=", "events.language_id")
      ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
      ->where('events.title', '<>', '')
      ->where("events.language_id", $lang_id)
      ->where("eventcategories.language_id", $lang_id)->take(5)
      ->orderBy('id', 'desc')
      ->get();
    $page_categories = DB::table('postgroups')
      ->leftJoin('posts', 'posts.group', 'postgroups.id')
      ->leftJoin('languages', 'languages.id', 'posts.language_id')
      ->leftJoin('postcategories', 'postcategories.group', 'postgroups.post_category_group_id')
      ->select('posts.*', 'languages.language_name', 'languages.language_prefix', 'posts.cover', 'postcategories.category_name')
      ->where('postgroups.post_category_group_id', $category_id)
      ->where('postcategories.language_id', $lang_id)
      ->where('posts.language_id', $lang_id)
      ->get();

    $page = DB::table('pages')
      ->leftJoin('pages_groups', 'pages_groups.id', 'pages.page_group_id')
      ->leftJoin('languages', 'languages.id', 'pages.language_id')
      ->leftJoin('pages_categories', 'pages_categories.category_group_id', 'pages.page_category_group_id')
      ->select('pages.*', 'languages.language_name', 'languages.language_prefix', 'pages_groups.photo_url', 'pages_categories.category_name')
      ->where('pages.page_category_group_id', $category_id)
      ->where('pages.page_group_id', $id)
      ->where('pages_categories.language_id', $lang_id)
      ->where('pages.language_id', $lang_id)
      ->first();

    return view('pages')
      ->with('page_categories', $page_categories)
      ->with('event', $events)
      ->with('events', $events)
      ->with('page', $page);
  }
}

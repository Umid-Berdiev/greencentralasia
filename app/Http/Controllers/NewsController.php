<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\PostGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tender;

class NewsController extends Controller
{
  public function index($lang, $cat_id)
  {
    $lang_id = current_language()->id;
    $events = DB::table("events")
      ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
      ->leftJoin("languages", "languages.id", "=", "events.language_id")
      ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
      ->where('events.title', '<>', '')
      ->where("events.language_id", $lang_id)
      ->where("eventcategories.language_id", $lang_id)->take(5)->orderBy('id', 'desc')->get();
    $tenders = Tender::take(3)->where('title', '<>', '')->where('language_id', $lang_id)->orderBy('id', 'desc')->get();
    $curcat = DB::table("postcategories")->where('group', '=', $cat_id)->where('language_id', $lang_id)->first();
    $category = DB::table("postcategories")
      ->select(['postcategories.*', 'languages.language_name'])
      ->leftJoin("languages", "languages.id", "=", "postcategories.language_id")
      ->where("language_id", $lang_id)->get();

    $news = DB::table("postgroups")
      ->select(['postcategories.category_name', 'languages.language_name', 'posts.*', 'postgroups.viewcount', 'postgroups.id'])
      ->join("posts", "posts.group", "=", "postgroups.id")
      ->leftJoin("languages", "languages.id", "=", "posts.language_id")
      ->leftJoin("postcategories", "postcategories.id", "=", "postgroups.post_category_group_id")
      ->where("posts.language_id", $lang_id)
      ->where('posts.title', '<>', '')
      ->where("postgroups.post_category_group_id", $cat_id == 1615268167 ? "=" : "!=", $cat_id == 1615268167 ? "1615268167" : "1615268167")
      ->orderBy('posts.id', 'desc')
      ->paginate(16);

    return view('gca.posts', [
      'newscat' => $category,
      'tenders' => $tenders,
      'news' => $news,
      'events' => $events,
      'curcat' => $curcat,
    ]);
  }

  public function indexin($lang, $cat_id, $title)
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
    $news_in = DB::table("postgroups")
      ->select(['postcategories.category_name', 'languages.language_name', 'posts.*', 'postgroups.id'])
      ->join("posts", "posts.group", "=", "postgroups.id")
      ->leftJoin("languages", "languages.id", "=", "posts.language_id")
      ->leftJoin("postcategories", "postcategories.id", "=", "postgroups.post_category_group_id")
      ->where("posts.language_id", $lang_id)
      ->where("postgroups.post_category_group_id", "=", $cat_id)
      ->orderBy('posts.id', 'desc')->take(3)->get();
    $curcat = DB::table("postcategories")->where('group', '=', $cat_id)->where('language_id', $lang_id)->first();

    $category = DB::table("postcategories")
      ->select(['postcategories.*', 'languages.language_name'])
      ->leftJoin("languages", "languages.id", "=", "postcategories.language_id")
      ->where("language_id", $lang_id)->get();

    $news = DB::table("postgroups")
      ->select(['postcategories.category_name', 'languages.language_name', 'posts.*', 'postgroups.viewcount', 'postgroups.id'])
      ->join("posts", "posts.group", "=", "postgroups.id")
      ->leftJoin("languages", "languages.id", "=", "posts.language_id")
      ->leftJoin("postcategories", "postcategories.id", "=", "postgroups.post_category_group_id")
      ->where("posts.language_id", $lang_id)
      ->where("postgroups.post_category_group_id", $cat_id == 1615268167 ? "=" : "!=", $cat_id == 1615268167 ? "1615268167" : "1615268167")
      ->where("postgroups.id", "=", $title)
      ->first();
    $lastcount = $news->viewcount;
    $grpupd = PostGroup::where("id", "=", $news->id)->first();
    $grpupd->viewcount = $lastcount + 1;
    $grpupd->update();

    return view('gca.post', [
      'newscat' => $category,
      'news' => $news,
      'news_in' => $news_in,
      'events' => $events,
      'tenders' => $tenders,
      'curcat' => $curcat,
    ]);
  }

  public function download($id)
  {
    $bk = DB::table("posts")
      ->where("group", "=", $id)->first();

    return response()->download(storage_path("app/" . $bk->cover));
  }

  public function PostsFilter(Request $request)
  {
    $lang_id = current_language()->id;
    $news = DB::table("postgroups")
      ->select(['postcategories.category_name', 'languages.language_name', 'posts.*', 'postgroups.viewcount', 'postgroups.id'])
      ->join("posts", "posts.group", "=", "postgroups.id")
      ->leftJoin("languages", "languages.id", "=", "posts.language_id")
      ->leftJoin("postcategories", "postcategories.id", "=", "postgroups.post_category_group_id")
      ->whereBetween('posts.datetime', array($request->start, $request->finish))
      ->where("posts.language_id", $lang_id)
      ->where('posts.title', '<>', '')
      ->where("postgroups.post_category_group_id", "=", $request->cutcat)
      ->orderBy('posts.id', 'desc')
      ->paginate(10);

    $events = DB::table("events")
      ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
      ->leftJoin("languages", "languages.id", "=", "events.language_id")
      ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
      ->where('events.title', '<>', '')
      ->where("events.language_id", $lang_id)
      ->where("eventcategories.language_id", $lang_id)->take(5)->orderBy('id', 'desc')->get();
    $tenders = Tender::take(3)->where('title', '<>', '')->where('language_id', $lang_id)->orderBy('id', 'desc')->get();
    $curcat = DB::table("postcategories")->where('group', '=', $request->cutcat)->where('language_id', $lang_id)->first();
    $category = DB::table("postcategories")
      ->select(['postcategories.*', 'languages.language_name'])
      ->leftJoin("languages", "languages.id", "=", "postcategories.language_id")
      ->where("language_id", $lang_id)->get();

    return view('news', [
      'newscat' => $category,
      'tenders' => $tenders,
      'news' => $news,
      'events' => $events,
      'curcat' => $curcat
    ]);
  }
}

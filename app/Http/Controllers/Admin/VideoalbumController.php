<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use App\Models\Videoalbum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class VideoalbumController extends Controller
{
  public function index(Request $request)
  {
    $lang_id = current_language()->id;

    if ($request->has("search")) {
      $model = DB::table("videogallerycategories")
        ->select(['videogallerycategories.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "videogallerycategories.language_id")
        ->where("videogallerycategories.language_id", $lang_id)
        ->where("videogallerycategories.title", "LIKE", '%' . $request->input("search") . '%')->paginate(10);
    } else {
      $model = DB::table("videogallerycategories")
        ->select(['videogallerycategories.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "videogallerycategories.language_id")
        ->where("language_id", $lang_id)
        ->orderBy('id', 'desc')
        ->paginate(10);
    }

    return view("admin.videoalbum.index", [
      "table" => $model
    ]);
  }

  public function create()
  {
    return view("admin.videoalbum.create");
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'titles.*' => 'required|max:40',
      'language_ids.*' => 'required',
      'descriptions.*' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $grp_id = $this->getGroupId();

    foreach ($request->language_ids as $key => $value) {
      $model = new Videoalbum();
      $model->title = $request->titles[$key];
      $model->Description = $request->descriptions[$key];
      $model->language_id = $value;
      $model->group = $grp_id;

      if ($request->hasFile("cover")) {
        $model->cover = $request->file('cover')->getClientOriginalName();
        Storage::putFileAs('public/video-categories', $request->file('cover'), $request->file('cover')->getClientOriginalName());
      } else $model->cover = "videogallery.png";

      $model->save();
    }

    return redirect(route('videoalbum.edit', $model->group))->with('success', 'Created!');
  }

  public function edit(Request $request, $id)
  {
    $model  = Videoalbum::where("group", $id)->get();

    return view("admin.videoalbum.edit", [
      "model" => $model,
      "grp_id" => $id
    ]);
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'titles.*' => 'required|max:40',
      'language_ids.*' => 'required',
      'descriptions.*' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $grp_id = $id;

    foreach ($request->language_ids as $key => $value) {
      $model = Videoalbum::where("group", $grp_id)
        ->where("language_id", $value)
        ->first();
      $model->title = $request->titles[$key];
      $model->Description = $request->descriptions[$key];

      if ($request->hasFile("cover")) {
        $model->cover = $request->file('cover')->getClientOriginalName();
        Storage::putFileAs('public/video-categories', $request->file('cover'), $request->file('cover')->getClientOriginalName());
      } else $model->cover = "videogallery.png";

      if ($request->remove_cover == "on") {
        $model->cover = "videogallery.png";
      }

      $model->update();
    }

    return back()->with('success', 'Updated!');
  }

  public function destroy(Request $request, $id)
  {
    Videoalbum::where("group", $id)->delete();
    return redirect(route('videoalbum.index'))->with('success', 'Deleted!');
  }

  private function getGroupId()
  {
    return time();
  }
}

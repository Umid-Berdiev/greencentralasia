<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use App\Models\Photogallery;
use App\Models\PhotoCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PhotoController extends Controller
{
  public function index(Request $request)
  {
    $lang_id = current_language()->id;

    if ($request->has("search")) {
      $model = DB::table("photogalleries")
        ->select(['photogalleries.*', 'languages.language_name', 'photogallerycategories.title'])
        ->leftJoin("languages", "languages.id", "=", "photogalleries.language_id")
        ->leftJoin("photogallerycategories", "photogallerycategories.group", "=", "photogalleries.category_id")
        ->where("photogalleries.language_id", "=", $lang_id)
        ->where("photogallerycategories.language_id", "=", $lang_id)
        ->where("photogalleries.name", "LIKE", '%' . $request->search . '%')
        ->orWhere("photogalleries.name", "LIKE", '%' . $request->search . '%')
        ->orWhere("photogalleries.description", "LIKE", '%' . $request->search . '%')
        ->orderBy('id', 'desc')
        ->paginate(10);
    } else {
      $model = DB::table("photogalleries")
        ->select(['photogalleries.*', 'languages.language_name', 'photogallerycategories.title'])
        ->leftJoin("languages", "languages.id", "=", "photogalleries.language_id")
        ->leftJoin("photogallerycategories", "photogallerycategories.group", "=", "photogalleries.category_id")
        ->where("photogalleries.language_id", "=", $lang_id)
        ->where("photogallerycategories.language_id", "=", $lang_id)
        ->orderBy('id', 'desc')
        ->paginate(10);
    }

    $doccat = PhotoCategory::where("language_id", $lang_id)->get();

    return view("admin.photo.index", [
      "table" => $model,
      "category" => $doccat
    ]);
  }

  public function create()
  {
    $lang_id = current_language()->id;
    $doccat = PhotoCategory::where("language_id", $lang_id)->get();

    return view("admin.photo.create", [
      "category" => $doccat
    ]);
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'names.*' => 'required|max:255',
      'descriptions.*' => 'required|max:255',
      'cover' => 'required'
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $grp_id = $this->getGroupId();

    foreach ($request->language_ids as $key => $value) {
      $model = new Photogallery();
      $model->name = $request->names[$key];
      $model->description = $request->descriptions[$key];
      $model->category_id = $request->category_id;
      $model->group = $grp_id;
      $model->language_id = $value;

      if ($request->hasFile("cover")) {
        $file = $request->file('cover');
        $file_name = 'photo_' . time() . '.' . $file->clientExtension();
        $model->cover = $file_name;
        Storage::putFileAs('public/photos', $file, $file_name);
      }

      $model->save();
    }

    return redirect(route('photos.edit', $model->group))->with('success', 'Created!');
  }

  public function edit(Request $request, $id)
  {
    $lang_id = current_language()->id;
    $model  = Photogallery::where("group", $id)->get();
    $doccat = PhotoCategory::where("language_id", $lang_id)->get();

    return view("admin.photo.edit", [
      "model" => $model,
      "grp_id" => $id,
      "category" => $doccat
    ]);
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'names.*' => 'required|max:255',
      'descriptions.*' => 'required|max:255',
      'cover' => 'required'
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    foreach ($request->language_ids as $key => $value) {
      $model = Photogallery::where("group", $id)
        ->where("language_id", $value)
        ->first();
      $model->name = $request->names[$key];
      $model->description = $request->descriptions[$key];
      $model->category_id = $request->category_id;
      $model->group = $id;
      $model->language_id = $value;

      if ($request->hasFile("cover")) {
        $file = $request->file('cover');
        $file_name = 'link_' . time() . '.' . $file->clientExtension();
        $model->cover = $file_name;
        Storage::putFileAs('public/photos', $file, $file_name);
      } else {
        $model->cover = "null";
      }

      if ($request->remove_cover == "on") {
        $model->cover = "null";
      }

      $model->update();
    }

    return back()->with('success', 'Updated!');
  }

  public function destroy(Request $request, $id)
  {
    Photogallery::where("group", $id)->delete();
    return redirect(route('photos.index'))->with('success', 'Deleted!');
  }

  private function getGroupId()
  {
    return time();
  }
}

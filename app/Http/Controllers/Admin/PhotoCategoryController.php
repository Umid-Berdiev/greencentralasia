<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use App\Models\PhotoCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PhotoCategoryController extends Controller
{
  public function index(Request $request)
  {
    $lang_id = current_language()->id;

    if ($request->has("search")) {
      $model = DB::table("photogallerycategories")
        ->select(['photogallerycategories.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "photogallerycategories.language_id")
        ->where("photogallerycategories.language_id", "=", $lang_id)
        ->where("photogallerycategories.title", "LIKE", '%' . $request->search . '%')
        ->orderBy('id', 'desc')
        ->paginate(10);
    } else {
      $model = DB::table("photogallerycategories")
        ->select(['photogallerycategories.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "photogallerycategories.language_id")
        ->where("language_id", "=", $lang_id)
        ->orderBy('id', 'desc')
        ->paginate(10);
    }

    return view("admin.photo_category.index", [
      "table" => $model
    ]);
  }

  public function create()
  {
    return view("admin.photo_category.create");
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'titles.*' => 'required|max:40',
      'descriptions.*' => 'required',
      // 'cover' => 'required'
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $grp_id = $this->getGroupId();

    foreach ($request->language_ids as $key => $value) {
      $model = new PhotoCategory();
      $model->title = $request->titles[$key] ?? null;
      $model->Description = $request->descriptions[$key] ?? null;
      $model->language_id = $value;
      $model->group = $grp_id;

      if ($request->hasFile("cover")) {
        $file = $request->file('photos');
        $file_name = 'photo_category_' . time() . '.' . $file->clientExtension();
        $model->cover = $file_name;
        Storage::putFileAs('public/photo-categories', $file, $file_name);
      } else $model->cover = "photo-category_default.png";

      $model->save();
    }

    return redirect(route('photo-categories.edit', $model->group))->with('success', 'Created!');
  }

  public function edit(Request $request, $id)
  {
    $model  = PhotoCategory::where('group', $id)->get();

    return view("admin.photo_category.edit", [
      "model" => $model,
      "grp_id" => $id
    ]);
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'titles.*' => 'required|max:40',
      'descriptions.*' => 'required',
      // 'cover' => 'required'
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    foreach ($request->language_ids as $key => $value) {
      $model = PhotoCategory::where("group", $id)
        ->where("language_id", $value)
        ->first();
      $model->title = $request->titles[$key] ?? null;
      $model->Description = $request->descriptions[$key] ?? null;

      if ($request->hasFile("cover")) {
        $file = $request->file('photos');
        $file_name = 'photo_category_' . time() . '.' . $file->clientExtension();
        $model->cover = $file_name;
        Storage::putFileAs('public/photo-categories', $file, $file_name);
      } else $model->cover = "photo-category_default.png";

      if ($request->remove_cover == "on") {
        $model->cover = "photo-category_default.png";
      }

      $model->update();
    }

    return back()->with('success', 'Updated!');
  }

  public function destroy(Request $request, $id)
  {
    PhotoCategory::where("group", $id)->delete();
    return back()->with('success', 'Deleted!');
  }

  private function getGroupId()
  {
    return time();
  }
}

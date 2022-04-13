<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tendercategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TendercategoryController extends Controller
{
  public function index(Request $request)
  {
    $lang_id = current_language()->id;

    if ($request->has("search")) {
      $model = DB::table("tendercategories")
        ->select(['tendercategories.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "tendercategories.language_id")
        ->where("tendercategories.language_id", $lang_id)
        ->where("tendercategories.category_name", "LIKE", '%' . $request->input("search") . '%')
        ->orderBy('id', 'desc')
        ->paginate(10);
    } else {
      $model = DB::table("tendercategories")
        ->select(['tendercategories.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "tendercategories.language_id")
        ->where("language_id", $lang_id)
        ->orderBy('id', 'desc')
        ->paginate(10);
    }

    return view("admin.tendercategory", [
      "table" => $model
    ]);
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'category_name' => 'required|max:255',
      'language_id' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $grp_id = $this->getGroupId();

    foreach ($request->language_ids as $key => $value) {
      $model = new Tendercategory();
      $model->category_name = $request->input("category_name")[$key];
      $model->language_id = $value;
      $model->group = $grp_id;
      $model->save();
    }

    return redirect("/admin/tendercategory");
  }

  public function create()
  {
    return view("admin.tendercategory_add");
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'category_name' => 'required|max:255',
      'language_id' => 'required',
      'group' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $grp_id = $request->input("group");

    foreach ($request->language_ids as $key => $value) {
      $model = Tendercategory::all()
        ->where("group", "=", $grp_id)
        ->where("language_id", "=", $value)
        ->first();
      $model->category_name = $request->input("category_name")[$key];
      $model->update();
    }

    return redirect("admin/tendercategory");
  }

  public function edit(Request $request, $id)
  {
    $model  = Tendercategory::where('group', $id)->get();

    return view("admin.tendercategory_edit", [
      "model" => $model,
      "grp_id" => $id,
    ]);
  }

  public function destroy(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'id' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $model = Tendercategory::where('group', $id)->get();

    foreach ($model as $value) {
      $mod = Tendercategory::find($value->id)->delete();
    }

    return redirect("admin/tendercategory");
  }

  private function getGroupId()
  {
    return time();
  }
}

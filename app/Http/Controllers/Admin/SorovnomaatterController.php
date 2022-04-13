<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sorovnoma_atter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SorovnomaatterController extends Controller
{
  public function index(Request $request)
  {
    $lang_id = current_language()->id;

    $model = DB::table("sorovnomas")
      ->select(['sorovnomas.*', 'languages.language_name'])
      ->leftJoin("languages", "languages.id", "=", "sorovnomas.language_id")
      ->where("sorovnomas.group", $request->id)
      ->orWhere("sorovnomas.id", $request->id)
      ->first();
    //dd($model);

    if ($request->has("search")) {
      $javobs = DB::table("sorovnoma_atters")
        ->select(['sorovnoma_atters.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "sorovnoma_atters.language_id")
        ->where("languages.status", 1)
        ->where("sorovnoma_atters.language_id", $lang_id)
        ->where("sorovnoma_atters.savol_id", $model->group)
        ->where("sorovnoma_atters.javob", "LIKE", '%' . $request->search . '%')
        ->paginate(10);
    } else {
      $javobs = DB::table("sorovnoma_atters")
        ->select(['sorovnoma_atters.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "sorovnoma_atters.language_id")
        ->where("languages.status", 1)
        ->where("sorovnoma_atters.language_id", $lang_id)
        ->where("sorovnoma_atters.savol_id", $model->group)->paginate(10);
    }

    return view("admin.sorovatter", [
      'savol' => $model,
      'table' => $javobs
    ]);
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'javob' => 'required|max:255',
      'language_id' => 'required',
      'savol_id' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }
    $grp_id = $this->getGroupId();
    foreach ($request->language_ids as $key => $value) {
      $model = new Sorovnoma_atter();
      $model->javob = $request->javob[$key];
      $model->savol_id = $request->savol_id;
      $model->language_id = $value;
      $model->order = 0;
      $model->group = $grp_id;

      $model->save();
    }

    return redirect("/admin/sorovatter?id=" . $request->savol_id);
  }

  public function create()
  {
    return view("admin.sorov_add");
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'javob' => 'required|max:255',
      'language_id' => 'required',
      'savol_id' => 'required',
      'group' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $grp_id = $request->group;

    foreach ($request->language_ids as $key => $value) {
      $model = Sorovnoma_atter::all()
        ->where("group", $grp_id)
        ->where("language_id", $value)
        ->where("savol_id", $request->savol_id)
        ->first();
      $model->javob = $request->javob[$key];


      $model->update();
    }

    return redirect("admin/sorovatter?id=" . $request->savol_id);
  }

  public function edit(Request $request, $id)
  {
    $model  = Sorovnoma_atter::where("group", $request->id)->all();

    return view("admin.sorovatter_edit", [
      "model" => $model,
      "grp_id" => $id
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

    $model = Sorovnoma_atter::where('group', $id)->get();

    foreach ($model as $value) {
      $mod = Sorovnoma_atter::find($value->id)->delete();
    }

    return back();
  }

  private function getGroupId()
  {
    return time();
  }
}

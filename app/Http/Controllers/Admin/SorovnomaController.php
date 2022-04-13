<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sorovvote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sorovnoma;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SorovnomaController extends Controller
{
  public static function getsorovs($javob_id)
  {
    $total = Sorovvote::where("javob_grp_id", $javob_id)->count();
    return $total;
  }

  public function IndexAtter(Request $request)
  {
    $lang_id = current_language()->id;
    $model = DB::table("sorovnomas")
      ->select(['sorovnomas.*', 'languages.language_name'])
      ->leftJoin("languages", "languages.id", "=", "sorovnomas.language_id")
      ->where("languages.status", 1)
      ->where("language_id", $lang_id)
      ->where("sorovnomas.group", $request->id)->first();

    $javobs = DB::table("sorovnoma_atters")
      ->select(['sorovnoma_atters.*', 'languages.language_name'])
      ->leftJoin("languages", "languages.id", "=", "sorovnoma_atters.language_id")
      ->where("languages.status", 1)
      ->where("sorovnoma_atters.language_id", $lang_id)
      ->where("sorovnoma_atters.savol_id", $model->group)->paginate(10);

    return view("admin.sorovatter", [
      'savol' => $model,
      'table' => $javobs
    ]);
  }

  public function vote(Request $request)
  {
    $model = new Sorovvote();
    $model->javob_grp_id = $request->post("id");
    $model->ip = $request->session()->getId();
    $model->save();

    $savol =  DB::table("sorovnomas")
      ->select(['sorovnomas.*', 'languages.language_name'])
      ->leftJoin("languages", "languages.id", "=", "sorovnomas.language_id")

      ->where("sorovnomas.language_id", "=", $request->lang)


      ->first();

    $type = DB::table("sorovvotes")->where("ip", "=", Session::getId())->first();

    if ($type) {
      $tb = DB::table("sorovnoma_atters")
        ->select(['sorovnoma_atters.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "sorovnoma_atters.language_id")
        ->where("sorovnoma_atters.language_id", "=", $request->lang)
        ->where("sorovnoma_atters.savol_id", "=", $savol->group)->get();

      $total = 0;
      foreach ($tb as $value) {
        $tot =  Sorovvote::where("javob_grp_id", "=", $value->group)->count();
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
        ->where("sorovnoma_atters.language_id", $request->lang)
        ->where("sorovnoma_atters.savol_id", $savol->group)->get();

      return [
        'savol' => $savol->savol,
        'javob' => $tb,
        'type' => 'check',

      ];
    }
  }

  public function index(Request $request)
  {
    $lang_id = current_language()->id;

    if ($request->has("search")) {
      $model = DB::table("sorovnomas")
        ->select(['sorovnomas.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "sorovnomas.language_id")
        ->where("languages.status", 1)
        ->where("sorovnomas.language_id", $lang_id)
        ->where("sorovnomas.savol", "LIKE", '%' . $request->search . '%')->paginate(10);
    } else {
      $model = DB::table("sorovnomas")
        ->select(['sorovnomas.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "sorovnomas.language_id")
        ->where("languages.status", 1)
        ->where("language_id", $lang_id)->paginate(10);
    }

    return view("admin.sorov", [
      "table" => $model
    ]);
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'savol' => 'required|max:255',
      'language_id' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $grp_id = $this->getGroupId();

    foreach ($request->language_ids as $key => $value) {
      $model = new Sorovnoma();
      $model->savol = $request->savol[$key];
      $model->language_id = $value;
      $model->group = $grp_id;

      $model->save();
    }

    return redirect("/admin/sorov");
  }

  public function create()
  {
    return view("admin.sorov_add");
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'savol' => 'required|max:255',
      'language_id' => 'required',
      'group' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $grp_id = $request->group;

    foreach ($request->language_ids as $key => $value) {
      $model = Sorovnoma::all()
        ->where("group", $grp_id)
        ->where("language_id", $value)
        ->first();
      $model->savol = $request->savol[$key];
      $model->update();
    }

    return redirect("admin/sorov");
  }

  public function edit(Request $request, $id)
  {
    $model  = Sorovnoma::where('group', $id)->get();

    return view("admin.sorov_edit", [
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

    $model = Sorovnoma::where('group', $id)->get();

    foreach ($model as $value) {
      $mod = Sorovnoma::find($value->id)->delete();
    }

    return redirect("admin/sorov");
  }

  private function getGroupId()
  {
    return time();
  }
}

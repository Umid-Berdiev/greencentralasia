<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tendercategory;
use App\Models\Tender;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TenderController extends Controller
{
  public function index(Request $request)
  {
    $lang_id = current_language()->id;

    if ($request->has("search")) {
      $model = DB::table("tenders")
        ->select(['tenders.*', 'languages.language_name', 'tendercategories.category_name'])
        ->leftJoin("languages", "languages.id", "=", "tenders.language_id")
        ->leftJoin("tendercategories", "tendercategories.group", "=", "tenders.tender_category_id")
        ->where("tendercategories.language_id", $lang_id)
        ->where("tenders.language_id", $lang_id)
        ->where("tenders.title", "LIKE", '%' . $request->search . '%')
        ->orWhere("tenders.description", "LIKE", '%' . $request->search . '%')


        ->paginate(10);
    } else {
      $model = DB::table("tenders")
        ->select(['tenders.*', 'languages.language_name', 'tendercategories.category_name'])
        ->leftJoin("languages", "languages.id", "=", "tenders.language_id")
        ->leftJoin("tendercategories", "tendercategories.group", "=", "tenders.tender_category_id")
        ->where("tendercategories.language_id", $lang_id)
        ->where("tenders.language_id", $lang_id)
        ->orderBy('id', 'desc')
        ->paginate(10);
    }

    $doccat = Tendercategory::where("language_id", $lang_id)->get();

    return view("admin.tender", [
      "table" => $model,
      "category" => $doccat
    ]);
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'title' => 'required|max:255',
      'description' => 'required|max:255',
      'language_id' => 'required',
      'cover' => 'required',
      'deadline' => 'required',
      'tender_category_id' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $grp_id = $this->getGroupId();

    foreach ($request->language_ids as $key => $value) {
      $model = new Tender();
      if (isset($request->title[$key]))
        $model->title = $request->title[$key];
      else
        $model->title = "";
      if (isset($request->description[$key]))
        $model->description = $request->description[$key];
      else
        $model->description = "";

      $model->deadline = $request->deadline;

      $model->tender_category_id = $request->tender_category_id;
      $model->group = $grp_id;
      $model->received = $request->received ?? 0;
      $model->viewcount = 0;
      $model->language_id = $value;

      if ($request->hasFile("cover")) {
        $image      = $request->file('cover');
        $model->cover = Storage::disk('public')->put('photos/1', $image, 'public');
      }

      $model->save();
    }

    return redirect("/admin/tender");
  }

  public function create()
  {
    $lang_id = current_language()->id;
    $doccat = Tendercategory::where("language_id", $lang_id)->get();

    return view("admin.tender_add", [
      "category" => $doccat,
    ]);
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'title' => 'required|max:255',
      'description' => 'required|max:255',
      'language_id' => 'required',
      'deadline' => 'required',
      'tender_category_id' => 'required',
      'group' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $grp_id = $request->group;

    foreach ($request->language_ids as $key => $value) {
      $model = Tender::all()
        ->where("group", "=", $grp_id)
        ->where("language_id", "=", $value)
        ->first();
      if (isset($request->title[$key]))
        $model->title = $request->title[$key];
      else
        $model->title = "";
      if (isset($request->description[$key]))
        $model->description = $request->description[$key];
      else
        $model->description = "";

      $model->deadline = $request->deadline;

      $model->tender_category_id = $request->tender_category_id;
      $model->group = $grp_id;
      $model->received = $request->received ?? 0;
      $model->viewcount = 0;
      $model->language_id = $value;

      if ($request->hasFile("cover")) {
        $model->photo_url = Storage::putFileAs('public', $request->file('cover'), $request->file('cover')->getClientOriginalName());
      }

      $model->update();
    }

    return redirect("admin/tender");
  }

  public function edit(Request $request, $id)
  {
    $lang_id = current_language()->id;
    $model  = Tender::where('group', $id)->get();
    $doccat = Tendercategory::where("language_id", $lang_id)->get();

    return view("admin.tender_edit", [
      "model" => $model,
      "grp_id" => $id,
      "category" => $doccat,
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

    $model = Tender::where('group', $id)->get();

    foreach ($model as $value) {
      $mod = Tender::find($value->id)->delete();
    }

    return redirect("admin/tender");
  }

  private function getGroupId()
  {
    return time();
  }
}

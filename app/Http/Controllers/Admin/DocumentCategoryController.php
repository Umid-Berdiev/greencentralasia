<?php

namespace App\Http\Controllers\Admin;

use App\Models\DocumentCategory;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class DocumentCategoryController extends Controller
{
  public function index(Request $request)
  {
    if ($request->has("search")) {
      $model = DB::table("doccategories")
        ->select(['doccategories.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "doccategories.language_id")
        ->where("doccategories.language_id", current_language()->id)
        ->where("doccategories.category_name", "LIKE", '%' . $request->search . '%')->orderBy('id', 'desc')->paginate(10);
    } else {
      $model = DB::table("doccategories")
        ->select(['doccategories.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "doccategories.language_id")
        ->where("language_id", current_language()->id)->orderBy('id', 'desc')->paginate(10);
    }

    return view("admin.document_category.index", [
      "table" => $model
    ]);
  }

  public function create()
  {
    return view("admin.document_category.create");
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'category_names.*' => 'required|max:255',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $grp_id = $this->getGroupId();

    foreach ($request->language_ids as $key => $value) {
      $model = new DocumentCategory();
      if (isset($request->category_names[$key])) {
        $model->category_name = $request->category_names[$key];
      } else {
        $model->category_name = "";
      }

      $model->language_id = $value;
      $model->group = $grp_id;

      $model->save();
    }

    return redirect(route('document-categories.index'))->with('success', 'New category created!');
  }

  public function edit(Request $request, $id)
  {
    $model  = DocumentCategory::where("group", $id)->get();

    return view("admin.document_category.edit", [
      "model" => $model,
      "grp_id" => $id,
    ]);
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'category_names.*' => 'required|max:255',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    foreach ($request->language_ids as $key => $value) {
      $model = DocumentCategory::where("group", $id)
        ->where("language_id", $value)
        ->first();

      if (isset($request->category_names[$key])) {
        $model->category_name = $request->category_names[$key];
      } else {
        $model->category_name = "";
      }

      $model->update();
    }

    return redirect(route('document-categories.index'))->with('success', 'Category updated!');
  }

  public function destroy(Request $request, $id)
  {
    DocumentCategory::where("group", $id)->delete();
    return redirect(route('document-categories.index'))->with('success', 'Category deleted!');
  }

  private function getGroupId()
  {
    return time();
  }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use App\Models\Links;
use App\Models\LinksCategories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LinksController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $lang_id = current_language()->id;
    $model = DB::table("links")
      ->select(['links.*', 'languages.language_name', 'links_categories.title as category_name'])
      ->leftJoin("languages", "languages.id", "=", "links.language_id")
      ->leftJoin("links_categories", "links_categories.group", "=", "links.category_group")
      ->where("links_categories.language_id", $lang_id)
      ->where("links.language_id", $lang_id)
      ->orderBy('id', 'desc')
      ->paginate(10);

    return view('admin.links')->with('table', $model);
  }

  public function indexCategories()
  {
    $lang_id = current_language()->id;
    $model = DB::table("links_categories")
      ->select(['links_categories.*', 'languages.language_name'])
      ->leftJoin("languages", "languages.id", "=", "links_categories.language_id")
      ->where("language_id", $lang_id)
      ->orderBy('order')
      ->paginate(10);

    return view('admin.links_categories')->with('table', $model);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $lang_id = current_language()->id;
    $category = LinksCategories::where('language_id', '=', $lang_id)->get();

    return view('admin.links_add')
      ->with('category', $category);
  }

  public function createCategories()
  {
    return view('admin.links_categories_add');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'title' => 'required|max:255',
      'language_id' => 'required',
      'cover' => 'required',
      'links_category_id' => 'required',
      'link' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $grp_id = $this->getGroupId();

    foreach ($request->language_ids as $key => $value) {
      $model = new Links();

      if (isset($request->title[$key]))
        $model->title = $request->title[$key];
      else
        $model->title = "";

      $model->category_group = $request->links_category_id;
      $model->group = $grp_id;
      $model->language_id = $value;
      $model->link = $request->link;

      if ($request->hasFile('cover')) {
        $file = $request->file('cover');
        $file_name = 'link_' . time() . '.' . $file->clientExtension();
        $model->photo_url =  Storage::putFileAs('public', $file, $file_name);
      }

      $model->save();
    }

    return redirect("/admin/links");
  }

  public function categories_store(Request $request)
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

    $max_id = LinksCategories::max('id');
    $grp_id = $this->getGroupId();

    foreach ($request->language_ids as $key => $value) {
      $model = new LinksCategories();
      if (isset($request->category_name[$key]))
        $model->title = $request->category_name[$key];
      else
        $model->title = "";
      $model->language_id = $value;
      $model->group = $grp_id;
      $model->order = $max_id + 1;

      $model->save();
    }

    return redirect("/admin/links/categories");
  }

  private function getGroupId()
  {
    return time();
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Request $request, $id)
  {
    $lang_id = current_language()->id;
    $model  = Links::where("group", $request->id);
    $category_id = Links::where("group", $request->id)->first();
    $doccat = LinksCategories::where("language_id", $lang_id)->get();

    return view("admin.links_edit", [
      "model" => $model,
      "grp_id" => $id,
      "category_id" => $category_id,
      "category" => $doccat
    ]);
  }

  public function editCategories(Request $request)
  {
    $model  = LinksCategories::where("group", $request->id);

    return view("admin.links_categories_edit", [
      "model" => $model,
      "grp_id" => null
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'title' => 'required|max:255',
      'language_id' => 'required',
      'links_category_id' => 'required',
      'link' => 'required',
      'group' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $grp_id = $request->group;


    foreach ($request->language_ids as $key => $value) {
      $model = Links::all()
        ->where("group", $grp_id)
        ->where("language_id", $value)
        ->first();
      if (isset($request->title[$key]))
        $model->title = $request->title[$key];
      else
        $model->title = "";
      $model->category_group = $request->links_category_id;
      $model->link = $request->link;
      $model->group = $grp_id;
      $model->language_id = $value;

      if ($request->hasFile('cover')) {
        $file = $request->file('cover');
        $file_name = 'link_' . time() . '.' . $file->clientExtension();
        $model->photo_url =  $file_name;
        Storage::putFileAs('public', $file, $file_name);
      }

      if ($request->remove_cover == "on") {
        $model->cover = "null";
      }

      $model->update();
    }
    return redirect("admin/links");
  }

  public function categories_update(Request $request)
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
    $grp_id = $request->group;

    foreach ($request->language_ids as $key => $value) {
      $model = LinksCategories::all()
        ->where("group", $grp_id)
        ->where("language_id", $value)
        ->first();
      $model->title = $request->category_name[$key];


      $model->update();
    }
    return redirect("/admin/links/categories/");
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'id' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    Links::where("group", $request->id)->delete();


    return redirect("/admin/links/");
  }

  public function categories_destroy(Request $request)
  {

    $validator = Validator::make($request->all(), [
      'id' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }
    LinksCategories::where("group", $request->id)->delete();


    return redirect("/admin/links/categories/");
  }
}

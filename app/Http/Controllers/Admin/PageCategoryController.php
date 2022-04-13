<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PageCategory;
use App\Models\PageCategoryGroup;
use App\Models\Page;
use Illuminate\Support\Facades\Validator;

class PageCategoryController extends Controller
{
  public function index(Request $request)
  {
    $lang_id = current_language()->id;
    $languages_min = Language::min('id');
    $categories = PageCategory::where('language_id', $lang_id)->latest()->paginate(10);

    return view("admin.page_category.index", compact('categories'));
  }

  public function create()
  {
    return view("admin.page_category.create");
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'category_names.*' => 'required|max:50',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $group = PageCategoryGroup::create(['status' => 1]);
    $language_ids = $request->language_ids;
    $category_names = $request->category_names;

    foreach ($language_ids as $key => $val) {
      $category = new PageCategory();
      $category->category_name = $category_names[$key];
      $category->language_id = $val;
      $category->category_group_id = $group->id;
      $category->save();
    }

    return redirect(route('page-categories.index'))->with('success', 'Created!');
  }

  public function edit(Request $request, $id)
  {
    $model  = PageCategory::where('category_group_id', $id)->get();

    return view("admin.page_category.edit", [
      "model" => $model,
      "group_id" => $id,
    ]);
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'category_names.*' => 'required|max:50',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    foreach ($request->language_ids as $key => $value) {
      $model = PageCategory::where("category_group_id", $id)
        ->where("language_id", $value)
        ->first();
      $model->category_name = $request->category_names[$key];
      $model->update();
    }

    return redirect(route('page-categories.index'))->with('success', 'Updated!');
  }

  public function destroy(Request $request, $id)
  {
    $pages_in_categories = Page::where('page_category_group_id', $id)->get();

    if (count($pages_in_categories) > 0) {
      return redirect(route('page-categories.index'))->with('error', 'This category has some pages.This can\'t be deleted');
    } else {
      PageCategory::where('category_group_id', $id)->delete();
      return redirect(route('page-categories.index'))->with('success', 'Deleted!');
    }
  }
}

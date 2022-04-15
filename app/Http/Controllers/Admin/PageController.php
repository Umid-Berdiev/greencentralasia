<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageGroup;
use App\Models\Tender;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
  public function index(Request $request)
  {
    $lang_id = current_language()->id;
    $tenders = Tender::take(3)->where('language_id', $lang_id)->get();
    $languages_min = Language::min('id');
    $pages = Page::where('language_id', $lang_id)->with('category')->latest()->paginate(10);

    return view('admin.page.index', compact('pages'));
  }

  public function create()
  {
    $languages_min = Language::min('id');
    $categories = DB::table('pages_categories')
      ->Leftjoin('pages_categories_groups', 'pages_categories.category_group_id', '=', 'pages_categories_groups.id')
      ->select('pages_categories.*')
      ->where('pages_categories_groups.status', 1)
      ->where('pages_categories.language_id', $languages_min)
      ->get();

    return view('admin.page.create', compact('categories'));
  }

  public function store(Request $request)
  {
    // dd($request->all());
    $validator = Validator::make($request->all(), [
      'titles.*' => 'required',
      'descriptions.*' => 'required',
      'contents.*' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $page_group = new PageGroup();
    $page_group->viewers = 0;
    $page_group->status = 1;
    $page_group->page_category_group_id = $request->category_id;
    $page_group->user_id = auth()->id();

    /* $image = $request->file('photos');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = storage_path('app/public/photos/1');
            $image->move($destinationPath, $name);
             $page_group->photo_url = $name;*/

    if ($request->hasFile('photos')) {
      $file_name = 'page_' . time();
      $page_group->photo_url = $file_name;
      Storage::putFileAs('public/pages', $request->file('photos'), $file_name);
    }

    $page_group->save();

    foreach ($request->language_ids as $key => $val) {
      $page = new Page();
      $page->title = $request->titles[$key];
      $page->description = "";
      $page->content = $request->contents[$key];
      $page->page_group_id = $page_group->id;
      $page->language_id = $val;
      $page->page_category_group_id =  $request->category_id;
      $page->save();
    }

    return redirect(route('pages.edit', $page->page_group_id))->with('success', 'Created!');
  }

  public function edit(Request $request, $id)
  {
    $languages_min = Language::min('id');
    $categories = DB::table('pages_categories')
      ->Leftjoin('pages_categories_groups', 'pages_categories.category_group_id', '=', 'pages_categories_groups.id')
      ->select('pages_categories.*')
      ->where('pages_categories_groups.status', 1)
      ->where('pages_categories.language_id', $languages_min)
      ->get();
    $pages = Page::where('page_group_id', $id)->get();
    $page_group = PageGroup::whereId($id)->first();

    return view('admin.page.edit', compact(
      'categories',
      'pages',
      'page_group'
    ));
  }

  public function update(Request $request, $id)
  {
    // dd($request->all());
    $validator = Validator::make($request->all(), [
      'titles.*' => 'required',
      'descriptions.*' => 'required',
      'contents.*' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $category_group_id = $request->category_id;
    $language_ids = $request->language_ids;
    $titles = $request->titles;
    $contents = $request->contents;
    $page_ids = $request->page_ids;

    if ($request->hasFile('photos')) {
      $image = $request->file('photos');
      $file_name = 'page_' . time();
      Storage::putFileAs('public/pages', $image, $file_name);

      PageGroup::whereId($id)
        ->update([
          'page_category_group_id' => $category_group_id,
          'photo_url' => $file_name
        ]);
    } else {
      PageGroup::whereId($id)
        ->update([
          'page_category_group_id' => $category_group_id,
        ]);
    }

    foreach ($language_ids as $key => $val) {
      $page = Page::find($page_ids[$key]);
      $page->title = $titles[$key];
      $page->content = $contents[$key];
      $page->page_category_group_id = $category_group_id;
      $page->language_id = $val;
      $page->update();
    }

    return back()->with('success', 'Updated!');
  }

  public function destroy(Request $request, $id)
  {
    Page::where('page_group_id', $id)->delete();
    return redirect(route('pages.index'))->with('success', 'Deleted!');
  }

  private function getLang()
  {
    $current_locale = app()->getLocale() ?? 'en';
    $model = Language::where('status', '1')->where("language_prefix", $current_locale)->first();

    return $model->id;
  }
}

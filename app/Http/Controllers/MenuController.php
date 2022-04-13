<?php

namespace App\Http\Controllers;

use App\Models\MenuMaker;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
  public function edits(Request $request)
  {
    if (is_null($request->id)) {
      return back()->with('error', 'No menu item selected!');
    }
    // dd($request->all());
    $lang_id = current_language()->id;
    $menu = DB::table("menumakers")->where("language_id", $lang_id)->where("parent_id", 0)->get();
    $edits = DB::table("menumakers")->where("group", $request->id)->get();
    $doc = DB::table("doccategories")->where("language_id", $lang_id)->get();
    $event = DB::table("eventcategories")->where("language_id", $lang_id)->get();
    $page = DB::table("pages")->where("language_id", $lang_id)->get();
    $photo = DB::table("photogallerycategories")->where("language_id", $lang_id)->get();
    $video = DB::table("videogallerycategories")->where("language_id", $lang_id)->get();
    $tenders = DB::table("tendercategories")->where("language_id", $lang_id)->get();
    $postcategories = DB::table("postcategories")->where("language_id", $lang_id)->get();

    return view("admin.menubuildere", [
      'edit' => $edits,
      'grp_id' => $request->id,
      'menues' => $menu,
      'categories' => [
        'doc' => $doc,
        'event' => $event,
        'page' => $page,
        'photo' => $photo,
        'video' => $video,
        'tender' => $tenders,
        'post' => $postcategories,
      ],
    ]);
  }

  public function editshow()
  {
    $lang_id = current_language()->id;
    $menus = MenuMaker::with('children')
      ->where('parent_id', 0)
      ->where("language_id", $lang_id)
      ->orderBy("orders")
      ->get();
    // ->toArray();
    // $menu = DB::table("menumakers")->where("language_id", $lang_id)->where("parent_id", 0)->orderBy("orders")->get();
    // dd($menus);
    return view("admin.menuedit", compact('menus'));
  }

  public function index()
  {
    $lang_id = current_language()->id;
    $menu = DB::table("menumakers")->where("language_id", $lang_id)->where("parent_id", 0)->get();
    $doc = DB::table("doccategories")->where("language_id", $lang_id)->get();
    $event = DB::table("eventcategories")->where("language_id", $lang_id)->get();
    $page = DB::table("pages")->where("language_id", $lang_id)->get();
    $photo = DB::table("photogallerycategories")->where("language_id", $lang_id)->get();
    $video = DB::table("videogallerycategories")->where("language_id", $lang_id)->get();
    $tenders = DB::table("tendercategories")->where("language_id", $lang_id)->get();
    $postcategories = DB::table("postcategories")->where("language_id", $lang_id)->get();

    return view("admin.menubuilder", [
      'menues' => $menu,
      'categories' => [
        'doc' => $doc,
        'event' => $event,
        'page' => $page,
        'photo' => $photo,
        'video' => $video,
        'tender' => $tenders,
        'post' => $postcategories,
      ],
    ]);
  }

  public function indexx($id)
  {
    $lang_id = current_language()->id;
    $menu = DB::table("menumakers")
      ->where("language_id", $lang_id)
      ->where("parent_id", 0)
      ->get();

    $parent = DB::table("menumakers")
      ->where("language_id", $lang_id)
      ->where("group", $id)

      ->first();

    $doc = DB::table("doccategories")->where("language_id", $lang_id)->get();
    $event = DB::table("eventcategories")->where("language_id", $lang_id)->get();
    $page = DB::table("pages")->where("language_id", $lang_id)->get();
    $photo = DB::table("photogallerycategories")->where("language_id", $lang_id)->get();
    $video = DB::table("videogallerycategories")->where("language_id", $lang_id)->get();
    $tenders = DB::table("tendercategories")->where("language_id", $lang_id)->get();
    $postcategories = DB::table("postcategories")->where("language_id", $lang_id)->get();

    return view("admin.menubuilderparent", [
      'menues' => $menu,
      'parent_id' => $id,
      'parent' => $parent,
      'categories' => [
        'doc' => $doc,
        'event' => $event,
        'page' => $page,
        'photo' => $photo,
        'video' => $video,
        'tender' => $tenders,
        'post' => $postcategories,
      ],
    ]);
  }

  public function insert(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'menu_name' => 'required|max:255',
      'type' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $grp_id = $this->getGroupId();

    if (isset($request->type) && $request->type == 3 && isset($request->alias_category_id)) {
      $page = Page::where('page_group_id', $request->alias_category_id)->first();
      $link = "/page/" . $page->page_category_group_id . "/" . $page->page_group_id;
    }

    foreach ($request->language_ids as $key => $value) {
      $model = new MenuMaker();
      $model->alias_category_id = $request->alias_category_id ?? null;
      $model->menu_name = $request->menu_name[$key] ?? null;
      $model->type = $request->type;
      $model->link = $link ?? $request->link ?? "";

      if ($request->parent_id != "null") {
        $model->parent_id = $request->parent_id;
      } else {
        $model->parent_id = 0;
      }

      $model->language_id = $value;
      $model->orders = 0;
      $model->group = $grp_id;
      $model->save();
    }

    return redirect("/admin/menu");
  }

  public function update(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'menu_name' => 'required|max:255',
      'type' => 'required',
      'grp_id' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $grp_id = $request->grp_id;

    foreach ($request->language_ids as $key => $lang_id) {
      $model = MenuMaker::where("group", $grp_id)
        ->where("language_id", $lang_id)->first();

      if (isset($request->type) && $request->type == 3 && isset($request->alias_category_id)) {
        $page = Page::where('page_group_id', $request->alias_category_id)->first();
        $link = "/page/" . $page->page_category_group_id . "/" . $page->page_group_id;
      }

      $model->update([
        'alias_category_id' => $request->alias_category_id ?? null,
        'menu_name' => $request->menu_name[$key] ?? null,
        'type' => $request->type,
        'link' => $link ?? $request->link ?? "",
        'parent_id' => $request->parent_id ?? 0,
      ]);
    }

    return redirect("/admin/menu/edits?id=" . $grp_id);
  }

  public function orderchange(Request $request)
  {
    $at = DB::table("menumakers")
      ->where("group", $request->id)->first();

    $ordermin = DB::table("menumakers")
      ->where("parent_id", $at->parent_id)->orderBy("orders")->first();

    $ordermax = DB::table("menumakers")
      ->where("parent_id", $at->parent_id)->orderByDesc("orders")->first();

    if ($request->p == "up") {
      $older = MenuMaker::where("parent_id", $at->parent_id)
        ->where("orders", $at->orders - 1);

      foreach ($older as $atx) {
        $ssx  = MenuMaker::where("parent_id", $at->parent_id)
          ->where("id", $atx->id)->first();
        $ssx->orders = $atx->orders + 1;
        $ssx->update();
      }

      $ss  = MenuMaker::where("group", $at->group);

      foreach ($ss as $value) {
        $my = MenuMaker::where("id", $value->id)->first();
        if ($value->orders > $ordermin->orders) {
          $my->orders = $value->orders - 1;
          $my->update();
        }
      }
    } else {
      $older = MenuMaker::where("parent_id", $at->parent_id)
        ->where("orders", $at->orders + 1);

      foreach ($older as $atx) {
        $ssx  = MenuMaker::where("parent_id", $at->parent_id)
          ->where("id", $atx->id)->first();
        $ssx->orders = $atx->orders - 1;
        $ssx->update();
      }

      $ss  = MenuMaker::where("group", $at->group);

      foreach ($ss as $value) {
        $my = MenuMaker::where("id", $value->id)->first();
        if ($value->orders < $ordermax->orders) {
          $my->orders = $value->orders + 1;

          $my->update();
        }
      }
    }

    return redirect("/admin/menu/edit");
  }

  public function destroy(Request $request)
  {
    $menu  = MenuMaker::where('group', $request->id)->delete();
    $parentmenu = MenuMaker::where('parent_id', $request->id)->delete();

    return redirect()->back();
  }

  private function getGroupId()
  {
    return time();
  }
}

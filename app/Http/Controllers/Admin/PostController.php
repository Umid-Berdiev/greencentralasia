<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GcaInfo;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
  public function index(Request $request)
  {
    $lang_id = current_language()->id;

    if ($request->has("search")) {
      $model = DB::table("posts")
        ->select(['posts.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "posts.language_id")
        ->where("posts.language_id", "=", $lang_id)
        ->where("posts.title", "LIKE", '%' . $request->search . '%')
        ->orWhere("posts.decription", "LIKE", '%' . $request->search . '%')
        ->orderBy('posts.id', 'desc')
        ->paginate(10);
    } else {
      $model = DB::table("posts")
        ->select(['posts.*', 'languages.language_name'])
        ->leftJoin("languages", "languages.id", "=", "posts.language_id")
        ->where("posts.language_id", "=", $lang_id)
        ->orderBy('posts.id', 'desc')
        ->paginate(10);
    }

    return view("admin.post.index", [
      'table' => $model
    ]);
  }

  public function create()
  {
    $lang_id = current_language()->id;
    $gcainfo = GcaInfo::all();
    $cat = PostCategory::where("language_id", $lang_id)->get();

    return view('admin.post.create', [
      'category' => $cat,
      'gcainfo' => $gcainfo
    ]);
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'post_category_id' => 'required',
      'datetime' => 'required',
      'country_id' => 'required',
      'titles.*' => 'required',
      'descriptions.*' => 'required',
      'cover' => 'image|nullable'
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $grp_id = $this->postGroup($request->post_category_id);

    foreach ($request->language_ids as $key => $value) {
      $model = new Post();
      $model->datetime = $request->datetime;
      $model->title = $request->titles[$key];
      $model->decription = $request->decriptions[$key];
      $model->content = $request->contents[$key];

      if ($request->hasFile('cover')) {
        Storage::putFileAs('public/posts', $request->file('cover'), $request->file('cover')->getClientOriginalName());
        $model->cover = $request->file('cover')->getClientOriginalName();
      } else {
        $model->cover = "null";
      }

      $model->language_id = $value;
      $model->group = $grp_id;
      $model->category_group_id = $request->post_category_id;
      $model->gcainfo_id = $request->country_id;
      $model->save();
      //MailController::sendPost($model);
    }
    return redirect(route('posts.edit', $model->group))->with('success', 'Created and Sent to subscribers');
  }

  public function edit(Request $request, $id)
  {
    $lang_id = current_language()->id;
    $gcainfo = GcaInfo::all();
    $model = DB::table("posts")
      ->select(['posts.*', 'postgroups.post_category_group_id'])
      ->leftJoin("postgroups", "postgroups.id", "=", "posts.group")
      ->where("posts.group", "=", $id)
      ->get();
    $cat = PostCategory::where("language_id", $lang_id)->get();

    return view("admin.post.edit", [
      'model' => $model,
      'category' => $cat,
      'gcainfo' => $gcainfo,
      'group' => $id
    ]);
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'post_category_id' => 'required',
      'datetime' => 'required',
      'country_id' => 'required',
      'titles.*' => 'required',
      'descriptions.*' => 'required',
      'cover' => 'image|nullable'
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $grpupd = PostGroup::whereId($id)->first();
    $grpupd->post_category_group_id = $request->post_category_id;
    $grpupd->update();

    foreach ($request->language_ids as $key => $value) {
      $model = Post::where("group", $id)->where("language_id", $value)->first();
      $model->title = $request->titles[$key];
      $model->decription = $request->decriptions[$key] ?? 'No desc';
      $model->content = $request->contents[$key];
      $model->category_group_id = $request->post_category_id;
      $model->gcainfo_id = $request->country_id;

      if ($request->hasFile("cover")) {
        Storage::putFileAs('public/posts', $request->file('cover'), $request->file('cover')->getClientOriginalName());
        $model->cover = $request->file('cover')->getClientOriginalName();
      }

      if ($request->remove_cover == "on") {
        $model->cover = "null";
      }

      $model->datetime = $request->datetime;
      $model->update();
    }

    return back()->with('success', 'Updated!');
  }

  public function destroy(Request $request, $id)
  {
    Post::where('group', $id)->delete();
    return redirect(route('posts.index'))->with('success', 'Deleted!');
  }

  private function postGroup($post_category_group_id)
  {
    $model = new PostGroup();
    $model->post_category_group_id = $post_category_group_id;
    $model->viewcount = 0;
    $model->save();

    return $model->id;
  }
}

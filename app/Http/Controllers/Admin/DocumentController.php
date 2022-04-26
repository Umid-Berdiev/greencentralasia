<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Document;
use App\Models\Language;
use App\Models\DocumentCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class DocumentController extends Controller
{
  public function index(Request $request)
  {
    $lang_id = current_language()->id;

    if ($request->has("search")) {
      $docs = Document::where('title', 'like', '%' . $request->search . '%')
        ->where('language_id', $lang_id)
        ->with('category')
        ->latest()
        ->paginate(10);
    } else {
      $docs = Document::where('language_id', $lang_id)->with('category')->latest()->paginate(10);
    }

    return view("admin.document.index", compact('docs'));
  }

  public function create()
  {
    $lang_id = current_language()->id;
    $categories = DocumentCategory::where("language_id", $lang_id)->get();

    return view("admin.document.create", compact(
      "categories"
    ));
  }

  public function store(Request $request)
  {
    // dd($request->all());
    $validator = Validator::make($request->all(), [
      'titles' => 'required|array',
      'titles.*' => 'required',
      'language_ids' => 'required|array',
      'language_ids.*' => 'required',
      'descriptions' => 'required|array|size:2',
      'descriptions.*' => 'required',
      'files' => 'required|array|size:2',
      'files.*' => 'required|mimes:doc,docx,pdf,ppt,pptx',
      'register_dates' => 'required',
      'category_id' => 'required'
    ]);

    if ($validator->fails()) {
      return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
    }

    $grp_id = $this->getGroupId();

    foreach ($request->language_ids as $key => $value) {
      $file = $request->file("files")[$key];
      $file_name = 'doc_' . time() . '.' . $file->clientExtension();
      Storage::putFileAs('public/upload/', $file, $file_name);

      $doc = Document::create([
        'title' => $request->titles[$key],
        'description' => $request->descriptions[$key],
        'link' => $request->links,
        'r_number' => $request->register_numbers,
        'r_date' => $request->register_dates,
        'group' => $grp_id,
        'language_id' => $value,
        'doc_category_id' => $request->category_id,
        'files' => $file_name,
        'file_type' => $file->clientExtension(),
        'file_size' => $file->getSize()
      ]);
      // dd($doc);

      // if ($request->hasFile("files")) {
      // $file = $request->file("files")[$key];
      // $file_name = 'doc_' . time() . '.' . $file->clientExtension();

      // Storage::putFileAs('public/upload/', $file, $file_name);
      // $file_type = $file->extension();

      /* SCREENSHOT OF FIRST PAGE OF DOCUMENT*/
      //Supported formats:doc,docx,pdf,ppt,pptx
      // if (!($file_type == 'doc' || $file_type == 'docx' || $file_type == 'pdf' || $file_type == 'ppt' || $file_type == 'pptx')) {
      //   return back()
      //     ->with('error', 'Supported file types:doc,docx,pdf,ppt,pptx');
      // }

      // $doc->files = $file_name;
      // $doc->file_type = $file->clientExtension();
      // $doc->file_size = $file->getSize();
      // $doc->save();
      // }
    }

    return response()->json(['group_id' => $grp_id], 200);
  }

  public function edit(Request $request, $group_id)
  {
    $lang_id = current_language()->id;
    // $models  = Document::where("group", $group_id)->get();
    $categories = DocumentCategory::where("language_id", $lang_id)->get();
    $grp_id = $group_id;

    $langs = Language::with(['documents' => function ($query) use ($group_id) {
      $query->where('group', $group_id);
    }])->get();

    return view("admin.document.edit", compact(
      // "models",
      "grp_id",
      "categories",
      "langs"
    ));
  }

  public function update(Request $request)
  {
    // return $request->all();
    $validator = Validator::make($request->all(), [
      'titles' => 'required|array',
      'titles.*' => 'required',
      'language_ids' => 'required|array',
      'language_ids.*' => 'required',
      'descriptions' => 'required|array|size:2',
      'descriptions.*' => 'required',
      // 'files' => 'required|array|size:2',
      'files.*' => 'mimes:doc,docx,pdf,ppt,pptx',
      'register_dates' => 'required',
      'category_id' => 'required'
    ]);

    if ($validator->fails()) {
      return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
    }

    try {
      foreach ($request->language_ids as $key => $value) {
        $model = Document::where("group", $request->group_id)
          ->where("language_id", $value)->first();

        $model->update([
          'title' => $request->titles[$key],
          'description' => $request->descriptions[$key],
          'link' => $request->links[$key],
          'other_link' => $request->other_link,
          'r_number' => $request->register_numbers[$key],
          'r_date' => $request->register_dates[$key],
          'doc_category_id' => $request->category_id
        ]);

        if (isset($request->file("files")[$key])) {
          // return $request->file("files")[$key];
          $file = $request->file("files")[$key];
          $file_name = 'doc_' . time() . '.' . $file->clientExtension();

          Storage::putFileAs('public/upload', $file, $file_name);

          // $model = Document::where('group', $group_id)
          //   ->where('language_id', $value)->get();

          Storage::delete('public/upload/' . $model->files);

          // $model = Document::where("group", $group_id)
          //   ->where("language_id", $value)->update([
          //     'files' => $file_name,
          //     'file_type' => $file->clientExtension(),
          //     'file_size' => $file->getSize(),
          //   ]);

          // dd($file->clientExtension());
          $model->files = $file_name;
          $model->file_type = $file->clientExtension();
          $model->file_size = $file->getSize();
          $model->save();
        }

        if ($request->remove_cover == "on") {
          $model->cover = "null";
          $model->save();
        }
      }

      return response()->json(['message' => 'success'], 200);
    } catch (\Throwable $th) {
      return $th;
    }
  }

  public function destroy(Request $request, $group_id)
  {
    $model = Document::where('group', $group_id)->get();

    Storage::delete('public/upload/'  . $model[0]->files);

    Document::where("group", $group_id)->delete();
    return back()->with('success', 'Deleted!');
  }

  private function getGroupId()
  {
    return time();
  }
}

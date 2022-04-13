<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LanguageController extends Controller
{
  public function index()
  {
    return view('admin.language.index');
  }

  public function create(Request $request)
  {
    return view('admin.language.create');
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'language_name' => 'required|min:3|max:20',
      'language_prefix' => 'required|min:2|max:3',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    Language::create([
      'language_name' => $request->language_name,
      'language_prefix' => $request->language_prefix,
      'status' => 1
    ]);

    return redirect(route('languages.index'))->with('success', 'Created!');
  }

  public function edit(Request $request, $id)
  {
    $model = Language::findOrFail($id);
    return view("admin.language.edit", compact('model'));
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'language_name' => 'required|min:3|max:20',
      'language_prefix' => 'required|min:2|max:3',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    Language::whereId($id)->update([
      'language_name' => $request->language_name,
      'language_prefix' => $request->language_prefix
    ]);

    return redirect(route('languages.index'))->with('success', 'Updated!');
  }

  public function destroy(Request $request, $id)
  {
    $model = Language::whereId($id)->first();
    $model->status = 0;
    $model->delete();

    return redirect(route('languages.index'))->with('success', 'Deleted!');
  }
}

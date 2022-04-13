<?php

namespace App\Http\Controllers\Admin;

use App\Models\GcaInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class GcaInfoController extends Controller
{
  public function index()
  {
    $gcainfos = GcaInfo::all();

    return view('admin.gcainfo')->with([
      'gcainfos' => $gcainfos
    ]);
  }

  public function edit(Request $request, $id)
  {
    $gca = GcaInfo::find($id);

    return view('admin.gcainfo_edit')->with([
      'gca' => $gca
    ]);
  }

  public function get(Request $request)
  {
    $gca = GcaInfo::with('news')->where('prefix', $request->prefix)->first();

    return response()->json($gca);
  }

  public function update(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'prefix' => 'required',
      'title' => 'required',
      'name' => 'required',
      'phone' => 'required',
      'address' => 'required',
      'wep' => 'required',
      'email' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }
    $gca = GcaInfo::find($request->id);
    $gca->prefix = $request->prefix;
    $gca->title = $request->title;
    $gca->name = $request->name;
    $gca->phone = $request->phone;
    $gca->address = $request->address;
    $gca->wep = $request->wep;
    $gca->email = $request->email;
    $gca->desc = $request->desc;
    $gca->save();

    return redirect(route('gca.info.index'));
  }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use App\Models\Years;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class YearsController extends Controller
{
  public function index()
  {
    $lang_id = current_language()->id;
    $years = Years::where("language_id", $lang_id)
      ->orderBy('id', 'desc')
      ->paginate('10');

    return view('admin.years')
      ->with('years', $years);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.years_add');
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
      'language_id' => 'required',
      'cover' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $grp_id = $this->getGroupId();

    foreach ($request->language_ids as $key => $value) {
      $years = new Years();
      if (isset($request->file('cover')[$key])) {
        $years->photo_url =  Storage::putFile('public', $request->file('cover')[$key]);
      } else {
        $years->photo_url = "";
      }
      $years->group  = $grp_id;
      $years->language_id  = $value;
      $years->save();
    }

    return redirect('/admin/years');
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
  public function edit(Request $request)
  {
    $lang_id = current_language()->id;
    $years = Years::where('group', '=', $request->id)->get();
    return view('admin.years_edit')->with('years', $years);
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
      'language_id' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $id = $request->group;

    foreach ($request->language_ids as $key => $value) {
      $years = Years::all()
        ->where("group", "=", $id)
        ->where("language_id", "=", $value)
        ->first();
      if (isset($request->file('cover')[$key])) {

        $years->photo_url =  Storage::putFile('public', $request->file('cover')[$key]);
      }
      $years->language_id = $value;

      $years->update();
    }
    return redirect("admin/years");
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

    $model = Years::where("group", "=", $request->id)->delete();;

    return redirect("admin/years");
  }

  private function getGroupId()
  {
    return time();
  }
}

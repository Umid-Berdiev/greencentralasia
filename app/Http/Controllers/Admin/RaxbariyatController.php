<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use App\Models\Raxbariyat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RaxbariyatController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $lang_id = current_language()->id;
    $raxbariyat = Raxbariyat::where('language_id', $lang_id)->paginate(10);

    return view('admin.raxbariyat')->with('table', $raxbariyat);
  }

  public function create()
  {
    return view("admin.raxbariyat_add");
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    // dd(Input::all());
    $validator = Validator::make($request->all(), [
      'fio' => 'required|max:255',
      'major' => 'required|max:255',
      'language_id' => 'required',
      'qabul' => 'required',
      'short' => 'required',
      'vazifa' => 'required',
      'tel' => 'required',
      'faks' => 'required',
      'email' => 'required',
      'cover' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $grp_id = $this->getGroupId();

    foreach ($request->language_ids as $key => $value) {
      $raxbariyat = new Raxbariyat();
      if (isset($request->fio[$key]))
        $raxbariyat->fio = $request->fio[$key];
      else
        $raxbariyat->fio = "";
      if (isset($request->major[$key]))
        $raxbariyat->major = $request->major[$key];
      else
        $raxbariyat->major = "";
      if (isset($request->qabul[$key]))
        $raxbariyat->qabul = $request->qabul[$key];
      else
        $raxbariyat->qabul = "";
      if (isset($request->short[$key]))
        $raxbariyat->short = $request->short[$key];
      else
        $raxbariyat->short = "";
      if (isset($request->vazifa[$key]))
        $raxbariyat->vazifa = $request->vazifa[$key];
      else
        $raxbariyat->vazifa = "";
      $raxbariyat->tel = $request->tel;
      $raxbariyat->faks = $request->faks;
      $raxbariyat->email = $request->email;
      $raxbariyat->photo_url =  Storage::putFileAs('public', $request->file('cover'), $request->file('cover')->getClientOriginalName());
      $raxbariyat->group = $grp_id;
      $raxbariyat->language_id = $value;

      $raxbariyat->save();
    }

    return redirect("/admin/raxbariyat");
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
    $raxbariyat = Raxbariyat::where('group', $request->id)->get();
    return view('admin.raxbariyat_edit')->with('raxbariyat', $raxbariyat);
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
      'fio' => 'required|max:255',
      'major' => 'required|max:255',
      'language_id' => 'required',
      'qabul' => 'required',
      'short' => 'required',
      'vazifa' => 'required',
      'tel' => 'required',
      'faks' => 'required',
      'email' => 'required',
      'group' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $id = $request->group;

    foreach ($request->language_ids as $key => $value) {
      $raxbariyat = Raxbariyat::all()
        ->where("group", $id)
        ->where("language_id", $value)
        ->first();
      // dd($raxbariyat);
      if (isset($request->fio[$key]))
        $raxbariyat->fio = $request->fio[$key];
      else
        $raxbariyat->fio = "";
      if (isset($request->major[$key]))
        $raxbariyat->major = $request->major[$key];
      else
        $raxbariyat->major = "";
      if (isset($request->qabul[$key]))
        $raxbariyat->qabul = $request->qabul[$key];
      else
        $raxbariyat->qabul = "";
      if (isset($request->short[$key]))
        $raxbariyat->short = $request->short[$key];
      else
        $raxbariyat->short = "";
      if (isset($request->vazifa[$key]))
        $raxbariyat->vazifa = $request->vazifa[$key];
      else
        $raxbariyat->vazifa = "";
      $raxbariyat->tel = $request->tel;
      $raxbariyat->faks = $request->faks;
      $raxbariyat->email = $request->email;
      if ($request->hasFile('cover'))
        $raxbariyat->photo_url =  Storage::putFileAs('public', $request->file('cover'), $request->file('cover')->getClientOriginalName());

      $raxbariyat->language_id = $value;

      $raxbariyat->update();
    }

    return redirect("admin/raxbariyat");
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

    Raxbariyat::where("group", $request->id)->delete();

    return redirect("admin/raxbariyat");
  }

  private function getGroupId()
  {
    return time();
  }
}

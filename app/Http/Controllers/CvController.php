<?php

namespace App\Http\Controllers;

use App\Models\CvForm;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Tender;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Illuminate\Support\Facades\Validator;

class CvController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $lang_id = current_language()->id;

    $events = DB::table("events")
      ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
      ->leftJoin("languages", "languages.id", "=", "events.language_id")
      ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
      ->where('events.title', '<>', '')
      ->where("events.language_id", $lang_id)
      ->where("eventcategories.language_id", $lang_id)->take(5)
      ->orderBy('id', 'desc')
      ->get();

    $tenders = Tender::take(3)->where('title', '<>', '')->where('language_id', $lang_id)->get();

    return view('cv_form')
      ->with('tenders', $tenders)
      ->with('events', $events);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
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
      'fio' => 'required|max:255',
      'email' => 'required|email',
      'phone' => 'required',
      'comment' => 'required',
      'file' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }
    // dd(Input::all());
    $cv = new CvForm();
    $cv->fio = $request->fio;
    $cv->email = $request->email;
    $cv->phone_number = $request->phone;
    $cv->comment = $request->comment;
    $cv->uploaded_file  = FacadesStorage::disk('public_uploads')->put('upload', $request->file('file')); //Storage::putFile('public/upload', $request->file('file'));
    $cv->unique_number  = "BCM" . Carbon::now()->timestamp;
    $cv->status  = 0;
    $cv->save();

    MailController::send($cv->unique_number, $request->comment, $request->fio, 'info@water.gov.uz', 'murojaat@minwater.uz', 'cv', null, asset('uploads/' . $cv->uploaded_file));
    MailController::send($cv->unique_number, '', $request->fio, 'sales@kibera.uz', $request->email, 'murojat_client');

    return redirect()->back()->with('message', $cv->unique_number);
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
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}

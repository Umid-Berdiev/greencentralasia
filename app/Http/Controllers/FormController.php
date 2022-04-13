<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\CvForm;
use App\Models\ObjectSend;
use App\Models\Obuna;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Tender;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Rules\Captcha;
use Illuminate\Support\Facades\Lang;

class FormController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $lang_id = $this->getLang();
    $events = DB::table("events")
      ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
      ->leftJoin("languages", "languages.id", "=", "events.language_id")
      ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
      ->where('events.title', '<>', '')
      ->where("events.language_id", "=", $lang_id)
      ->where("eventcategories.language_id", "=", $lang_id)->take(5)->get();
    $last_month = Carbon::now()->addMonth(-1);
    $now = Carbon::now();

    $last_month1 = Carbon::now()->addMonth(-1)->toDateString();
    $now1 = Carbon::now()->toDateString();
    $all = ObjectSend::whereBetween('created_at', [$last_month, $now])->get()->count();
    $fiz = ObjectSend::whereBetween('created_at', [$last_month, $now])->where('object_type', '=', 'Жисмоний шахс')->count();
    $yur = ObjectSend::whereBetween('created_at', [$last_month, $now])->where('object_type', '=', 'Юридик шахс')->count();
    $worked = ObjectSend::whereBetween('created_at', [$last_month, $now])->where('status', '=', 1)->count();
    $finished = ObjectSend::whereBetween('created_at', [$last_month, $now])->where('status', '=', 3)->count();
    // $languages = Language::where('status', 1)->get();
    $tenders = Tender::take(3)->where('title', '<>', '')->where('language_id', '=', $lang_id)->get();
    return view('send_doc')
      // ->with('languages', $languages)
      ->with('tenders', $tenders)
      ->with('all', $all)
      ->with('fiz', $fiz)
      ->with('yur', $yur)
      ->with('last_month', $last_month)
      ->with('now', $now)
      ->with('last_month1', $last_month1)
      ->with('events', $events)
      ->with('now1', $now1)
      ->with('worked', $worked)
      ->with('finished', $finished);
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

  public function indexContact()
  {
    $contacts = Contact::paginate(15);

    return view('admin.contact')->with('contacts', $contacts);
  }

  public function ContactSearch(Request $request)
  {

    $validator = Validator::make($request->all(), [
      'search' => 'required'
    ]);
    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }
    $contacts = Contact::where('fio', 'LIKE', '%' . $request->search . '%')->paginate(15);

    if ($request->has('search')) {
      return view('admin.contact')->with('contacts', $contacts);
    } else
      return redirect()->back()->with('contacts', $contacts);
  }

  public function indexCV()
  {
    $cvs = CvForm::orderBy('id', 'desc')->paginate(15);
    return view('admin.cv')->with('cvs', $cvs);
  }
  public  function indexCVedit($id)
  {
    $cv = CvForm::where('id', '=', $id)->first();

    return view('admin.cv_edit')->with('cv', $cv);
  }

  public function cvSave(Request $request)
  {
    $cv = CvForm::find($request->id);

    $cv->status = $request->status;
    $cv->update();

    MailController::send($cv->unique_number, '', $cv->status, 'murojaat@minwater.uz', $cv->email, 'murojat_re');

    return redirect()->back();
  }
  public function CvSearch(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'search' => 'required',
    ]);
    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }
    $cvs = CvForm::where('fio', 'LIKE', '%' . $request->search . '%')->paginate(15);

    if ($request->has('search')) {
      return view('admin.cv')->with('cvs', $cvs);
    } else
      return redirect()->back()->with('cvs', $cvs);
  }
  public function indexMurojat()
  {
    $objects = ObjectSend::orderBy('id', 'desc')->paginate(10);

    return view('admin.murojat')->with('objects', $objects);
  }
  public function Murojat_edit($id)
  {
    $object = ObjectSend::find($id);
    return view('admin.murojat_edit')->with('object', $object);
  }
  public function murojat_update(Request $request)
  {
    $object = ObjectSend::find($request->id);
    $object->status = $request->status;
    $object->update();

    MailController::send($object->unique_number, '', $object->status, 'murojaat@minwater.uz', $object->email, 'murojat_re');



    return redirect()->back();
  }
  public function murojatSearch(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'search' => 'required',
    ]);
    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }
    $objects = ObjectSend::where('fio', 'LIKE', '%' . $request->search . '%')->paginate(15);

    if ($request->has('search')) {
      return view('admin.murojat')->with('objects', $objects);
    } else
      return redirect()->back()->with('objects', $objects);
  }

  public function check(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'aplication_id' => 'required|max:255',
    ]);
    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }
    $object_app = ObjectSend::where('unique_number', '=', $request->aplication_id)->first();

    return redirect()->back()->with('check', $object_app);
  }

  public function  contact()
  {
    $lang_id = $this->getLang();
    $events = DB::table("events")
      ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
      ->leftJoin("languages", "languages.id", "=", "events.language_id")
      ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
      ->where('events.title', '<>', '')
      ->where("events.language_id", "=", $lang_id)
      ->where("eventcategories.language_id", "=", $lang_id)->take(5)->get();
    // $languages = Language::where('status', 1)->get();
    $tenders = Tender::take(3)->where('title', '<>', '')->where('language_id', '=', $lang_id)->get();
    return view('gca.contact')
      // ->with('languages', $languages)
      ->with('events', $events)
      ->with('tenders', $tenders);
  }

  public function  contact_post(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'fio' => 'required',
      'email' => 'required',
      'comment' => 'required',
      'g-recaptcha-response' => new Captcha(),
    ]);
    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }
    $contact = new Contact();
    $contact->fio = $request->fio;
    $contact->email = $request->email;
    $contact->comment = $request->comment;
    $contact->save();

    MailController::send_contact($contact);
    //        MailController::send($request->fio,$request->comment,'','info@water.gov.uz',$request->email,'contact_client');
    if (Lang::getLocale() == 'en') {
      return redirect()->back()->with('message', 'Your request is accepted');
    } else {
      return redirect()->back()->with('message', 'Ваше обращение принято');
    }
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
      'birth' => 'required',
      'passport' => 'required',
      'adress' => 'required',
      'index' => 'required',
      'email' => 'required|email',
      'phone_number' => 'required',
      'object_type' => 'required',
      'comment' => 'required',
    ]);
    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $object_send = new ObjectSend();
    $object_send->fio = $request->fio;
    $object_send->birth = $request->birth;
    $object_send->passport = $request->passport;
    $object_send->adress = $request->adress;
    $object_send->index = $request->index;
    $object_send->email = $request->email;
    $object_send->phone_number = $request->phone_number;
    $object_send->object_type = $request->object_type;
    $object_send->comment = $request->comment;
    $object_send->status = 0;
    $object_send->unique_number = "BCM" . Carbon::now()->timestamp;;
    $object_send->save();

    MailController::send($object_send->unique_number, $request->comment, $request->fio, 'info@water.gov.uz', 'murojaat@minwater.uz', 'murojat');
    MailController::send($object_send->unique_number, '', $request->fio, 'info@water.gov.uz', $request->email, 'murojat_client');

    return redirect()->back()->with('message', $object_send->unique_number);
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
    Contact::find($id)->delete();
    return back()->with('success', 'Deleted!');
  }

  public function delete(Request $request)
  {
    if ($request->checkedIds) {
      $ids = explode(',', $request->checkedIds);
      Contact::whereIn('id', $ids)->delete();
      return back()->with('success', 'Deleted!');
    }
    return back()->with('error', 'Bad request');
  }

  public function obuna(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'email' => 'required|max:255|email',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $obuna = new Obuna();
    $obuna->email = $request->email;
    $obuna->save();

    return redirect()->back()->with('message', '');
  }

  public function orpho(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'errortxt' => 'required',
      'comment' => 'required',
    ]);
    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }
    MailController::send($request->errortxt, '', $request->comment, 'info@water.gov.uz', 'murojaat@minwater.uz', 'orph');
    return redirect()->back();
  }

  public function deleteObune(Request $request)
  {
    $model = Obuna::where('id', "=", $request->id)->delete();

    return redirect(App::getLocale() . '/');
  }
}

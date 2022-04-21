<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EventCategory;
use App\Models\Event;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EventController extends Controller
{
  public function index(Request $request)
  {
    $lang_id = current_language()->id;

    if ($request->has("search")) {
      $table = DB::table("events")
        ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
        ->leftJoin("languages", "languages.id", "=", "events.language_id")
        ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
        ->where("events.language_id", $lang_id)
        ->where("eventcategories.language_id", $lang_id)
        ->where("events.title", "LIKE", '%' . $request->search . '%')
        ->orWhere("events.description", "LIKE", '%' . $request->search . '%')
        ->orWhere("events.organization", "LIKE", '%' . $request->search . '%')
        ->orderBy('id', 'desc')
        ->paginate(10);
    } else {
      $table = DB::table("events")
        ->select(['events.*', 'languages.language_name', 'eventcategories.category_name'])
        ->leftJoin("languages", "languages.id", "=", "events.language_id")
        ->leftJoin("eventcategories", "eventcategories.group", "=", "events.event_category_id")
        ->where("events.language_id", "=", $lang_id)
        ->where("eventcategories.language_id", "=", $lang_id)
        ->orderBy('id', 'desc')
        ->paginate(10);
    }

    $languages = Language::where('status', 1)->get();
    $categories = EventCategory::where("language_id", $lang_id)->get();

    return view("admin.event.index", compact(
      "table",
      "languages",
      "categories"
    ));
  }

  public function create()
  {
    $lang_id = current_language()->id;
    $categories = EventCategory::where("language_id", $lang_id)->get();

    return view("admin.event.create", compact("categories"));
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'category_id' => 'required',
      'titles.*' => 'required|max:200|min:3|unique:events,title',
      'dateend' => 'required',
      'datestart' => 'required',
      'cover' => 'required|mimes:jpg,jpeg,gif,png',
      // 'descriptions.*' => 'required',
    ]);
    // dd($request->language_ids);

    if ($validator->fails()) {
      return redirect(route('events.create'))
        ->withErrors($validator)
        ->withInput();
    }

    $grp_id = $this->getGroupId();

    if ($request->hasFile('cover')) {
      $file = $request->file('cover');
      $file_name = 'event_' . time() . '.' . $file->clientExtension();

      Storage::putFileAs('public/events', $file, $file_name);
    }

    foreach ($request->language_ids as $key => $value) {
      $model = Event::create([
        'title' => $request->titles[$key],
        'description' => $request->descriptions[$key],
        'content' => $request->contents[$key],
        'organization' => $request->organizations[$key],
        'dateend' => $request->dateend,
        'datestart' => $request->datestart,
        'event_category_id' => $request->category_id,
        'group' => $grp_id,
        'language_id' => $value,
        'cover' => $file_name
      ]);
    }

    return redirect(route('events.edit', $model->group))->with('success', 'Created!');
  }

  public function edit(Request $request, $id)
  {
    $lang_id = current_language()->id;
    $model  = Event::where('group', $id)->get();
    $categories = EventCategory::where("language_id", $lang_id)->get();;

    return view("admin.event.edit", [
      "model" => $model,
      "grp_id" => $id,
      "categories" => $categories
    ]);
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'category_id' => 'required',
      'titles.*' => 'required|max:200|min:3',
      'dateend' => 'required',
      'datestart' => 'required',
      'cover' => Rule::requiredIf(function () use ($id) {
        $obj = Event::where("group", $id)->first();
        return $obj->cover == 'null';
      }),
      // 'descriptions.*' => 'required',
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    foreach ($request->language_ids as $key => $value) {
      $model = Event::where("group", $id)
        ->where("language_id", $value)->first();

      $model->update([
        'title' => $request->titles[$key],
        'description' => $request->descriptions[$key],
        'content' => $request->contents[$key],
        'organization' => $request->organizations[$key],
        'dateend' => $request->dateend,
        'datestart' => $request->datestart,
        'event_category_id' => $request->category_id,
        'language_id' => $value,
      ]);

      if ($request->hasFile("cover")) {
        $file = $request->file('cover');
        $file_name = 'event_' . time() . '.' . $file->clientExtension();
        $model->update(['cover' => $file_name]);
        Storage::putFileAs('public/events', $file, $file_name);
      }

      if ($request->remove_cover == "on") {
        $model->update(['cover' => 'null']);
      }
    }

    return back()->with('success', 'Updated!');
  }

  public function destroy(Request $request, $id)
  {
    Event::where('group', $id)->delete();
    return redirect(route('events.index'))->with('success', 'Deleted!');
  }

  private function getGroupId()
  {
    return time();
  }

  public function getEvents(Request $request)
  {
    $lang_id = current_language()->id;
    $data = Event::where('language_id', $lang_id)->with('category');
    $data1 = Event::where('language_id', $lang_id)->with('category');

    $today = Carbon::now()->toDateString();

    $upcoming_events = $data1->where('datestart', '>=', $today)->paginate(3);

    if ($request['date'])
      $data = $data->whereDate('datestart', '<=', $request['date'])
        ->whereDate('dateend', '>=', $request['date']);
    if ($request['inputDateFrom'] && $request['inputDateTo'])
      $data = $data->whereBetween('dateend', [$request['inputDateFrom'], $request['inputDateTo']]);
    if ($request['inputDateFrom'] && !$request['inputDateTo'])
      $data = $data->whereDate('datestart', '>=', $request['inputDateFrom']);
    if ($request['inputDateTo'] && !$request['inputDateFrom'])
      $data = $data->whereDate('dateend', '<=', $request['inputDateTo']);
    if ($request['category']) {
      if (!$request['inputDateFrom'] && !$request['inputDateTo']) {
        $data = $data->where('event_category_id', $request['category']);
      } else {
        $data = $data->where('event_category_id', '=', $request['category']);
      }
    }
    $events = $data->paginate(10);

    $categories = EventCategory::where("language_id", $lang_id)->get();
    $eventsDate = Event::select('datestart', 'dateend')->get();
    $eventDates = [];

    foreach ($eventsDate as $item) {
      $dateRange = CarbonPeriod::create($item->datestart, $item->dateend);
      foreach ($dateRange as $date) {
        $eventDates[] = $date->format('Y-m-d');
      }
    }
    return view('gca.events', compact('events', 'categories', 'upcoming_events', 'eventDates'));
  }

  public function getEvent(Request $request)
  {
    $lang_id = current_language()->id;

    if (isset($request->id)) {
      $request->session()->put('event_group', $request->id);
    }

    $group = Event::select('group')->where('id', $request->id)->first()/*      */;
    $event = Event::with('category')->where('group', $group->group)->where('language_id', $lang_id)->first();
    $upcoming_events = Event::where('language_id', $lang_id)
      ->whereDate('dateend', '>=', date('Y-m-d'))
      ->take(5)->get();

    return view('gca.eventin', compact('event', 'upcoming_events'));
  }
}

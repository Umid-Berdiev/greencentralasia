<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use PragmaRX\Tracker\Support\Minutes;
use PragmaRX\Tracker\Vendor\Laravel\Facade as Tracker;

class DashboardController extends Controller
{
  public function index(Request $request)
  {
    $start_of_all_time = Carbon::create(2022, 1, 1, 0, 0, 0);
    $now = Carbon::now();
    $all_time = $start_of_all_time->diffInMinutes($now);
    $sessions = Tracker::sessions();
    // $page_views = Tracker::pageViews($all_time);

    $today = Carbon::today()->diffInMinutes(Carbon::now());
    $yesterday_sessions = $sessions->where([
      'created_at', '>', Carbon::yesterday(),
      'created_at', '<', Carbon::today()
    ])->count();
    $last_week_sessions = $this->sessionsInLastWeek($sessions);
    $last_month_sessions = $this->sessionsInLastMonth($sessions);

    $online_users = Tracker::onlineUsers()->count(); // defaults to 3 minutes
    $today_users = Tracker::users($today)->count();
    $alltime_users = $sessions->count();

    return view('admin.dashboard.index', compact(
      'online_users',
      'today_users',
      'yesterday_sessions',
      'last_week_sessions',
      'last_month_sessions',
      'alltime_users',
    ));
  }

  public function sessionsYesterday($array)
  {
    foreach ($array as $key => $obj) {
      if (isset($obj['date']) && $obj['date'] === date('Y-m-d', strtotime('-1 days'))) {
        return $obj;
      }
    }

    return false;
  }

  public function sessionsInLastWeek($array)
  {
    $first_day = date("Y-m-d", strtotime("-6 days"));
    $last_day = date("Y-m-d");

    if ($array && count($array))
      return $array->where([
        'created_at', '>', $first_day,
        'created_at', '<', $last_day
      ])->count();

    return 0;
  }

  public function sessionsInLastMonth($array)
  {
    $first_day = (int) date("Y-m-d", strtotime("first day of previous month"));
    $last_day = (int) date("Y-m-d", strtotime("last day of previous month"));

    if ($array && count($array))
      return $array->where([
        'created_at', '>', $first_day,
        'created_at', '<', $last_day
      ])->count();

    return 0;
  }
}

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
    $online_users = Tracker::onlineUsers()->count(); // defaults to 3 minutes
    $today = Carbon::today()->diffInMinutes(Carbon::now());
    $yesterday_sessions = $this->sessionsYesterday();
    $last_week_sessions = $this->sessionsInLastWeek();
    $last_month_sessions = $this->sessionsInLastMonth();

    $today_users = Tracker::users($today)->count();
    $alltime_users = Tracker::sessions()->count();

    return view('admin.dashboard.index', compact(
      'online_users',
      'today_users',
      'yesterday_sessions',
      'last_week_sessions',
      'last_month_sessions',
      'alltime_users',
    ));
  }

  public function sessionsYesterday()
  {
    $start_of_yesterday = Carbon::yesterday()->format('Y-m-d H:i:s');
    $start_of_today = Carbon::today()->format('Y-m-d H:i:s');

    $result = 0;

    $result = Tracker::sessions()->where([
      ['created_at', '>=', $start_of_yesterday],
      ['created_at', '<', $start_of_today]
    ])->count();

    return $result;
  }

  public function sessionsInLastWeek()
  {
    // dd($array);
    $first_day = date('Y-m-d H:i:s', strtotime("-6 days"));
    $start_of_today = Carbon::today()->format('Y-m-d H:i:s');

    $result = 0;

    $result = Tracker::sessions()->where([
      ['created_at', '>=', $first_day],
      ['created_at', '<=', $start_of_today]
    ])->count();

    return $result;
  }

  public function sessionsInLastMonth()
  {
    $first_day = date('Y-m-d H:i:s', strtotime("first day of previous month"));
    $last_day = date('Y-m-d H:i:s', strtotime("last day of previous month"));

    return Tracker::sessions()->where([
      'created_at', '>=', $first_day,
      'created_at', '<=', $last_day
    ])->count();

    return 0;
  }
}

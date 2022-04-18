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
    $end_of_all_time = Carbon::now();
    $all_time = $start_of_all_time->diffInMinutes($end_of_all_time);
    $sessions = Tracker::sessions($all_time);
    $today = Carbon::today()->diffInMinutes(Carbon::now());

    $online_users = Tracker::sessions(3)->count(); // defaults to 3 minutes
    $today_users = Tracker::users($today)->count();

    $yesterday_sessions = $this->sessionsYesterday($sessions);
    $last_week_sessions = $this->sessionsInLastWeek($sessions);
    $last_month_sessions = $this->sessionsInLastMonth($sessions);

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

  public function sessionsYesterday($sessions)
  {
    $start_of_yesterday = date('Y-m-d 00:00:00', strtotime('-1 days'));
    $start_of_today = date('Y-m-d 00:00:00');

    $result = $sessions
      ->where('created_at', '>=', $start_of_yesterday)
      ->where('created_at', '<', $start_of_today)
      ->count();

    return $result;
  }

  public function sessionsInLastWeek($sessions)
  {
    $first_day = date('Y-m-d 00:00:00', strtotime("-6 days"));
    $start_of_today = date('Y-m-d H:i:s');

    $result = Tracker::sessions()
      ->where('created_at', '>=', $first_day)
      ->where('created_at', '<=', $start_of_today)
      ->count();

    return $result;
  }

  public function sessionsInLastMonth($sessions)
  {
    $first_day = date('Y-m-d 00:00:00', strtotime("first day of previous month"));
    $last_day = date('Y-m-d 23:59:59', strtotime("last day of previous month"));

    $result = $sessions
      ->where('created_at', '>=', $first_day)
      ->where('created_at', '<=', $last_day)
      ->count();

    return $result;
  }
}

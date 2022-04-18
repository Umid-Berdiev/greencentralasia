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
    $today = Carbon::today()->diffInMinutes(Carbon::now());
    $yesterday = Carbon::yesterday()->diffInMinutes(Carbon::today());
    $last_week = Carbon::today()->subWeek()->diffInMinutes(Carbon::today());
    // $last_month = Carbon::today()->subMonth()->diffInMinutes(Carbon::today());
    // dd($today);

    // $yesterday = new Minutes();
    // $yesterday->setStart(Carbon::yesterday());
    // $yesterday->setEnd(Carbon::today());
    // dd($yesterday);

    // $last_week = new Minutes();
    // $last_week->setStart(Carbon::today()->subDays(7));
    // $last_week->setEnd(Carbon::today());
    // dd($last_week);

    $start_of_last_month = new Carbon('first day of last month');
    $end_of_last_month = new Carbon('last day of last month');
    $last_month = $start_of_last_month->diffInMinutes($end_of_last_month);

    $start_of_all_time = Carbon::create(2022, 1, 1, 0, 0, 0);
    $end_of_all_time = Carbon::now();
    $all_time = $start_of_all_time->diffInMinutes($end_of_all_time);

    $online_users = Tracker::onlineUsers()->count(); // defaults to 3 minutes
    $today_users = Tracker::sessions($today)->count();
    $yesterday_users = Tracker::sessions($yesterday)->count();
    $week_users = Tracker::sessions($last_week)->count();
    $month_users = Tracker::sessions($last_month)->count();
    $alltime_users = Tracker::sessions($all_time)->count();

    return view('admin.dashboard.index', compact(
      'online_users',
      'today_users',
      'yesterday_users',
      'week_users',
      'month_users',
      'alltime_users',
    ));
  }
}

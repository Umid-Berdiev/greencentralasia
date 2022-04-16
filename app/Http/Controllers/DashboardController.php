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
    $today = new Minutes();
    $today->setStart(Carbon::today());
    $today->setEnd(Carbon::now());
    // dd($today);

    $yesterday = new Minutes();
    $yesterday->setStart(Carbon::yesterday());
    $yesterday->setEnd(Carbon::today());
    // dd($yesterday);

    $last_week = new Minutes();
    $last_week->setStart(Carbon::today()->subDays(7));
    $last_week->setEnd(Carbon::today());
    // dd($last_week);

    $start_of_last_month = new Carbon('first day of last month');
    $end_of_last_month = new Carbon('last day of last month');
    $last_month = new Minutes();
    $last_month->setStart($start_of_last_month);
    $last_month->setEnd($end_of_last_month);


    $online_users = Tracker::onlineUsers()->count(); // defaults to 3 minutes
    $today_users = Tracker::users($today)->count();
    $yesterday_users = Tracker::users($yesterday)->count();
    $week_users = Tracker::users($last_week)->count();
    $month_users = Tracker::users($last_month)->count();
    $alltime_users = Tracker::users(0)->count();

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

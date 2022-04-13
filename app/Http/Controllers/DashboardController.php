<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Tracker\Vendor\Laravel\Facade as Tracker;

class DashboardController extends Controller
{
  public function index(Request $request)
  {
    $online_users = Tracker::onlineUsers()->count(); // defaults to 3 minutes
    $today_users = Tracker::users(60 * 24)->count();
    $yesterday_users = Tracker::users(60 * 24)->count();
    $month_users = Tracker::users(60 * 24)->count();
    $alltime_users = Tracker::users(0)->count();

    return view('admin.dashboard.index', compact(
      'online_users',
      'today_users',
      'yesterday_users',
      'month_users',
      'alltime_users',
    ));
  }
}

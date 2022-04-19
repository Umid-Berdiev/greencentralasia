<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PragmaRX\Tracker\Support\Minutes;
use PragmaRX\Tracker\Vendor\Laravel\Facade as Tracker;

class DashboardController extends Controller
{
  public function index(Request $request)
  {
    // $online_users = Tracker::onlineUsers()->count(); // defaults to 3 minutes
    $today_users = Session::today();
    $yesterday_sessions = Session::yesterday();
    $last_week_sessions = Session::lastSevenDays();
    $last_month_sessions = Session::previousMonth();
    $alltime_users = Session::count();

    return view('admin.dashboard.index', compact(
      // 'online_users',
      'today_users',
      'yesterday_sessions',
      'last_week_sessions',
      'last_month_sessions',
      'alltime_users',
    ));
  }
}

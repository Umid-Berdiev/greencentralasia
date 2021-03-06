<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PragmaRX\Tracker\Vendor\Laravel\Facade as Tracker;

class Session extends Model
{
  use HasFactory;

  public static function online()
  {
    $now = Carbon::now();
    $three_minutes_ago = $now->subMinutes(3)->format('Y-m-d H:i:s');

    $result = DB::connection('tracker')
      ->table('tracker_sessions')
      ->where('is_robot', 0)
      ->where('created_at', '>=', $three_minutes_ago)
      ->count();

    return $result;
  }

  public static function today()
  {
    $today = Carbon::today()->diffInMinutes(Carbon::now());

    $result = Tracker::sessions($today)->where('is_robot', 0)->count();

    return $result;
  }

  public static function yesterday()
  {
    $start_of_yesterday = date('Y-m-d 00:00:00', strtotime('-1 days'));
    $start_of_today = date('Y-m-d 00:00:00');

    $result = DB::connection('tracker')
      ->table('tracker_sessions')
      ->where('is_robot', 0)
      ->where('created_at', '>=', $start_of_yesterday)
      ->where('created_at', '<', $start_of_today)
      ->count();

    return $result;
  }

  public static function lastSevenDays()
  {
    $first_day = date('Y-m-d 00:00:00', strtotime("-6 days"));
    $start_of_today = date('Y-m-d H:i:s');

    $result = DB::connection('tracker')
      ->table('tracker_sessions')
      ->where('is_robot', 0)
      ->where('created_at', '>=', $first_day)
      ->where('created_at', '<=', $start_of_today)
      ->count();

    return $result;
  }

  public static function previousMonth()
  {
    $first_day = date('Y-m-d 00:00:00', strtotime("first day of previous month"));
    $last_day = date('Y-m-d 23:59:59', strtotime("last day of previous month"));

    $result = DB::connection('tracker')
      ->table('tracker_sessions')
      ->where('is_robot', 0)
      ->where('created_at', '>=', $first_day)
      ->where('created_at', '<=', $last_day)
      ->count();

    return $result;
  }

  public static function allTime()
  {
    $result = DB::connection('tracker')
      ->table('tracker_sessions')
      ->where('is_robot', 0)
      ->count();

    return $result;
  }
}

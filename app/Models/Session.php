<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Session extends Model
{
  use HasFactory;

  public static function today()
  {
    $start_of_today = Carbon::today()->timestamp;
    $now = Carbon::now()->timestamp;

    $result = DB::table('sessions')->where([
      ['last_activity', '>=', $start_of_today],
      ['last_activity', '<', $now]
    ])->count();

    return $result;
  }

  public static function yesterday()
  {
    $start_of_yesterday = Carbon::yesterday()->timestamp;
    $start_of_today = Carbon::today()->timestamp;

    $result = DB::table('sessions')->where([
      ['last_activity', '>=', $start_of_yesterday],
      ['last_activity', '<', $start_of_today]
    ])->count();

    return $result;
  }

  public static function lastSevenDays()
  {
    $first_day = Carbon::today()->subDay(7)->timestamp;
    $start_of_today = Carbon::today()->timestamp;

    $result = DB::table('sessions')->where([
      ['last_activity', '>=', $first_day],
      ['last_activity', '<', $start_of_today]
    ])->count();

    return $result;
  }

  public static function previousMonth()
  {
    $start = new Carbon('first day of last month');
    $end = new Carbon('last day of last month');

    $result = DB::table('sessions')->where([
      ['last_activity', '>=', $start->timestamp],
      ['last_activity', '<=', $end->timestamp]
    ])->count();

    return $result;
  }
}

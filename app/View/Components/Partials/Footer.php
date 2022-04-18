<?php

namespace App\View\Components\Partials;

use Carbon\Carbon;
use Illuminate\View\Component;
use PragmaRX\Tracker\Support\Minutes;
use PragmaRX\Tracker\Vendor\Laravel\Facade as Tracker;

class Footer extends Component
{
  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct()
  {
    //
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render()
  {
    $online_visitors = Tracker::onlineUsers()->count(); // defaults to 3 minutes
    $today = Carbon::today()->diffInMinutes(Carbon::now());
    $today_visitors = Tracker::sessions($today)->count();

    return view('components.partials.footer', compact('today_visitors', 'online_visitors'));
  }
}

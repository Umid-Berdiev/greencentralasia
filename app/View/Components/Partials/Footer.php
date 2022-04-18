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
    $today = new Minutes();
    $today->setStart(Carbon::today());
    $today->setEnd(Carbon::now());
    $today_visitors = Tracker::sessions($today)->count(); // defaults to 3 minutes
    $online_users = Tracker::onlineUsers()->count(); // defaults to 3 minutes

    return view('components.partials.footer', compact('today_visitors', 'online_users'));
  }
}

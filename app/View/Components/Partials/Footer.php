<?php

namespace App\View\Components\Partials;

use App\Models\Session;
use Carbon\Carbon;
use Illuminate\View\Component;
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
    return view('components.partials.footer');
  }

  // public function online_visitors()
  // {
  //   return Tracker::onlineUsers()->count(); // defaults to 3 minutes
  // }

  public function today_visitors()
  {
    return Session::today();
  }
}

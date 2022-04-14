<?php

namespace App\View\Components\Partials;

use App\Models\MenuMaker;
use Illuminate\View\Component;

class MainMenu extends Component
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
    $menu = MenuMaker::where('language_id', current_language()->id)->orderBy('orders')->get();
    return view('components.partials.main-menu', compact('menu'));
  }
}

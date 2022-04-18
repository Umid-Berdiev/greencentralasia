<?php

namespace App\View\Components\Partials;

use App\Models\MenuMaker;
use Illuminate\View\Component;

class FooterMenuMap extends Component
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
    $lang_id = current_language()->id;
    $menu = MenuMaker::with('children')
      ->where('parent_id', 0)
      ->where("language_id", $lang_id)
      ->orderBy("orders")
      ->get();
    // $menu = MenuMaker::where('language_id', current_language()->id)->orderBy('orders')->get();

    return view('components.partials.footer-menu-map', compact('menu'));
  }
}

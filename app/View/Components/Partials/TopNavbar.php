<?php

namespace App\View\Components\Partials;

use App\Models\Language;
use Illuminate\View\Component;

class TopNavbar extends Component
{
  public $languages;

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($languages)
  {
    $this->languages = $languages;
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render()
  {
    // $languages = Language::query();
    return view('components.partials.top-navbar');
  }
}

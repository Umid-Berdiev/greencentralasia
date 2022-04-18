<?php

namespace App\View\Components\Partials\Admin;

use Illuminate\View\Component;

class LangSwitcher extends Component
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
    return view('components.partials.admin.lang-switcher');
  }
}

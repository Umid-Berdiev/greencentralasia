<?php

namespace App\Providers;

use App\Models\Language;
use App\Models\MenuMaker;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    Paginator::useBootstrap();

    View::composer('gca.blocks.menu', function ($view) {
      $view->with('menu', MenuMaker::where('language_id', current_language()->id)->orderBy('orders')->get());
    });

    View::composer(['gca.*', 'admin.*'], function ($view) {
      $view->with('languages', Language::query());
    });
  }
}

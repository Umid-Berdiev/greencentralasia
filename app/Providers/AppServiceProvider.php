<?php

namespace App\Providers;

use App\Models\Language;
use App\Models\Session;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use PragmaRX\Tracker\Vendor\Laravel\Facade as Tracker;

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

    View::composer(['gca.*', 'admin.*'], function ($view) {
      $view->with('languages', Language::query());
    });

    View::composer(['gca.layouts.master'], function ($view) {
      $visitors = [
        'online_visitors' => Tracker::onlineUsers()->count(), // defaults to 3 minutes
        'today_visitors' => Session::today()
      ];

      $view->with('visitors', $visitors);
    });
  }
}

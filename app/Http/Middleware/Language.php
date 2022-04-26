<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\Language as LanguageModel;

class Language
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    if ($request->locale) {
      $locales = LanguageModel::all()->pluck('language_prefix')->toArray();

      if (in_array($request->locale, $locales)) {
        app()->setLocale($request->locale);
        return $next($request);
      } else {
        app()->setLocale('en');
        return $next($request);
      }
    } else {
      if (
        $request->segment(1) == "locale"
        || $request->segment(1) == "admin"
        || $request->segment(1) == "laravel-filemanager"
        || $request->segment(1) == "login"
        || $request->segment(1) == "contact_post"
        || $request->segment(1) == "send_post"
        || $request->segment(1) == "check"
        || $request->segment(1) == "cv_form_post"
        || $request->segment(1) == "obuna"
        || $request->segment(1) == "vote"
        || $request->segment(1) == "storage"
        || $request->segment(1) == "mail"
        || $request->segment(1) == "uploadsdialog"
        || $request->segment(1) == "forums"
        || $request->segment(1) == "register"
        || $request->segment(1) == "home"
        || $request->segment(1) == "logout"
        || $request->segment(1) == "artisan"
      ) {
        return $next($request);
      } else {
        return redirect("/" . app()->currentLocale());
      }
    }
  }
}

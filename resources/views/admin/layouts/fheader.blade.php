<header>
  <div class="container">
    <div class="row">
      <div class="col-lg-2">
        <div class="logo">
          <a href="{{ URL('/') }}">
            <img class="img-fluid" src="{{ URL::asset('frondend/img/logo/black.png') }}" alt="">
          </a>
        </div>
      </div>
      <div class="col-lg-10">
        <nav>
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="{{ URL(App::getLocale()." /about") }}">{{ trans("home.project") }} </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" aria-expanded="false" data-toggle="dropdown" href="#">{{
                trans("home.books") }} <i class="fa fa-arrow-down"></i>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a href="{{ URL(App::getLocale()." /book/ru") }}">{{ trans("home.ru") }}</a>
                </li>
                <li>
                  <a href="{{ URL(App::getLocale()." /book/en") }}">{{ trans("home.en") }}</a>
                </li>
                <li>
                  <a href="{{ URL(App::getLocale()." /book/uz") }}">{{ trans("home.uz") }}</a>
                </li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" aria-expanded="false" data-toggle="dropdown" href="#">{{
                trans("home.audiobook") }} <i class="fa fa-arrow-down"></i>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a href="{{ URL(App::getLocale()." /audio/ru") }}">{{ trans("home.ru") }}</a>
                </li>
                <li>
                  <a href="{{ URL(App::getLocale()." /audio/en") }}">{{ trans("home.en") }}</a>
                </li>
                <li>
                  <a href="{{ URL(App::getLocale()." /audio/uz") }}">{{ trans("home.uz") }}</a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ URL(App::getLocale()." /news") }}">{{ trans("home.news") }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ URL(App::getLocale()." /contact") }}">{{ trans("home.contact") }}</a>
            </li>

            @if(Request::session()->exists("name"))
            <li class="nav-item breadcrumb-itm">
              <a class="nav-link" href="{{ URL(App::getLocale()." /profile") }}">{{ trans("bookadmin.profile") }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ URL(App::getLocale()." /exit") }}">{{ trans("bookadmin.exit") }}</a>
            </li>
            @else
            <li class="nav-item breadcrumb-itm">
              <a class="nav-link" href="{{ URL(App::getLocale()." /enter") }}">{{ trans("bookadmin.enter") }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ URL(App::getLocale()." /reg") }}">{{ trans("home.reg") }}</a>
            </li>
            @endif
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" aria-expanded="false" data-toggle="dropdown" href="#">{{
                App::getLocale() }} <i class="fa fa-arrow-down"></i>
              </a>
              <ul class="dropdown-menu language-menu">

                @if(App::getLocale() == "uz")

                <li>
                  <a href="{{ URL('/ru') }}">RU</a>
                </li>
                <li>
                  <a href="#{{ URL('/en') }}">EN</a>
                </li>
                @endif

                @if(App::getLocale() == "ru")

                <li>
                  <a href="#{{ URL('/uz') }}">UZ</a>
                </li>
                <li>
                  <a href="#{{ URL('/en') }}">EN</a>
                </li>
                @endif

                @if(App::getLocale() == "en")

                <li>
                  <a href="#{{ URL('/uz') }}">UZ</a>
                </li>
                <li>
                  <a href="{{ URL('/ru') }}">RU</a>
                </li>
                @endif
              </ul>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
  <div class="menu-btn">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
  </div>
</header>

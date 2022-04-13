<div class="mobile-menu">
  <ul class="list">
    <li>
      <a href="{{ URL(App::getLocale()." /about") }}">{{ trans("home.project") }}</a>
    </li>
    <li>
      <a href="{{ URL(App::getLocale()." /book") }}" class="menu-toggle">{{ trans("home.books") }}</a>
      <ul class="ml-menu">
        <li>
          <a href="{{ URL('/ru/book') }}">{{ trans("home.ru") }}</a>
        </li>
        <li>
          <a href="{{ URL('/en/book') }}">{{ trans("home.en") }}</a>
        </li>
        <li>
          <a href="{{ URL('/uz/book') }}">{{ trans("home.uz") }}</a>
        </li>
      </ul>
    </li>
    <li>
      <a href="#" class="menu-toggle">{{ trans("home.audiobook") }}</a>
      <ul class="ml-menu">
        <li>
          <a href="{{ URL('/ru/book') }}">{{ trans("home.uz") }}">{{ trans("home.ru") }}</a>
        </li>
        <li>
          <a href="{{ URL('/en/book') }}">{{ trans("home.uz") }}">{{ trans("home.en") }}</a>
        </li>
        <li>
          <a href="{{ URL('/uz/book') }}">{{ trans("home.uz") }}">{{ trans("home.uz") }}</a>
        </li>
      </ul>
    </li>
    <li>
      <a href="{{ URL(App::getLocale()." /news") }}">{{ trans("home.news") }}</a>
    </li>
    <li>
      <a href="{{ URL(App::getLocale()." /contact") }}">Контакты</a>
    </li>
    <li>
      <a href="{{ URL(App::getLocale()." /enter") }}">Вход</a>
    </li>
    <li>
      <a href="{{ URL(App::getLocale()." /reg") }}">{{ trans("home.reg") }}</a>
    </li>
    <li>
      <a href="#" class="menu-toggle">RU</a>
      <ul class="ml-menu">
        <li>
          <a href="{{ URL('/uz') }}">UZ</a>
        </li>
        <li>
          <a href="#">ENG</a>
        </li>
      </ul>
    </li>
  </ul>
</div>

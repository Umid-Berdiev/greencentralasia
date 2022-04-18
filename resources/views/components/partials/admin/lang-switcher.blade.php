<ul class="nav navbar-nav">
  @foreach($languages as $key => $language)
  <li class="my-auto">
    <a class="text-uppercase {{ app()->getLocale() === $language->language_prefix ? 'text-primary' : '' }}"
      href="{{ route('set-locale', ['locale' => $language->language_prefix]) }}">
      {{ $language->language_prefix }}
    </a>
  </li>
  @endforeach
</ul>

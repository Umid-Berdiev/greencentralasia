<div class="container-fluid">
  <div class="hdr_main row justify-content-center">
    <x-application-logo />
    {{-- <ul class="ht_ul">
      @foreach ($menu->where('parent_id', 0) as $item)
      @php
      $sub_menu = $menu->where('parent_id', $item->group);
      @endphp
      @if (count($sub_menu) > 0)
      <li class="sub_menu">
        <a href="#">{{ $item->menu_name }}</a>
        <ul>
          @foreach ($sub_menu as $sub_item)
          <li>
            <a href="{{ url(app()->getLocale() . $sub_item->link) }}">{{ $sub_item->menu_name }}</a>
          </li>
          @endforeach
        </ul>
      </li>
      @else
      <li>
        <a href="{{ url(app()->getLocale() . $item->link) }}">{{ $item->menu_name }}</a>
      </li>
      @endif
      @endforeach
    </ul> --}}
    @include('components.partials.main-menu-list')

    <div class="form_header">
      <x-icons.menu-search-icon />
      <form action="{{ url(app()->getLocale() . '/search') }}" class="navbar-form" style="width: max-content;">
        <div class="form-group">
          <input type="text" name="search" placeholder="@lang('blog.search')">
          <button type="submit">
            <x-icons.search-icon />
          </button>
        </div>
      </form>
    </div>
    <div class="hamburger">
      <svg viewBox="0 0 100 80" width="40" height="40">
        <rect width="100" height="10"></rect>
        <rect y="30" width="100" height="10"></rect>
        <rect y="60" width="100" height="10"></rect>
      </svg>
    </div>
  </div>
</div>

<ul class="ht_ul">
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
</ul>

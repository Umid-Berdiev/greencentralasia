<div>
  <ul class="ht_ul">
    @foreach ($menu->where('parent_id', 0) as $item)
    @if(count($item->children) > 0)
    <li class="accordion">
      <a href="javascript:void(0)">{{ $item->menu_name }}</a>
    </li>
    <div class="panel">
      <ul class="mb-3">
        @foreach ($item->children as $sub_item)
        <li>
          <a href="{{ url(app()->getLocale() . $sub_item->link) }}">{{ $sub_item->menu_name }}</a>
        </li>
        @endforeach
      </ul>
    </div>
    @else
    <li>
      <a href="{{ url(app()->getLocale() . $item->link) }}">{{ $item->menu_name }}</a>
    </li>
    @endif
    @endforeach
    <li>
      <a href="" onclick="localStorage.removeItem('cookiesAccepted')">Revoke Cookies</a>
    </li>
  </ul>
</div>

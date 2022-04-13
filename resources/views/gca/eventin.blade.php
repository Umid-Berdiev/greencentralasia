@extends('gca.layout')
@section('content')
{{--@section('main_top_layout')--}}
{{--    <section class="main_top_layout" style="background-image: url({{asset('gca/images/main.jpg')}});">--}}
{{--        <div class="container">--}}
{{--            <h2>--}}
{{--                <span>News & Articles</span>--}}
{{--            </h2>--}}
{{--        </div>--}}
{{--    </section--}}
{{--@endsection--}}

<section class="inner_all">
  {{-- @dd($event) --}}
  <div class="container">
    <div class="bar_inner">
      <div class="bar_inner_left">
        <div class="text_layout">
          <span class="date_ban">{{ $event->datestart->format('d.m.Y') }} -
            {{ $event->dateend->format('d.m.Y') }} </span>
          <h1>{{ $event->title }}</h1>
          <img src="{{ asset('storage/events/' . $event->cover) }}" alt="Event cover image">
          <p>{{ $event->description }}</p>
          <p>{!! $event->content !!}</p>
        </div>
      </div>
      <div class="bar_inner_right">
        <div class="bar_inner_events event_bord">
          <h3>@lang('blog.events')</h3>
          @foreach($upcoming_events as $item)
          <a href="{{ url(app()->getLocale() . '/event?id=' . $item->id) }}" class="news_item">
            <img src="{{ asset('storage/events/' . $item->cover) }}" alt="Event cover image">
            <div>
             {{-- < span>{{ $item->datestart->format('d.m.Y') }} - --}}
                {{ $item->dateend->format('d.m.Y') }}</>
              <p>{{ $item->title }}</p>
            </div>
          </a>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
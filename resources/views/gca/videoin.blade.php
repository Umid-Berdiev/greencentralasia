@extends('gca.layout')
@section('content')
@section('main_top_layout')
<section class="main_top_layout" style="background-image: url({{ asset('gca/images/main.jpg') }});">
  <div class="container">
    <h2>
      <span>@lang('blog.video')</span>
    </h2>
  </div>
</section>
@endsection

<section class="news_inner media_section">
  <div class="container">
    <div class="row row-cols-3">
      @foreach($table as $item)
      <div class="col-auto">
        <iframe width="100%" height="300" src="https://www.youtube.com/embed/{{ $item->youtube_link}}" frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowfullscreen></iframe>
        <h3>{{ $item->name }}</h3>
      </div>
      @endforeach

    </div>
    <div class="text_center">
      {{ $table->links() }}
    </div>
  </div>
</section>
@endsection
@extends('gca.layouts.master')
@section('content')
@section('main_top_layout')
<section class="main_top_layout" style="background-image: url({{asset('project_gca/images/main.jpg')}});">
  <div class="container">
    <h2>
      <span>@lang('blog.photo')</span>

    </h2>
  </div>
</section>
@endsection

<section class="news_inner media_section">
  <div class="container">
    <div class="row for_med">
      @foreach($table as $photo)
      <div class="col-sm-3 col-4">
        <div class="over" data-fancybox=":gallery" data-src="{{ asset('/storage/photos/' . $photo->cover) }}">
          <img src="{{ asset('/storage/photos/' . $photo->cover) }}">
          <h3>{{ $photo->name }}</h3>
        </div>
      </div>
      @endforeach
    </div>
    <div class="text_center">
      {{ $table->links() }}
    </div>
  </div>
</section>
@endsection

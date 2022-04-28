@extends('gca.layouts.master')

@section('content')
<section class="inner_all">
  <div class="container">
    <div class="bar_inner">
      <div class="bar_inner_left">
        <div class="text_layout">
          <h1>{{ $table->title }}</h1>
          <div class="row">
            @if($table->r_number != null)
            <span class="date_ban">@lang('blog.register_date'): {{$table->r_date}} | @lang('blog.number'):
              {{$table->r_number}} </span>
            @endif
            <div class="col-md-7">
              @if($table->link != null)
              <div class="">
                <img src="{{ URL('/storage/images/lexuz.png') }}" alt="" width="75" height="50">
                <a href="{{URL($table->link)}}">
                  <h6>
                    @lang('blog.read_on_lexuz')
                  </h6>
                </a>
              </div>
              @endif
              @if($table->file_type == 'docx' || $table->file_type == 'doc')
              <div class="">
                <img src="{{ URL('/storage/images/word.jpeg') }}" alt="cover image doc inside">
                <a href="{{URL(App::getLocale().'/downloads?type=doc&id='.$table->id)}}">
                  <h6>
                    @lang('blog.download') ({{ round($table->file_size/1024) }} KB)
                  </h6>
                </a>
              </div>
              @elseif($table->file_type == 'pdf')
              <div class="">
                <embed class="border mb-3" src="{{ URL('/storage/upload/'.$table->files) }}" width="320" height="300" />
                <a href="{{URL(App::getLocale().'/downloads?type=doc&id='.$table->id)}}">
                  <h6>
                    @lang('blog.download') ({{ round($table->file_size/1024) }} KB)
                  </h6>
                </a>
              </div>
              @else
              <div class="">
                <img src="{{ URL('/storage/images/ppt.png') }}" alt="cover image doc inside">
                <a href="{{URL(App::getLocale().'/downloads?type=doc&id='.$table->id)}}">
                  <h6>
                    @lang('blog.download') ({{ round($table->file_size/1024) }} KB)
                  </h6>
                </a>
              </div>
              @endif
            </div>
          </div>
          {!! $table->description !!}
        </div>
      </div>
      <div class="bar_inner_right">
        <div class="bar_inner_events event_bord">
          <h3>@lang('blog.docs')</h3>
          @foreach($newscat as $value)
          <a href="{{ URL(App::getLocale().'/doc/'.$value->group) }}" class="news_item">
            <div>
              <p>{{ $value->category_name }}</p>
            </div>
          </a>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

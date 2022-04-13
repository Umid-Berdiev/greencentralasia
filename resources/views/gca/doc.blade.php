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
    <div class="container">
        <div class="bar_inner">
            <div class="bar_inner_left">
                <div class="text_layout">
                    {{--                        <span class="date_ban">{{ \Carbon\Carbon::parse($news->datetime)->format('d.m.Y') }}</span>--}}
                    <h1>{{ $table->title }}</h1>
                    <div class="row">
                        @if($table->r_number != null)
                        <span class="date_ban">@lang('blog.register_date'): {{$table->r_date}} | @lang('blog.number'):
                            {{$table->r_number}} </span>
                        @endif
                        <div class="col-md-7">
                            @if($table->link != null)
                            <div class="col-md-4">
                                <h6><a href="{{URL($table->link)}}"><img src="{{URL('storage/images/lexuz.png')}}" alt=""
                                            width="75" height="50"> Lex.uz да ўқиш</a></h6>
                            </div>
                            @endif
                            @if($table->file_type == 'docx' || $table->file_type == 'doc')
                            <div class="col-md-4">
                                <h6><a href="{{URL(App::getLocale().'/downloads?type=doc&id='.$table->id)}}"><img
                                    src="{{URL('/storage/images/word.jpeg')}}" alt="cover image doc inside"  >
                                        @lang('blog.download')
                                        ({{round($table->file_size/1024)}} KB)</a></h6>
                            </div>
                            @elseif($table->file_type == 'pdf')
                            <div class="col-md-4">
                                <h6><a href="{{URL(App::getLocale().'/downloads?type=doc&id='.$table->id)}}">
                                    <embed src="{{ URL('storage/upload/'.$table->files) }}" width="320" height="300" />
                                        @lang('blog.download')
                                        ({{round($table->file_size/1024)}} KB)</a></h6>
                            </div>
                            @else
                                <div class="col-md-4">
                                    <h6><a href="{{URL(App::getLocale().'/downloads?type=doc&id='.$table->id)}}"><img
                                        src="{{URL('/storage/images/ppt.png')}}" alt="cover image doc inside"  >
                                            @lang('blog.download')
                                            ({{round($table->file_size/1024)}} KB)</a></h6>
                                </div>
                            @endif
                        </div>
                    </div>
                    {{--                        <img src="{{ URL(App::getLocale().'/downloads?type=post&id='.$news->group) }}"
                    alt="{{$news->title}}">--}}
                    {!! $table->description !!}
                </div>
            </div>
            <div class="bar_inner_right">
                <div class="bar_inner_events event_bord">
                    <h3>@lang('blog.docs')</h3>
                    @foreach($newscat as $value)

                    <a href="{{ URL(App::getLocale().'/doc/'.$value->group) }}" class="news_item">
                        {{--                                    <img src="{{URL(App::getLocale().'/downloads?type=event&id='.$value->group)}}"
                        alt="">--}}
                        <div>
                            {{--                                        <span>{{ \Carbon\Carbon::parse($value->created_at)->format('d.m.Y')  }}</span>--}}
                            <p>{{$value->category_name}}</p>
                        </div>
                    </a>
                    @endforeach
                    {{-- <hr>
                    <h3>@lang('blog.events')</h3>
                    @foreach($events as $value)
                    <a href="{{URL(App::getLocale().'/event/'.$value->event_category_id.'/'.$value->group)}}"
                    class="news_item">
                    <img src="{{URL(App::getLocale().'/downloads?type=event&id='.$value->group)}}" alt="">
                    <div>
                        <span>{{ \Carbon\Carbon::parse($value->created_at)->format('d.m.Y')  }}</span>
                        <p>{{$value->title}}</p>
                    </div>
                    </a>
                    @endforeach --}}

                </div>

            </div>
        </div>
    </div>
</section>
@endsection
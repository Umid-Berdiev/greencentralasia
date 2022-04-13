@extends('gca.layout')
@section('content')
<section class="inner_all">
  <div class="container">
    <div class="bar_inner">
      <div class="bar_inner_left">
        @forelse($table as $value)
        <div class="item_documents">
          <div class="item_documents_left">
            @if($value->file_type=="pdf")
            <a href="{{URL(App::getLocale().'/downloads?type=doc&id='.$value->id)}}">
              <embed src="{{ URL('storage/upload/'.$value->files) }}" width="320" height="300" />
            </a>
            @elseif($value->file_type=="doc"||$value->file_type=="docx")
                <img src="{{URL('storage/images/word.jpeg')}}" alt=""  width="320" height="300">
            @else
              <img src="{{URL('storage/images/ppt.png')}}" alt=""  width="320" height="300">
            @endif  
          </div>
          <div class="item_documents_right">
            <a href="{{URL(App::getLocale().'/doc/'.$value->doc_category_id.'/'.$value->group)}}">{{$value->title}}</a>
            <span class="date_ban">
              @lang('blog.register_date'): {{$value->r_date}} | @lang('blog.number'):{{$value->r_number}}
            </span>
            <p>
              {!!$value->description!!}
            </p>

          </div>
        </div>
        @empty
        <h3>@lang('blog.no_content')</h3>
        @endforelse
        <div class="text_center">
          {{ $table->links() }}
        </div>
      </div>
      <div class="bar_inner_right">
        <div class="bar_inner_events event_bord">
          <h3>@lang('blog.docs')</h3>
          @foreach($newscat as $value)

          <a href="{{ URL(App::getLocale().'/doc/'.$value->group) }}" class="news_item">
            <div>
              <p>{{$value->category_name}}</p>
            </div>
          </a>
          @endforeach
        </div>

      </div>
    </div>
  </div>
</section>
@endsection
@extends('gca.layout')
@section('content')
@section('main_top_layout')
    <section class="main_top_layout" style="background-image: url({{ asset('gca/images/main.jpg') }});">
        <div class="container">
            <h2>
                @if ($news[0]->category_group_id == '1615268167')
                    <span>@lang('blog.know')</span>
                @else
                    <span>@lang('blog.news')</span>
                @endif
            </h2>
        </div>
    </section>
@endsection

<section class="news_inner">
    <div class="container">
        <div class="row">
            @foreach ($news as $item)
                <div class="col-lg-3 col-sm-6 mb-3">
                    <a href="{{ url(app()->getLocale() . '/posts/' . $item->category_group_id . '/' . $item->group) }}"
                        class="card">
                        <div class="card-img">
                            <img src="{{ asset('storage/posts/' . $item->cover) }}" alt="News image">
                        </div>
                        <div class="card-body auto-height" style="background-color:#d4d0cf">
                            <span
                                class="card_time">{{ \Carbon\Carbon::parse($item->datetime)->format('d.m.Y') }}</span>
                            <h5 class="card-title">{{ $item->title }}</h5>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="text_center">
            <nav aria-label="Page navigation example">
                {{ $news->appends(['cutcat' => Request::get('cutcat'), 'start' => Request::get('start'), 'finish' => Request::get('finish')])->links() }}
            </nav>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script>
    var cards = document.getElementsByClassName('auto-height');
    var max = 0
    cards.forEach(card => {
        if (max < card.clientHeight)
            max = card.clientHeight
    });
    console.log('max=', max)
    cards.forEach(card => {
        card.style.height = max + "px"
    });
</script>
@endpush

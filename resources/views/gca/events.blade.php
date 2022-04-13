@extends('gca.layout')
@section('content')
@section('main_top_layout')
    <section class="main_top_layout" style="background-image: url({{ asset('gca/images/main.jpg') }});">
        <div class="container">
            <h2>
                <span>@lang('events.events')</span>
            </h2>
        </div>
    </section>
@endsection
<section class="calendars " style="background: url({{ asset('project_gca/images/card2.jpg') }});">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-4 left_cal">
                <span class="template_span">@lang('blog.coming_events')</span>
                <div class="bts_cal">
                    <div id="datepicker"></div>
                    <input type="hidden" id="my_hidden_input">

                </div>
            </div>
            <div class="col-lg-6 col-sm-8 right_cal">
                @foreach ($upcoming_events as $event)
                    <a href="{{ url(app()->getLocale() . '/event?id=' . $event->id) }}" style="text-decoration:unset">
                        <div class="new_event">
                            <div class="new_event_date">
                                <svg width="11" height="11" viewBox="0 0 11 11" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5.5 11C4.4122 11 3.34884 10.6774 2.44437 10.0731C1.5399 9.46874 0.834947 8.60975 0.418665 7.60476C0.00238306 6.59977 -0.106535 5.4939 0.105683 4.42701C0.317902 3.36011 0.841726 2.3801 1.61091 1.61091C2.3801 0.841726 3.36011 0.317902 4.42701 0.105683C5.4939 -0.106535 6.59977 0.00238306 7.60476 0.418665C8.60975 0.834947 9.46874 1.5399 10.0731 2.44437C10.6774 3.34884 11 4.4122 11 5.5C11 6.95869 10.4205 8.35764 9.38909 9.38909C8.35764 10.4205 6.95869 11 5.5 11ZM5.5 0.785717C4.5676 0.785717 3.65615 1.0622 2.88089 1.58022C2.10563 2.09823 1.50138 2.8345 1.14457 3.69592C0.787757 4.55735 0.694399 5.50523 0.8763 6.41971C1.0582 7.33419 1.50719 8.1742 2.1665 8.8335C2.8258 9.49281 3.66581 9.9418 4.58029 10.1237C5.49477 10.3056 6.44266 10.2122 7.30408 9.85543C8.1655 9.49862 8.90177 8.89438 9.41979 8.11912C9.9378 7.34386 10.2143 6.4324 10.2143 5.5C10.2143 4.2497 9.7176 3.0506 8.8335 2.1665C7.9494 1.2824 6.75031 0.785717 5.5 0.785717Z"
                                        fill="#2DA37D" />
                                    <path
                                        d="M7.30322 7.85721L5.10715 5.66114V1.96436H5.89286V5.33507L7.85715 7.30328L7.30322 7.85721Z"
                                        fill="#2DA37D" />
                                </svg>
                                {!! $event->datestart->format('d.m.Y') . ' - ' . $event->dateend->format('d.m.Y') !!}
                            </div>
                            <div class="new_event_adr">
                                <svg width="7" height="11" viewBox="0 0 7 11" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3.43965 0C1.53959 0 0 1.5334 0 3.43277C0 6.71695 3.43965 11 3.43965 11C3.43965 11 6.8793 6.71626 6.8793 3.43277C6.8793 1.53408 5.33971 0 3.43965 0ZM3.43965 5.33215C2.94703 5.33215 2.47459 5.13645 2.12626 4.78812C1.77793 4.43979 1.58224 3.96735 1.58224 3.47473C1.58224 2.98212 1.77793 2.50968 2.12626 2.16135C2.47459 1.81301 2.94703 1.61732 3.43965 1.61732C3.93227 1.61732 4.40471 1.81301 4.75304 2.16135C5.10137 2.50968 5.29706 2.98212 5.29706 3.47473C5.29706 3.96735 5.10137 4.43979 4.75304 4.78812C4.40471 5.13645 3.93227 5.33215 3.43965 5.33215Z"
                                        fill="#2DA37D" />
                                </svg>
                                {{ $event->organization }}
                            </div>
                            <div>
                                {{ $event->title }}
                                <div class="new_event_date">{{ $event->category->category_name }}</div>
                            </div>
                            <img src="{{ asset('storage/events/' . $event->cover) }}" alt="event cover">
                        </div>
                    </a>
                @endforeach
                <div>
                    {{ $upcoming_events->links() }}
                </div>
            </div>
        </div>
    </div>
</section>

<section class="event_inner">
    <div class="container">
        <div class="row mb-3">
            <div class="col-auto">
                <form class="form-inline" action="{{ url(app()->getLocale() . '/events') }}" method="get">
                    <div class="form-group">
                        <label for="inputDateFrom">@lang('events.from')</label>
                        <input type="date" id="inputDateFrom" name="inputDateFrom"
                            value="{{ request('inputDateFrom') }}" class="form-control mx-sm-3">
                    </div>
                    <div class="form-group">
                        <label for="inputDateTo">@lang('events.to')</label>
                        <input type="date" id="inputDateTo" name="inputDateTo" value="{{ request('inputDateTo') }}"
                            class="form-control mx-sm-3">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">@lang('events.categories')</label>
                        <select class="form-control mx-sm-3" id="exampleFormControlSelect1" name="category">
                            <option value="">@lang('events.all')</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->group }}" @if (request('category') == $cat->group) selected @endif>
                                    {{ $cat->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">@lang('events.filter')</button>
                    </div>
                </form>
            </div>
            <div class="col-auto"></div>
        </div>
        <div class="row">
            @foreach ($events as $event)
                <div class="col-lg-6">
                    <div class="shadoves">
                        <div class="new_event">
                            <div class="new_event_date">
                                <svg width="11" height="11" viewBox="0 0 11 11" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5.5 11C4.4122 11 3.34884 10.6774 2.44437 10.0731C1.5399 9.46874 0.834947 8.60975 0.418665 7.60476C0.00238306 6.59977 -0.106535 5.4939 0.105683 4.42701C0.317902 3.36011 0.841726 2.3801 1.61091 1.61091C2.3801 0.841726 3.36011 0.317902 4.42701 0.105683C5.4939 -0.106535 6.59977 0.00238306 7.60476 0.418665C8.60975 0.834947 9.46874 1.5399 10.0731 2.44437C10.6774 3.34884 11 4.4122 11 5.5C11 6.95869 10.4205 8.35764 9.38909 9.38909C8.35764 10.4205 6.95869 11 5.5 11ZM5.5 0.785717C4.5676 0.785717 3.65615 1.0622 2.88089 1.58022C2.10563 2.09823 1.50138 2.8345 1.14457 3.69592C0.787757 4.55735 0.694399 5.50523 0.8763 6.41971C1.0582 7.33419 1.50719 8.1742 2.1665 8.8335C2.8258 9.49281 3.66581 9.9418 4.58029 10.1237C5.49477 10.3056 6.44266 10.2122 7.30408 9.85543C8.1655 9.49862 8.90177 8.89438 9.41979 8.11912C9.9378 7.34386 10.2143 6.4324 10.2143 5.5C10.2143 4.2497 9.7176 3.0506 8.8335 2.1665C7.9494 1.2824 6.75031 0.785717 5.5 0.785717Z"
                                        fill="#2DA37D"></path>
                                    <path
                                        d="M7.30322 7.85721L5.10715 5.66114V1.96436H5.89286V5.33507L7.85715 7.30328L7.30322 7.85721Z"
                                        fill="#2DA37D"></path>
                                </svg>
                                {!! $event->datestart->format('d.m.Y') . ' - ' . $event->dateend->format('d.m.Y') !!}
                            </div>
                            <div class="new_event_adr">
                                <svg width="7" height="11" viewBox="0 0 7 11" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3.43965 0C1.53959 0 0 1.5334 0 3.43277C0 6.71695 3.43965 11 3.43965 11C3.43965 11 6.8793 6.71626 6.8793 3.43277C6.8793 1.53408 5.33971 0 3.43965 0ZM3.43965 5.33215C2.94703 5.33215 2.47459 5.13645 2.12626 4.78812C1.77793 4.43979 1.58224 3.96735 1.58224 3.47473C1.58224 2.98212 1.77793 2.50968 2.12626 2.16135C2.47459 1.81301 2.94703 1.61732 3.43965 1.61732C3.93227 1.61732 4.40471 1.81301 4.75304 2.16135C5.10137 2.50968 5.29706 2.98212 5.29706 3.47473C5.29706 3.96735 5.10137 4.43979 4.75304 4.78812C4.40471 5.13645 3.93227 5.33215 3.43965 5.33215Z"
                                        fill="#2DA37D"></path>
                                </svg>
                                {{ $event->organization }}
                            </div>
                            <a
                                href="{{ url(app()->getLocale() . '/event?id=' . $event->id) }}">{{ $event->title }}</a>
                            <small>
                                @if ($event->category)
                                    {{ $event->category->category_name }}
                                @endif
                            </small>
                            <img src="{{ asset('storage/events/' . $event->cover) }}" alt="event_cover">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text_center">
            {{ $events->appends(request()->input())->links() }}
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script type="text/javascript">
    $('#datepicker').datepicker({
        "setDate": new Date(),
        format: 'yyyy-m-d',
        "autoclose": true,
        beforeShowDay: function(date) {
            let today = new Date();
            let eventDates = @json($eventDates ?? null);
            let calender_date = date.getFullYear() + '-' + (date.getMonth() < 10 ? '0' + (date.getMonth() +
                1) : (date.getMonth() + 1)) + '-' + (date.getDate() < 10 ? '0' + date.getDate() : date
                .getDate());
            let search_index = $.inArray(calender_date, eventDates);

            if (search_index > -1) {
                return {
                    classes: 'active',
                    tooltip: 'User available on this day.'
                };
            } else {
                return {
                    classes: '',
                    tooltip: 'User not available on this day.'
                };
            }
        }
    });

    $('#datepicker').on('changeDate', function() {
        $('#my_hidden_input').val(
            $('#datepicker').datepicker('getFormattedDate')
        );

        window.location.href = "{{ url(app()->getLocale() . '/events') }}?date=" + $('#my_hidden_input')
            .val()
    });


    $('[data-fancybox="images"]').fancybox({
        // infobar : false,
        // animationEffect: "zoom",
        loop: true,
        buttons: [
            'slideShow',
            'fullScreen',
            'thumbs',
            // 'share',
            // 'download',
            // 'zoom',
            'close'
        ]
    });

</script>
@endpush

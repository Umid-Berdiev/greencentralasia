@extends('layout.defualt')
@section('left_sidebar_menu')
@endsection
@section('content_div')
<div class="container-fluid" id="page_content" style="background-color: #F5F5F5">
    <div class="container">
        @endsection
        <div class="row">
            @section('nowosti')
            <div class="page-content">
                <div>
                    <ol class="breadcrumb h6">
                        <li><a href="{{URL(App::getLocale().'/')}}" title="@lang('blog.bosh')">@lang('blog.bosh')</a>
                        </li>
                        <li><a href="{{URL(App::getLocale().'/photo/')}}"
                                title="@lang('blog.photo')">@lang('blog.photo')</a></li>
                    </ol>
                </div>
            </div>

            <div class="page-header row section-to-print">
                <div class="col-md-9">
                    <h4><b>{{ $curcat->title }}</b></h4>
                </div>
                <div class="col-md-3 hidden-xs hidden-sm" style="padding-top: 11px;">
                    <a class="page-print-link" target="_self"><span class="glyphicon glyphicon-print"></span> Чоп этиш
                    </a>
                    <a class="rss-link pull-right"
                        href="{{URL(\Illuminate\Support\Facadesapp()->getLocale().'/rss/photo')}}"><img
                            src="{{URL('/images/Feed-icon.svg.png')}}" alt="" width="20" height="20"> RSS</a>
                </div>
            </div>
            <br>
            <div class="row" id="print_all">
                @foreach($table as $value)
                <div class="col-md-4">
                    <a href="{{ URL(App::getLocale()."/photo/".$value->group."/all") }}"><img
                            src="{{URL(App::getLocale().'/downloads?type=photo&id='.$value->group)}}" alt=""
                            class="img-responsive"></a>
                    <h4><a
                            href="{{ URL(App::getLocale()."/photo/".$value->group."/all") }}"><b>{{$value->title}}</b></a>
                    </h4>
                    <h6>{{ $value->created_at }}</h6>
                    <h4><span class="label label-warning"> фото</span></h4>
                </div>
                @endforeach
            </div>
            {{ $table->links() }}





            @endsection

            @section('statistika')
            @endsection
        </div>
        @section('nav_page')
        <div class="col-md-3" style="padding-top: 50px;">
            <div class="col menu-item-structure">
                <div class="col" style="background-color: #3075ff; padding: 5px 15px; color: #fff">
                    <h4>@lang('blog.photo')</h4>
                </div>
                <div class="list-group">
                    @foreach($newscat as $value)
                    @if($curcat->group == $value->group)
                    <a href="{{ URL(App::getLocale().'/photo/'.$value->group) }}"
                        class="list-group-item active">{{$value->title}}</a>
                    @else
                    <a href="{{ URL(App::getLocale().'/photo/'.$value->group) }}"
                        class="list-group-item">{{$value->title}}</a>
                    @endif
                    @endforeach





                </div>
            </div>
        </div>
        @endsection
    </div>
</div>
@section('tender')

@foreach($tenders as $key=>$tender)
<div class="row">
    <div class="col-xs-4" style="padding-top: 10px">
        <a href="{{URL(App::getLocale().'/tender/'.$tender->tender_category_id."/".$tender->group)}}"><img
                class="img-responsive center-block"
                src="{{URL(App::getLocale().'/downloads?type=tenders&id='.$tender->group)}}" alt=""></a>
    </div>
    <div class="col-xs-8">
        <a href="{{URL(App::getLocale().'/tender/'.$tender->tender_category_id."/".$tender->group)}}">
            <h6>{{$tender->title}}</h6>
        </a>
    </div>
</div>
@endforeach

@endsection
@section('regional_uprav')
@endsection
@section('poleznaya-info')
@endsection
@section('video_foto_baner')
@endsection
</div>
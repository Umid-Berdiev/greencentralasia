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
                        <li><a href="{{ URL(App::getLocale().'/video/') }}">@lang('blog.video')</a></li>
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
                        href="{{URL(\Illuminate\Support\Facadesapp()->getLocale().'/rss/video')}}"><img
                            src="{{URL('/images/Feed-icon.svg.png')}}" alt="" width="20" height="20"> RSS</a>
                </div>
            </div>
            <br>
            <div class="row" id="print_all">
                @foreach($table as $value)
                <div class="col-md-6">
                    <h4><b>{{$value->title}}</b></h4>
                    <h4><span class="label label-primary">{{$value->created_at}}</span></h4>
                    <div class="embed-responsive embed-responsive-16by9">
                        <a href="{{ URL(App::getLocale()."/video/".$value->group."/all") }}" class=""> <img
                                src="{{URL(App::getLocale().'/downloads?type=video&id='.$value->group)}}" alt=""
                                width="100%" height="250"></a>
                    </div>
                </div>
                @endforeach

                {{ $table->links() }}
            </div>


            @endsection

            @section('statistika')
            @endsection
        </div>
        @section('nav_page')
        <div class="col-md-3" style="padding-top: 50px;">
            <div class="col menu-item-structure">
                <div class="col" style="background-color: #3075ff; padding: 5px 15px; color: #fff">
                    <h4>@lang('blog.video')</h4>
                </div>
                <div class="list-group">
                    @foreach($newscat as $value)
                    @if($curcat->group == $value->group)
                    <a href="{{ URL(App::getLocale().'/video/'.$value->group) }}"
                        class="list-group-item active">{{$value->title}}</a>
                    @else
                    <a href="{{ URL(App::getLocale().'/video/'.$value->group) }}"
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
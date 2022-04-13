@extends('layout.defualt')
@section('left_sidebar_menu')
@endsection
@section('content_div')
    <div class="container-fluid" id="page_content"  style="background-color: #F5F5F5">
        <div class="container">
            @endsection
            <div class="row">
                @section('nowosti')
                    <div class="page-content">
                        <div>
                            <ol class="breadcrumb h6">
                                <li><a href="{{URL(App::getLocale().'/')}}" title="@lang('blog.bosh')">@lang('blog.bosh')</a></li>
                                <li><a href="{{ URL(App::getLocale()."/event/".$curcat->group) }}">{{ $curcat->category_name }}</a></li>
                            </ol>
                        </div>
                    </div>

                    <div class="page-header row">
                        <div class="col-md-9">
                            <h4><b>{{ $table->title }}</b></h4>
                        </div>
                        <div class="col-md-3 hidden-xs hidden-sm" style="padding-top: 11px;">
                            <a class="page-print-link" target="_self" ><span class="glyphicon glyphicon-print"></span> Чоп этиш </a>
                        </div>
                    </div>
                    <div class="item" id="print_all">
                        <div class="row section-to-print" style="width: 90%">
                            <p style="background-color: #FFF;"><img style="margin: 0 auto;width:90%" class="img-responsive" src="{{ URL(App::getLocale().'/downloads?type=event&id='.$table->group) }}" alt=""></p>
                            <div class="clearfix"></div>
                            <div class="col-sm-10">
                                <?php $date=date_create($table->created_at) ?>
                                <?php $date_start=date_create($table->datestart) ?>
                                <?php $date_finish=date_create($table->dateend) ?>
                                <div class="col-sm-4"><p class="small">Ташкилотчи: <span class="text-primary">{{$table->organization}}</span></p></div>
                                <div class="col-sm-4"><p class="small">Бошланиш санаси: <span class="text-primary">{{date_format($date_start,"d.m.Y")}}</span></p></div>
                                <div class="col-sm-4"><p class="small">Тугаш санаси: <span class="text-primary">{{date_format($date_finish,"d.m.Y")}}</span></p></div>
                            </div>
                            <div class="clearfix"></div><br>
                            <div class="" >
                                {!! $table->description !!}
                                {!! $table->content !!}

                            </div>







                        </div><!-- .row -->
                    </div><!-- .item -->

                @endsection

                @section('statistika')
                @endsection
            </div>
            @section('nav_page')
                <div class="col-md-3" style="padding-top: 50px;">
                    <div class="col menu-item-structure">
                        <div class="col" style="background-color: #3075ff; padding: 5px 15px; color: #fff">
                            <h4>{{ $curcat->category_name }}</h4>
                        </div>
                        <div class="list-group">
                            @foreach($newscat as $value)

                                    <a href="{{ URL(App::getLocale().'/event/'.$value->group) }}" class="list-group-item">{{$value->category_name}}</a>
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
                <a href="{{URL(App::getLocale().'/tender/'.$tender->tender_category_id."/".$tender->group)}}"><img class="img-responsive center-block" src="{{URL(App::getLocale().'/downloads?type=tenders&id='.$tender->group)}}" alt=""></a>
            </div>
            <div class="col-xs-8">
                <a href="{{URL(App::getLocale().'/tender/'.$tender->tender_category_id."/".$tender->group)}}"><h6>{{$tender->title}}</h6></a>
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
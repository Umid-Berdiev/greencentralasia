@extends('layout.defualt')
@section('left_sidebar_menu')
@endsection
@section('content_div')
    <div class="container-fluid" id="page_content"  style="background-color: #F5F5F5">
        <div class="container">
            @endsection
            <div class="row section-to-print">
                @section('nowosti')
                    <div class="page-content">
                        <div>
                            <ol class="breadcrumb h6">
                                <li><a href="{{URL(App::getLocale().'/')}}" title="@lang('blog.bosh')">@lang('blog.bosh')</a></li>
                            </ol>
                        </div>
                    </div>

                    <div class="page-header row">
                        <div class="col-md-9">
                            <h4><b>@lang('blog.rahbariyat_pagetitle')</b></h4>
                        </div>
                        <div class="col-md-3 hidden-xs hidden-sm" style="padding-top: 11px;">
                            <a class="page-print-link" style="cursor:pointer;" target="_self" ><span class="glyphicon glyphicon-print"></span> @lang('blog.print_button')</a>
                        </div>
                    </div>
                    <div class="col" style="padding-top: 25px;" id="print_all">

                        <div id="rahbariyat-bio" class="row">
                            @foreach($raxbariyat as $key=>$row)
                            <div class="row">
                                <div class="col-md-3"><img class="img-responsive" src="{{URL(App::getLocale().'/downloads?type=raxbariyat&id='.$row->id) }}" alt="" width="180" /></div>
                                <div class="col-md-9">
                                    <h4><strong>{{$row->fio}}</strong></h4>
                                    <p><strong>{{$row->major}}</strong></p>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <p><span class="glyphicon glyphicon-earphone"></span> {{$row->tel}}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p><span class="glyphicon glyphicon-phone-alt"></span> {{$row->faks}}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p><span class="glyphicon glyphicon-envelope"></span> {{$row->email}}</p>
                                        </div>
                                    </div>
                                    <p>{{$row->qabul}}</p>
                                    <div id="accordion1" class="">
                                        <div class="panel panel-heading" style="background-color: inherit;">
                                            <div class="col-sm-6"><button class="btn btn-default btn-block" data-toggle="collapse" data-target="#short-bio{{$row->id}}" data-parent="#accordion1">@lang('blog.short_bio')</button></div>
                                            <div class="col-sm-6"><button class="btn btn-default btn-block" data-toggle="collapse" data-target="#self-tasks{{$row->id}}" data-parent="#accordion1">@lang('blog.tasks_distribution')</button></div>
                                        </div>
                                        <div class="panel panel-body" style="background-color: inherit;">
                                            <div id="short-bio{{$row->id}}" class="collapse fade" style="background-color: #fff; padding: 20px;">
                                               {!! $row->short !!}
                                            </div>
                                            <div id="self-tasks{{$row->id}}" class="collapse fade" style="background-color: #fff; padding: 20px;">
                                                {!! $row->vazifa !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <br>
                                @endforeach
                        </div>

                    </div>

                @endsection

                @section('statistika')
                @endsection
            </div>
            @section('nav_page')
                <div class="col-md-3" style="padding-top: 50px;">
                    <div class="col menu-item-structure">
                        <div class="col" style="background-color: #3075ff; padding: 5px 15px; color: #fff">
                            <h4>@lang('blog.rahbariyat_pagetitle')</h4>
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

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
                                <li><a href="{{URL(App::getLocale().'/page/'.$page_categories[0]->page_category_group_id)}}" title="{{ $page_categories[0]->category_name }}">{{ $page_categories[0]->category_name }}</a></li>
                            </ol>
                        </div>
                    </div>

                    <div class="page-header row">
                        <div class="col-md-9">
                            <h4><b>{{  $page_categories[0]->category_name }}</b></h4>
                        </div>
                        <div class="col-md-3 hidden-xs hidden-sm" style="padding-top: 11px;">
                            <a class="page-print-link" style="cursor:pointer;" target="_self" ><span class="glyphicon glyphicon-print"></span> @lang('blog.print_button')</a>
                        </div>
                    </div>
                    <div class="col" style="padding-top: 25px;">

                        <div class="col menu-item-structure">
                            <div class="col" style="background-color: #3075ff; padding: 5px 15px; color: #fff">
                                <h4></h4>
                            </div>
                            <div class="list-group">
                                @foreach ($page_categories as $row)
                                        <a href="{{url(App::getLocale().'/page/'.$row->page_category_group_id.'/'.$row->page_group_id)}}" class="list-group-item">
                                            {{ $row->title }}</a>
                                @endforeach
                            </div>
                        </div>

                    </div>

                @endsection

                @section('statistika')
                @endsection
            </div>
            @section('nav_page')

            @endsection
        </div>
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

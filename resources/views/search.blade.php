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
                            <h4><b>НАТИЖАЛАР:</b></h4>
                        </div>
                        <div class="col-md-3 hidden-xs hidden-sm" style="padding-top: 11px;">
                            <a class="page-print-link pull-right" target="_self" ><span class="glyphicon glyphicon-print"></span> Чоп этиш </a>
                        </div>
                    </div>
                    <div class="container-fluid" id="print_all">
                        @foreach($posts as $post)
                            <div class="item">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4">
                                        <br><a href="{{URL(App::getLocale().'/posts/'.$post->category_group_id.'/'.$post->group) }}"><img class="img-responsive" src="{{ URL(App::getLocale().'/downloads?type=post&id='.$post->group)}}"></a>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <h4 style="padding-top: 15px;"><a href="{{ URL(App::getLocale().'/posts/'.$post->category_group_id.'/'.$post->group) }}">{{ $post->title }}</a></h4>
                                        <h4><span class="label label-primary"> {{ $post->created_at }} </span></h4>
                                        <p style="text-align: justify;"></p><p>{{ $post->decription }}...
                                        </p>
                                    </div>
                                </div><!-- .row -->
                            </div><!-- .item -->
                            @endforeach
                            @foreach($pages as $post)
                                <div class="item">
                                    <div class="row">
                                        <div class="col-md-8 col-sm-8">
                                            <h4 style="padding-top: 15px;"><a href="{{ URL(App::getLocale().'/page/'.$post->page_category_group_id.'/'.$post->page_group_id)}}">{{ $post->title }}</a></h4>
                                            <h4><span class="label label-primary"> {{ $post->created_at }} </span></h4>
                                            <p style="text-align: justify;"></p><p>{{ $post->description }}
                                            </p>
                                        </div>
                                    </div><!-- .row -->
                                </div><!-- .item -->
                            @endforeach



                    </div>



                @endsection

                @section('statistika')
                @endsection
            </div>
            @section('nav_page')

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

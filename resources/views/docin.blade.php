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
                                <li><span>{{ $curcat->category_name }}</span></li>
                            </ol>
                        </div>
                    </div>
                    
                    <div class="page-header row">
                        <div class="col-md-9">
                            <h4><b>{{ $table->title }}</b></h4>
                        </div>
                        <div class="col-md-3 hidden-xs hidden-sm" style="padding-top: 11px;">
                            <a class="page-print-link" style="cursor:pointer;" target="_self" ><span class="glyphicon glyphicon-print"></span> @lang('blog.print_button')</a>
                        </div>
                    </div>
                    <br>

                    <div class="item">
                        <div class="row" id="print_all">
                            <div class="file-box section-to-print">
                                
                                <div class="row">
                                    @if($table->r_number != null)
                                    <div class="col-md-5"><h6>@lang('blog.register_date'): {{$table->r_date}} | @lang('blog.number'): {{$table->r_number}} </h6></div>
                                    @endif
                                        <div class="col-md-7">
                                        @if($table->link  != null)
                                            <div class="col-md-4"><h6><a href="{{URL($table->link)}}"><img src="{{URL('/images/lexuz.png')}}" alt="" width="42" height="15"> Lex.uz да ўқиш</a></h6></div>
                                        @endif
                                        @if($table->other_link  != null)
                                            <div class="col-md-4"><h6><a href="{{URL($table->other_link)}}"><img src="{{URL('/images/icons8-internet-explorer-15.png')}}" alt="" width="15" height="15"> Сайтда ўқиш</a></h6></div>
                                        @endif
                                        @if($table->file_type == 'docx' ||  $table->file_type == 'doc')
                                            <div class="col-md-4"><h6><a href="{{URL(App::getLocale().'/downloads?type=doc&id='.$table->id)}}"><img src="{{URL('/images/msword.jpg')}}" alt="" width="15" height="15"> @lang('blog.download') ({{round($table->file_size/1024)}} KB)</a></h6></div>
                                        @elseif($table->file_type == 'pdf')
                                            <div class="col-md-4"><h6><a href="{{URL(App::getLocale().'/downloads?type=doc&id='.$table->id)}}"><img src="{{URL('/images/pdf_image.jpg')}}" alt="" width="15" height="15"> @lang('blog.download') ({{round($table->file_size/1024)}} KB)</a></h6></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10 col-sm-10">

                                {!! $table->description !!}

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
                            <h4>ХУЖЖАТЛАР</h4>
                        </div>
                        <div class="list-group">
                            @foreach($newscat as $value)
                                @if($table->doc_category_id == $value->group  )
                                <a href="{{ URL(App::getLocale().'/doc/'.$value->group) }}" class="list-group-item active">{{$value->category_name}}</a>
                                @else
                                    <a href="{{ URL(App::getLocale().'/doc/'.$value->group) }}" class="list-group-item">{{$value->category_name}}</a>
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

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
                        <li><a href="{{URL(App::getLocale().'/')}}"
                                title="{{ __('blog.bosh') }}">{{ __('blog.bosh') }}</a></li>
                        <li><a href="{{ URL(App::getLocale().'/doc/'.$curcat->group) }}">{{$curcat->category_name}}</a>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="page-header row">
                <div class="col-md-9">
                    <h4><b>{{ $curcat->category_name }}</b></h4>
                </div>
                <div class="col-md-3 hidden-xs hidden-sm" style="padding-top: 11px;">
                    <a class="page-print-link" style="cursor:pointer;" target="_self"><span
                            class="glyphicon glyphicon-print"></span> {{ __('blog.print_button') }}</a>
                    <a class="rss-link pull-right"
                        href="{{URL(\Illuminate\Support\Facadesapp()->getLocale().'/rss/doc')}}"><img
                            src="{{URL('/images/Feed-icon.svg.png')}}" alt="" width="20" height="20"> RSS</a>
                </div>
            </div>
            <br>
            <div class="col section-to-print" id="print_all">
                @foreach($table as $value)
                <div class="file-box">
                    <span><a href="{{URL(App::getLocale().'/doc/'.$value->doc_category_id.'/'.$value->group)}}"
                            class="">{{$value->title}}</a></span>
                    <span><a href="{{URL(App::getLocale().'/doc/'.$value->doc_category_id.'/'.$value->group)}}"
                            class=""> {{ __('blog.more') }}</a></span>

                    <div class="row">
                        @if($value->r_number != null)
                        <div class="col-md-5">
                            <h6>@lang('blog.register_date'): {{$value->r_date}} |{{  __('blog.number') }}:
                                {{$value->r_number}} </h6>
                        </div>
                        @endif
                        <div class="col-md-7">
                            @if($value->link != null)
                            <div class="col-md-4">
                                <h6><a href="{{URL($value->link)}}"><img src="{{URL('/images/lexuz.png')}}" alt=""
                                            width="42" height="15"> Lex.uz да ўқиш</a></h6>
                            </div>
                            @endif
                            @if($value->other_link != null)
                            <div class="col-md-4">
                                <h6><a href="{{URL($value->other_link)}}"><img
                                            src="{{URL('/images/icons8-internet-explorer-15.png')}}" alt="" width="15"
                                            height="15"> Сайтда ўқиш</a></h6>
                            </div>
                            @endif
                            @if($value->file_type == 'docx' || $value->file_type == 'doc')
                            <div class="col-md-4">
                                <h6><a href="{{URL(App::getLocale().'/downloads?type=doc&id='.$value->id)}}"><img
                                            src="{{URL('/images/msword.jpg')}}" alt="" width="15" height="15">
                                        @lang('blog.download') ({{round($value->file_size/1024)}} KB)</a></h6>
                            </div>
                            @elseif($value->file_type == 'pdf')
                            <div class="col-md-4">
                                <h6><a href="{{URL(App::getLocale().'/downloads?type=doc&id='.$value->id)}}"><img
                                            src="{{URL('/images/pdf_image.jpg')}}" alt="" width="15" height="15">
                                        @lang('blog.download') ({{round($value->file_size/1024)}} KB)</a></h6>
                            </div>
                            @endif

                        </div>
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
                    <h4>@lang('blog.docs')</h4>
                </div>
                <div class="list-group">
                    @foreach($newscat as $value)
                    @if($curcat->group == $value->group)
                    <a href="{{ URL(App::getLocale().'/doc/'.$value->group) }}"
                        class="list-group-item active">{{$value->category_name}}</a>
                    @else
                    <a href="{{ URL(App::getLocale().'/doc/'.$value->group) }}"
                        class="list-group-item">{{$value->category_name}}</a>
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
<?php
$current_lang_id = $languages->where('status', '1')->where("language_prefix", app()->getLocale())->first()->id;
$tenders = \App\Models\Tender::take(3)->where('title', '<>', '')->where('language_id', $current_lang_id)->orderBy('id', 'desc')->get();
?>

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
            <li><a href="{{URL(App::getLocale().'/')}}" title="@lang('blog.bosh')">@lang('blog.bosh')</a></li>
            <li><a href="{{URL(App::getLocale().'/posts/'.$news->category_group_id)}}" title="{{ $news->title }}">{{
                $curcat->category_name }}</a></li>
          </ol>
        </div>
      </div>

      <div class="page-header row">
        <div class="col-md-9">
          <h4><b>{{ $news->title }}</b></h4>
        </div>
        <div class="col-md-3 hidden-xs hidden-sm" style="padding-top: 11px;">
          <a class="page-print-link" style="cursor:pointer;" target="_self"><span
              class="glyphicon glyphicon-print"></span> @lang('blog.print_button')</a>
        </div>
      </div>
      <br>

      <div class="item" id="print_all">
        <div class="row section-to-print">
          <?php $date = date_create($news->datetime) ?>

          <div class="row" style="margin-top: 10px; margin-bottom: 10px">
            <div class="col-md-6">
              <h4><span class="label label-primary"> {{date_format($date,"d.m.Y H:i")}} </span>
              </h4>
            </div>
            <div class="col-md-6" style="margin-top: 10px;padding-right: 50px">
              <span class="pull-right"><span class="glyphicon glyphicon-eye-open"></span> @lang('blog.viewcount'):
                {{$news->viewcount}}</span>
            </div>
          </div>
          <div class="row" style="margin-top: 10px; margin-bottom: 10px">
            <div class="col-md-12 col-sm-12">
              <br><img class="img-responsive" style="width: 90%!important;"
                src="{{ URL(App::getLocale().'/downloads?type=post&id='.$news->group) }}">
            </div>
          </div>

          </br>
          <div class="col-md-10 col-sm-10">
            {!! $news->content !!}
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
          <h4>@lang('blog.news')</h4>
        </div>
        <div class="list-group">
          @foreach($news_in as $value)
          @if ($value->group == $news->group)
          <a href="{{ URL(App::getLocale().'/posts/'.$value->category_group_id .'/'.$value->group)  }}"
            class="list-group-item active">{{$value->title}}</a>
          @else
          <a href="{{ URL(App::getLocale().'/posts/'.$value->category_group_id.'/'.$value->group)  }}"
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
    <a href="{{URL(App::getLocale().'/tender/'.$tender->tender_category_id." /".$tender->group)}}"><img
        class="img-responsive center-block" src="{{URL(App::getLocale().'/downloads?type=tenders&id='.$tender->group)}}"
        alt=""></a>
  </div>
  <div class="col-xs-8">
    <a href="{{URL(App::getLocale().'/tender/'.$tender->tender_category_id." /".$tender->group)}}">
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

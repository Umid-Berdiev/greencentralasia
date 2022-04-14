<?php
$tender  = \App\Models\Tender::where('group','=',$table->group)->first();
$tender->viewcount +=1;
$tender->update();
?>

@extends('layout.defualt')
@section('left_sidebar_menu')
@endsection
@section('content_div')
<div class="container-fluid" id="page_content" style="background-color: #F5F5F5">
  <div class="container">
    @endsection
    <div class="row section-to-print">
      @section('nowosti')
      <div class="page-content">
        <div>
          <ol class="breadcrumb h6">
            <li><a href="{{URL(App::getLocale().'/')}}" title="@lang('blog.bosh')">@lang('blog.bosh')</a></li>
            <li><a href="{{ URL(App::getLocale().'/tender/'.$curcat->group) }}">{{$curcat->category_name}}</a></li>
          </ol>
        </div>
      </div>

      <div class="page-header row">
        <div class="col-md-9">
          <h4><b>{{ $table->title }}</b></h4>
        </div>
        <div class="col-md-3 hidden-xs hidden-sm" style="padding-top: 11px;">
          <a class="page-print-link" target="_self"><span class="glyphicon glyphicon-print"></span> Чоп этиш </a>
        </div>
      </div>
      <br>
      <div id="print_all">
        <table class="table table-bordered table-responsive" id="tender-info-table">
          <tbody>
            <tr>
              <td class="info">Соҳа:</td>
              <td><i>{{ $table->category_name }}</i></td>
            </tr>
            <tr>
              <td class="info">Чоп этиш санаси:</td>
              <td><i>{{$table->created_at}}</i></td>
            </tr>
            <tr>
              <td class="info">Муддат:</td>
              <td><i>{{$table->deadline}}</i></td>
            </tr>
            <tr>
              <td class="info">Кўрилди:</td>
              <td><i>{{$table->viewcount}}</i></td>
            </tr>
          </tbody>
        </table>
        <div class="clear-fix"></div>

        <div class="item">
          <div class="row">


            <div class="col-md-10 col-sm-10">

              {!! $table->description !!}

            </div>
          </div><!-- .row -->
        </div><!-- .item -->
      </div>



      @endsection

      @section('statistika')
      @endsection
    </div>
    @section('nav_page')
    <div class="col-md-3" style="padding-top: 50px;">
      <div class="col menu-item-structure">
        <div class="col" style="background-color: #3075ff; padding: 5px 15px; color: #fff">
          <h4>Тердер</h4>
        </div>
        <div class="list-group">
          @foreach($newscat as $value)
          @if ($table->tender_category_id == $value->group)
          <a href="{{ URL(App::getLocale().'/tender/'.$value->group) }}"
            class="list-group-item active">{{$value->category_name}}</a>
          @else
          <a href="{{ URL(App::getLocale().'/tender/'.$value->group) }}"
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
    <a href="{{URL(App::getLocale().'/tender/'.$tender->tender_category_id." /".$tender->group)}}"><img
        class="img-responsive center-block" src="{{URL(App::getLocale().'/downloads?type=tenders&id='.$tender->group)}}"
        alt=""></a>
  </div>
  <div class="col-xs-8">
    <a href="{{URL(App::getLocale().'/tender/'.$tender->tender_category_id." /".$tender->group)}}"><h6>
        {{$tender->title}}</h6></a>
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

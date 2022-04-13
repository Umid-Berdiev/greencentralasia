<?php
$current_lang_id = $languages->where('status', '1')->where("language_prefix", app()->getLocale())->first()->id;

$menus= DB::table("menumakers")
    ->where("language_id", $current_lang_id)
    ->where("parent_id","=",0)
    ->get();
$tenders = App\Tender::take(3)->where('title','<>','')->where('language_id', $current_lang_id)->orderBy('id','desc')->get();
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
      <ul>
        <li><a href="{{ URL(App::getLocale()." /") }}"><span class="sr-only">(current)</span><span
              class="glyphicon glyphicon-home"></span></a></li>
        @foreach($menus as $value)
        <?php $modelsx = DB::table("menumakers")
				                               ->where("language_id", $current_lang_id)
				                               ->where("parent_id","=",$value->group)
				                               ->get(); ?>
        @if(count($modelsx) >0)
        <li>
          <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
            aria-haspopup="true" aria-expanded="false">
            <span class="title">{{ $value->menu_name }}</span><span class="caret"></span>
          </a>
          <!--start submenu -->
          <ul>
            @foreach($modelsx as $valuex)
            <?php $modelsxs = DB::table("menumakers")
								                                ->where("language_id", $current_lang_id)
								                                ->where("parent_id","=",$valuex->group)
								                                ->get(); ?>
            @if(count($modelsxs) >0)

            <li>
              <a href="javascript:void(0);" tabindex="-1" class="dropdown-toggle" data-toggle="dropdown">
                <span class="title">{{ $valuex->menu_name }}</span>
              </a>

              <ul>
                @foreach($modelsxs as $valuexx)
                <li><a href="@if($valuexx->type ==" 1") {{ URL(App::getLocale()."/".$valuexx->link) }}
                    @elseif($valuexx->type =="2")
                    {{ URL(App::getLocale()."/posts/".$valuexx->alias_category_id) }}
                    @elseif($valuexx->type =="3")
                    <?php   $pages= DB::table("pages")
													                              ->where("language_id", $current_lang_id)
													                              ->where("page_group_id","=",$valuexx->alias_category_id)
													                              ->first(); ?>
                    {{ URL(App::getLocale()."/page/".$pages->page_category_group_id."/".$pages->page_group_id) }}
                    @elseif($valuexx->type =="4")
                    {{ URL(App::getLocale()."/doc/".$valuexx->alias_category_id) }}
                    @elseif($valuexx->type =="5")
                    {{ URL(App::getLocale()."/event/".$valuexx->alias_category_id) }}
                    @elseif($valuexx->type =="6")
                    {{ URL(App::getLocale()."/tender/".$valuexx->alias_category_id) }}
                    @elseif($valuexx->type =="7")
                    @elseif($valuexx->type =="8")
                    @endif"><span class="title">{{ $valuexx->menu_name }}</span>
                  </a></li>
                <li role="separator" class="divider"></li>
                @endforeach
              </ul>
            </li>
            @else
            <li><a href="@if($valuex->type ==" 1") {{ URL(App::getLocale().$valuex->link) }} @elseif($valuex->type
                =="2")
                {{ URL(App::getLocale()."/posts/".$valuex->alias_category_id) }}
                @elseif($valuex->type =="3")
                <?php   $pages= DB::table("pages")
										                              ->where("language_id", $current_lang_id)
										                              ->where("page_group_id","=",$valuex->alias_category_id)
										                              ->first(); ?>
                {{ URL(App::getLocale()."/page/".$pages->page_category_group_id."/".$pages->page_group_id) }}
                @elseif($valuex->type =="4")
                {{ URL(App::getLocale()."/doc/".$valuex->alias_category_id) }}
                @elseif($valuex->type =="5")
                {{ URL(App::getLocale()."/event/".$valuex->alias_category_id) }}
                @elseif($valuex->type =="6")
                {{ URL(App::getLocale()."/tender/".$valuex->alias_category_id) }}
                @elseif($valuex->type =="7")
                {{ URL(App::getLocale()."/video/".$valuex->alias_category_id) }}
                @elseif($valuex->type =="8")
                {{ URL(App::getLocale()."/photo/".$valuex->alias_category_id) }}
                @endif"><span class="title">{{ $valuex->menu_name }}</span>
              </a></li>
            <li role="separator" class="divider"></li>

            @endif

            @endforeach

          </ul>
          <!--end /submenu -->
        </li>

        @else
        <li><a href="@if($value->type ==" 1") {{ URL(App::getLocale().$value->link) }} @elseif($value->type =="2")
            {{ URL(App::getLocale()."/posts/".$value->alias_category_id) }}
            @elseif($value->type =="3")
            <?php   $pages= DB::table("pages")
						                              ->where("language_id", $current_lang_id)
						                              ->where("page_group_id","=",$value->alias_category_id)
						                              ->first();?>
            {{ URL(App::getLocale()."/page/".$pages->page_category_group_id."/$pages->page_group_id") }}
            @elseif($value->type =="4")
            {{ URL(App::getLocale()."/doc/".$value->alias_category_id) }}
            @elseif($value->type =="5")
            {{ URL(App::getLocale()."/event/".$value->alias_category_id) }}
            @elseif($value->type =="6")
            {{ URL(App::getLocale()."/tender/".$value->alias_category_id) }}
            @elseif($value->type =="7")
            {{ URL(App::getLocale()."/video/".$value->alias_category_id) }}
            @elseif($value->type =="8")
            {{ URL(App::getLocale()."/photo/".$value->alias_category_id) }}
            @endif"><span class="title">{{ $value->menu_name }}</span>
          </a></li>
        <li role="separator" class="divider"></li>
        @endif
        @endforeach



      </ul>

      @endsection

      @section('statistika')
      @endsection
    </div>
    @section('nav_page')
    <div class="col-md-3" style="padding-top: 50px;">
      <div class="col menu-item-structure">
        <div class="col" style="background-color: #3075ff; padding: 5px 15px; color: #fff">

        </div>
        <div class="list-group">

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

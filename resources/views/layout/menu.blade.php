@php
$current_lang_id = $languages->where('status', '1')->where("language_prefix", app()->getLocale())->first()->id;

$menus= DB::table("menumakers")
->where("language_id","=", $current_lang_id)
->where("parent_id","=",0)
->orderBy('orders','ASC')
->get();
@endphp

<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
        aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li><a href="{{ URL(App::getLocale()." /") }}"><span class="sr-only">(current)</span><span
              class="glyphicon glyphicon-home"></span></a></li>
        @foreach($menus as $value)
        <?php $modelsx = DB::table("menumakers")
                        ->where("language_id","=", $current_lang_id)
                        ->where("parent_id","=",$value->group)
                        ->orderBy('orders','ASC')
                        ->get(); ?>
        @if(count($modelsx) >0)
        <li class="dropdown">
          <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
            aria-haspopup="true" aria-expanded="false">
            <span class="title">{{ $value->menu_name }}</span><span class="caret"></span>
          </a>
          <!--start submenu -->
          <ul class="dropdown-menu">
            @foreach($modelsx as $valuex)
            <?php $modelsxs = DB::table("menumakers")
                                        ->where("language_id","=", $current_lang_id)
                                        ->where("parent_id","=",$valuex->group)
                                        ->orderBy('orders','ASC')
                                        ->get(); ?>
            @if(count($modelsxs) >0)

            <li class="dropdown-submenu">
              <a href="javascript:void(0);" tabindex="-1" class="dropdown-toggle" data-toggle="dropdown">
                <span class="title">{{ $valuex->menu_name }}</span>
              </a>

              <ul class="dropdown-menu">
                @foreach($modelsxs as $valuexx)

                <li><a href="@if($valuexx->type ==" 1") @if(strpos($valuexx->link, "http") ===true)
                    {{ $valuexx->link }}
                    @else {{ URL(App::getLocale().$valuexx->link) }} @endif
                    @elseif($valuexx->type =="2")
                    {{ URL(App::getLocale()."/posts/".$valuexx->alias_category_id) }}
                    @elseif($valuexx->type =="3")
                    <?php   $pages= DB::table("pages")
                                                            ->where("language_id","=", $current_lang_id)
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
            <li role="separator" class="divider"></li>
            @else
            <li><a href="@if($valuex->type ==" 1") <?php $mystring=$valuex->link; $findme = 'http'; $pos =
                strpos($mystring, $findme);
                if ($pos === false) {

                echo URL(App::getLocale().$valuex->link);
                }
                else {
                echo $valuex->link;

                }
                ?>


                @elseif($valuex->type =="2")
                {{ URL(App::getLocale()."/posts/".$valuex->alias_category_id) }}
                @elseif($valuex->type =="3")
                <?php   $pages= DB::table("pages")
                                                ->where("language_id","=", $current_lang_id)
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
        <li><a href="@if($value->type ==" 1") @if(strpos($valuex->link, "http") === true)
            {{ $value->link }}
            @else {{ URL(App::getLocale().$value->link) }} @endif
            @elseif($value->type =="2")
            {{ URL(App::getLocale()."/posts/".$value->alias_category_id) }}
            @elseif($value->type =="3")
            <?php   $pages= DB::table("pages")
                                        ->where("language_id","=", $current_lang_id)
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
      <div class="search-form hidden-xs">
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown dropdown-search-form">
            <a href="#" title="Қидириш" class="search-form dropdown-toggle" type="button" id="dropdownMenu1"
              data-toggle="dropdown" aria-expanded="false">
              <span class="glyphicon glyphicon-search"></span>
            </a>
            <ul class="dropdown-menu">
              <li aria-labelledby="dropdownMenu1" role="presentation">
                <form action="{{URL(App::getLocale().'/search')}}" class="navbar-form" style="width: max-content;">
                  <div class="form-group">
                    <label for="exampleInputName2" class="sr-only">@lang('blog.search')</label>
                    <input type="text" name="search" autocomplete="off" class="form-control" id="exampleInputName2"
                      placeholder="@lang('blog.search-placeholder')" maxlength="50">
                  </div>
                  <input type="submit" class="btn btn-default" value="@lang('blog.search')">
                </form>
              </li>
            </ul>
          </li>
        </ul>
      </div>

    </div>
  </div>
</nav>

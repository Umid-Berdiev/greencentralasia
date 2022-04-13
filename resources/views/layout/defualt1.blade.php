<?php
$last_post = \App\Models\Post::whereRaw('id = (select max(`id`) from posts)')->first();
$last_pages = \App\Models\Pages::whereRaw('id = (select max(`id`) from pages)')->first();
$last_tenders = \App\Models\Tender::whereRaw('id = (select max(`id`) from tenders)')->first();
$last_docs = \App\Models\Document::whereRaw('id = (select max(`id`) from docs)')->first();
$last_events = \App\Models\Event::whereRaw('id = (select max(`id`) from events)')->first();
$last_photogalleries = \App\Models\Photogallery::whereRaw('id = (select max(`id`) from photogalleries)')->first();
$last_videogalleries = \App\Models\Video::whereRaw('id = (select max(`id`) from videogalleries)')->first();
$last_users = \App\Models\User::whereRaw('id = (select max(`id`) from users)')->first();
$last_sorovnomas = \App\Models\Sorovvote::whereRaw('id = (select max(`id`) from sorovnomas)')->first();

$last = max(array(
        $last_pages->created_at,
        $last_pages->updated_at,
        $last_post->created_at,
        $last_post->updated_at,
        $last_tenders->created_at,
        $last_tenders->updated_at,
        $last_docs->created_at,
        $last_docs->updated_at,
        $last_events->created_at,
        $last_events->updated_at,
        $last_photogalleries->created_at,
        $last_photogalleries->updated_at,
        $last_videogalleries->created_at,
        $last_videogalleries->updated_at,
        $last_users->created_at,
        $last_users->updated_at,
        $last_sorovnomas->created_at,
        $last_sorovnomas->updated_at,
        )
      );

$current_lang_id = $languages->where('status', '1')->where("language_prefix", app()->getLocale())->first()->id;
$tender = App\Tender::take(3)->where('title','<>','')->where('language_id', $current_lang_id)->get();
$events =DB::table("events")
    ->select(['events.*','languages.language_name','eventcategories.category_name'])
    ->leftJoin("languages","languages.id", "events.language_id")
    ->leftJoin("eventcategories","eventcategories.group", "events.event_category_id")
   ->where('events.title','<>','')
    ->where("events.language_id", $current_lang_id)
    ->where("eventcategories.language_id", $current_lang_id)->take(5)->get();
?>

<!DOCTYPE html>
<html lang="uz">

<head>
  <title>@lang('blog.company_name')</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="{{ URL('bootstrap/css/bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{ URL('css/style.css') }}" />
  <script src="{{URL('js/jquery.min.js')}}"></script>
  <script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>
  @if(\Illuminate\Support\Facadesapp()->getLocale() == 'uz')
  <script src="{{ URL::asset('main_uz.js') }}"></script>
  @elseif(\Illuminate\Support\Facadesapp()->getLocale() == 'ru')
  <script src="{{ URL::asset('main_ru.js') }}"></script>
  @else
  <script src="{{ URL::asset('main_en.js') }}"></script>
  @endif
  <script src="{{URL('js/responsivevoice.js')}}"></script>
  <script src="{{URL('js/orphus.js')}}"></script>
  <script src="{{URL('js/vue.js')}}"></script>

  <style>
    ul.thumbnails {
      margin-bottom: 0px;
    }



    /* Thumbnail Box */
    .caption h4 {
      color: #444;
    }

    .caption p {
      color: #999;
    }



    /* Carousel Control */
    .control-box {
      text-align: right;
      width: 100%;
    }




    /* Mobile Only */
    @media (max-width: 767px) {

      .page-header,
      .control-box {
        text-align: center;
      }
    }

    @media (max-width: 479px) {
      .caption {
        word-break: break-all;
      }
    }


    li {
      list-style-type: none;
    }

    ::selection {
      background: #ff5e99;
      color: #FFFFFF;
      text-shadow: 0;
    }

    ::-moz-selection {
      background: #ff5e99;
      color: #FFFFFF;
    }

    .lightboxOverlay {
      position: absolute;
      top: 0;
      left: 0;
      z-index: 9999;
      background-color: black;
      filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=80);
      opacity: 0.8;
      display: none;
    }

    .lightbox {
      position: absolute;
      left: 0;
      width: 100%;
      z-index: 10000;
      text-align: center;
      line-height: 0;
      font-weight: normal;
    }

    .lightbox .lb-image {
      display: block;
      height: auto;
      max-width: inherit;
      max-height: none;
      border-radius: 3px;

      /* Image border */
      border: 4px solid white;
    }

    .lightbox a img {
      border: none;
    }

    .lb-outerContainer {
      position: relative;
      *zoom: 1;
      width: 250px;
      height: 250px;
      margin: 0 auto;
      border-radius: 4px;

      /* Background color behind image.
           This is visible during transitions. */
      background-color: white;
    }

    .lb-outerContainer:after {
      content: "";
      display: table;
      clear: both;
    }

    .lb-loader {
      position: absolute;
      top: 43%;
      left: 0;
      height: 25%;
      width: 100%;
      text-align: center;
      line-height: 0;
    }

    .lb-cancel {
      display: block;
      width: 32px;
      height: 32px;
      margin: 0 auto;
      background: url(../images/loading.gif) no-repeat;
    }

    .lb-nav {
      position: absolute;
      top: 0;
      left: 0;
      height: 100%;
      width: 100%;
      z-index: 10;
    }

    .lb-container>.nav {
      left: 0;
    }

    .lb-nav a {
      outline: none;
      background-image: url('data:image/gif;base64,R0lGODlhAQABAPAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==');
    }

    .lb-prev,
    .lb-next {
      height: 100%;
      cursor: pointer;
      display: block;
    }

    .lb-nav a.lb-prev {
      width: 34%;
      left: 0;
      float: left;
      background: url(../images/prev.png) left 48% no-repeat;
      filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=0);
      opacity: 0;
      -webkit-transition: opacity 0.6s;
      -moz-transition: opacity 0.6s;
      -o-transition: opacity 0.6s;
      transition: opacity 0.6s;
    }

    .lb-nav a.lb-prev:hover {
      filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100);
      opacity: 1;
    }

    .lb-nav a.lb-next {
      width: 64%;
      right: 0;
      float: right;
      background: url(../images/next.png) right 48% no-repeat;
      filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=0);
      opacity: 0;
      -webkit-transition: opacity 0.6s;
      -moz-transition: opacity 0.6s;
      -o-transition: opacity 0.6s;
      transition: opacity 0.6s;
    }

    .lb-nav a.lb-next:hover {
      filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100);
      opacity: 1;
    }

    .lb-dataContainer {
      margin: 0 auto;
      padding-top: 5px;
      *zoom: 1;
      width: 100%;
      -moz-border-radius-bottomleft: 4px;
      -webkit-border-bottom-left-radius: 4px;
      border-bottom-left-radius: 4px;
      -moz-border-radius-bottomright: 4px;
      -webkit-border-bottom-right-radius: 4px;
      border-bottom-right-radius: 4px;
    }

    .lb-dataContainer:after {
      content: "";
      display: table;
      clear: both;
    }

    .lb-data {
      padding: 0 4px;
      color: #ccc;
    }

    .lb-data .lb-details {
      width: 85%;
      float: left;
      text-align: left;
      line-height: 1.1em;
    }

    .lb-data .lb-caption {
      font-size: 13px;
      font-weight: bold;
      line-height: 1em;
    }

    .lb-data .lb-caption a {
      color: #4ae;
    }

    .lb-data .lb-number {
      display: block;
      clear: left;
      padding-bottom: 1em;
      font-size: 12px;
      color: #999999;
    }

    .lb-data .lb-close {
      display: block;
      float: right;
      width: 30px;
      height: 30px;
      background: url(../images/close.png) top right no-repeat;
      text-align: right;
      outline: none;
      filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=70);
      opacity: 0.7;
      -webkit-transition: opacity 0.2s;
      -moz-transition: opacity 0.2s;
      -o-transition: opacity 0.2s;
      transition: opacity 0.2s;
    }

    .lb-data .lb-close:hover {
      cursor: pointer;
      filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100);
      opacity: 1;
    }
  </style>

  <script>
    var myWindow;

      function openWin() {
        myWindow = window.open(window.location.href, "", "width=250, height=250");
      }

      function resizeWinTo() {
        myWindow.resizeTo(450, 800);
        myWindow.focus();
      }

      function resizeWinBy() {
        myWindow.resizeBy(-100, -50);
        myWindow.focus();
      }
  </script>
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('style.css') }}" />
  <link href='{{URL(' css/fonts.css')}}' rel='stylesheet' type='text/css' />
</head>

<body>

  <div class="special-settings">
    <div class="special-settings-wrapper clearfix container">
      <div class="a-fontsize col-md-4">
        Шрифт ўлчами:
        <button class="down" title="Шрифт ўлчамини камайтириш"> - </button>
        <button class="up" title="Шрифт ўлчамини кўпайтириш"> + </button>

      </div>
      <div class="a-colors col-md-4">
        Сайт ранги:
        <button class="black" title="Оқ фонда қора шрифт">A</button>
        <button class="yellow" title="Қора фонда оқ шрифт">В</button>

      </div>
      <div class="norm-version col-md-4">
        <a href="{{'/'.URL(App::getLocale())}}" id="normalversion" data-set="normalversion"
          title="Полная версия сайта">Сайтни тўлиқ нусхаси</a>
      </div>
    </div> <!-- .special-settings-wrapper -->
    <div class="clr"></div>
  </div>

  @section('header')
  <header id="header">
    <div class="container">
      <div class="header-panel">
        <div class="row">
          <div class="col-sm-8 col-xs-5" id="app">
            <a href="#" class="btn mobile-link hidden-sm btn-open-adaptive hidden-xs hidden-sm"
              onclick="openWin();resizeWinTo();"><span class="glyphicon glyphicon-phone"
                style="font-size:16px;"></span><span class="hidden-xs" style="vertical-align:text-bottom;">
                @lang('blog.mobile_version')</span></a>
            <button class="specialversion btn"><span class="glyphicon glyphicon-eye-open"
                style="font-size:16px;"></span><span class="hidden-xs hidden-sm" style="vertical-align:text-bottom;">
                @lang('blog.blind')</span></button>

            <a href="#" v-if="readCookie('voice') == 'off'" id="voices" class="btn sitemap-link voices"
              title="Овозли матн"><span class="glyphicon glyphicon-volume-off" style="font-size:18px;"></span><span
                class="hidden-xs hidden-sm" style="vertical-align:text-bottom;"> @lang('blog.voice')</span></a>
            <a href="#" v-else="readCookie('voice') == 'on'" id="voices" class="btn sitemap-link voices"
              title="Овозли матн"><span class="glyphicon glyphicon-volume-up" style="font-size:18px;"></span><span
                class="hidden-xs hidden-sm" style="vertical-align:text-bottom;"> @lang('blog.voice')</span></a>


            <a href="{{URL(App::getLocale().'/map')}}" class="btn sitemap-link"><span class="glyphicon glyphicon-globe"
                style="font-size:16px;"></span><span class="hidden-xs hidden-sm" style="vertical-align:text-bottom;">
                @lang('blog.map')</span></a>
          </div>
          <div class="col-sm-4 col-xs-7 text-right">
            <div class="lang-menu">
              @section('lan')
              <a href="/admin" class="btn auth-link"><span class="glyphicon glyphicon-log-in"></span><span
                  class="hidden-xs hidden-sm"> @lang('blog.enter')</span></a>
              @foreach($languages->get() as $key=>$language)
              @if(App::getLocale() == $language->language_prefix)
              <a href="{{  str_replace(" /".App::getLocale(),"/".$language->language_prefix,URL::current()) }}"
                class="btn lang selected"><span class="hidden-xs">{{$language->language_name}}</span><span
                  class="visible-xs">{{$language->language_prefix}}</span></a>
              @else
              <a href="{{  str_replace(" /".App::getLocale(),"/".$language->language_prefix,URL::current()) }}"
                class="btn lang "><span class="hidden-xs">{{$language->language_name}}</span><span
                  class="visible-xs">{{$language->language_prefix}}</span></a>
              @endif
              @endforeach
              @show
            </div>
          </div>
        </div>
      </div>

      <div class="row hidden-xs">
        <div class="col-sm-3 col-md-2 logo">
          <a href="{{URL(App::getLocale().'/')}}"><img src="{{URL('/images/flag_gerb_uz.png')}}" alt=""
              class="img-responsive" width="190"></a>
        </div>
        <div class="col-sm-6 site-name">
          <h2><a href="{{URL('/'.App::getLocale())}}"
              title="ЎзРес Сув хўжалиги вазирлиги">@lang('blog.company_name')</a></h2>
        </div>
      </div>
      <div class="row visible-xs">
        <div class="col-xs-4"><a href="/">
            <img src="{{URL('/images/flag_gerb_uz.png')}}" alt="" class="" width="100%"></a>
        </div>
        <div class="col-xs-8" style="padding-top: 10px">
          <div class="site-name">
            <h5><a href="{{URL(App::getLocale().'/')}}">@lang('blog.company_name')</a></h5>
          </div>
        </div>
      </div>
    </div><!-- .container -->
  </header>
  @show


  @section('top-menu')
  <div class="top-menu">
    @include('layout.menu')
  </div>
  @show


  @section('content_div')
  <div class="first-layer">
    <div class="container-fluid" id="main-content">
      <div class="container">
        @show
        <div class="row"><br />
          <div id="home-content" class="col-sm-9">
            <div class="row">
              @section('left_sidebar_menu')
              <div class="col-sm-3 hidden-xs sidenav">
                <div class="left-sidebar">
                  <h5>@lang('blog.activity')</h5>
                  <div class="list-group">
                    @section('suvfaoliati')

                    @show
                  </div>
                </div>
                <!-- <div class="left-sidebar">
                    <h5>@lang('blog.events')</h5>
                    <div class="list-group">
                    @section('tadbirlar')
                      <a href="#" class="list-group-item"><img src="{{URL('/images/irrigation.png')}}" alt="" width="30" height="30" /><p>Ирригация</p></a>

                    @show
                    </div>
                  </div>-->
                <div class="container-fluid useful-btns">
                  <a href="{{URL(App::getLocale().'/doc/1546094482')}}" class="" style="color: #fff">
                    <div class="row" style="display: flex; height: 70px; align-items: center; justify-content: center;">
                      <div class="col-sm-2"><img src="{{URL('/images/law_books.png')}}" alt=""></div>
                      <div class="col-sm-9">
                        <p style="margin: 5px 5px">@lang('blog.docs')</p>
                      </div>
                    </div>
                  </a>
                </div><br />
                <div class="container-fluid useful-btns">
                  <a href="#" class="" style="color: #fff">
                    <div class="row" style="display: flex; height: 70px; align-items: center; justify-content: center;">
                      <div class="col-sm-2"><img src="{{URL('/images/interaktiv.png')}}" alt=""></div>
                      <div class="col-sm-9">
                        <p style="margin: 5px 5px">@lang('blog.interactive')</p>
                      </div>
                    </div>
                  </a>
                </div><br />
                <div class="container-fluid useful-btns">
                  <a href="#" class="" style="color: #fff">
                    <div class="row" style="display: flex; height: 70px; align-items: center; justify-content: center;">
                      <div class="col-sm-2"><img src="{{URL('/images/murojaatlar.png')}}" alt=""></div>
                      <div class="col-sm-9">
                        <p style="margin: 5px 5px">@lang('blog.currently')</p>
                      </div>
                    </div>
                  </a>
                </div><br />
                <div class="container-fluid useful-btns">
                  <a href="#" class="" style="color: #fff">
                    <div class="row" style="display: flex; height: 70px; align-items: center; justify-content: center;">
                      <div class="col-sm-2"><img src="{{URL('/images/maslahatlar.png')}}" alt=""></div>
                      <div class="col-sm-9">
                        <p style="margin: 5px 5px">@lang('blog.interpretations')</p>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
              @show

              @section('nowosti')
              <div class="home-news-block col-sm-9 col-sm-12" style="background-color: white;padding-bottom: 10px">
                <div class="row blue-header">
                  <h4>@lang('blog.news')</h4>
                </div>
                <div class="row">
                  @section('newsblok')
                  <!--<div class="col-sm-6">
                      <img class="img-responsive" src="/public/temacss/images/1-500(11).jpg" alt="">
                      <h4><a href="#">2018 йилда сув хужалиги тармогида амалга оширилган ишлар хакида</a></h4>
                      <h6>20.09.2018</h6>
                      <p>Бугунги кунда Хитойда баликчилик сохасида оилавий пудрат тури кенг таркалган, бу баликчилик сохасининг бизга маълум булмаган кирраларини очиб беради. Ахолини куп тармокли иш юритиши нафакат Хитой халкини дастурхонини яхна балик билан тулдиради, балки унинг узини хам бойитади. Дехконлар давлатдан ва жамоа хужаликларидан сув хавзаларини, шоли экин майдонларини ижарага олиш билан бирга узлари хам буш ерларда ва ховлиларида кичик хавзалар барпо этиб балик етиштиришади.</p>
                    </div>-->
                  @show
                </div>
              </div>
              @show
            </div><br />

            @section('statistika')
            <?php
            $statisticas = \App\Models\Statistics::take(4)->where('photo_url','<>','')->where("language_id", $current_lang_id)->orderBy('id','desc')->get();
            ?>
            <div class="statistika col-xs-12">
              <div class="row" style="background-color: #fff">
                <div class="col-xs-12" style="padding: 10px 0 0 30px;">
                  <h4><b>@lang('blog.statistica')</b></h4>
                </div>
                <div id="statCarousel" class="carousel slide" data-ride="carousel">
                  <!-- Indicators -->
                  <ol class="carousel-indicators">
                    @foreach($statisticas as $key=>$statistica)
                    @if($key == 0)
                    <li data-target="#statCarousel" data-slide-to="{{$key}}" class="active"></li>
                    @else
                    <li data-target="#statCarousel" data-slide-to="{{$key}}"></li>
                    @endif
                    @endforeach
                    <!--<li data-target="#statCarousel" data-slide-to="2"></li>
                      <li data-target="#statCarousel" data-slide-to="3"></li>-->
                  </ol>

                  <!-- Wrapper for slides -->
                  <div class="carousel-inner" role="listbox">
                    @foreach($statisticas as $key=>$statistica)
                    @if($key == 0)
                    <div class="item active">
                      <img class="img-responsive center-block"
                        src="{{URL(App::getLocale().'/downloads?type=statistica&id='.$statistica->id)}}"
                        alt="{{$statistica->name}}">
                    </div>
                    @else
                    <div class="item">
                      <img class="img-responsive center-block"
                        src="{{URL(App::getLocale().'/downloads?type=statistica&id='.$statistica->id)}}"
                        alt="{{$statistica->name}}">
                    </div>
                    @endif

                    @endforeach


                    <!--<div class="item">
                        <img class="img-responsive center-block" src="{{URL('/images/87c42995a2ddfbaa456cc6d324abff47.jpg')}}" alt="Uzb">
                      </div>

                      <div class="item">
                        <img class="img-responsive center-block" src="{{URL('/images/87c42995a2ddfbaa456cc6d324abff47.jpg')}}" alt="Uzb">
                      </div>-->

                  </div>

                </div><br />
              </div>
            </div>
            @show
          </div>
          @section('nav_page')
          @show
          @section('right_sidebar')
          <div class="col-sm-3" style="float: right">
            <div class="col">
              <img class="img-responsive" src="{{URL('/images/banner-home-yilnomi.png')}}" alt="" />
            </div>
            <br />
            <div class="col request-to-minister">
              <div class="col blue-header">
                <h4>@lang('blog.ministr')</h4>
              </div>
              <div class="col">
                <a href="https://pm.gov.uz/uz#/authorities/1/191/_apply"><img class="img-responsive"
                    src="{{URL('/images/vazirga-murojaat-banneri.png')}}" alt="" /></a>
              </div>
            </div>
            <!-- Sidebar/Эълонлар блоги-->
            <!--<div class="col menu-item-structure">
                  <div class="col text-center">
                    <h4>@lang('blog.deals')</h4>
                  </div>
                  <div class="well-sm" style="background-color: white;">
                    @section('elonlar')
                    <div class="row">
                      <div class="col-xs-4" style="padding-top: 10px">
                        <a href="#"><img class="center-block" src="{{URL('/images/main-5bb2888b-4cfb-453a-ba1f-8e0ad73854e4.jpeg')}}" alt="" width="77" height="63"></a>
                      </div>
                      <div class="col-xs-8">
                        <a href="#"><h6>@lang('blog.education')</h6></a>
                      </div>
                    </div>
                    @show
                  </div>
                </div>-->

            <div class="events-widget">
              <div class="col force-margin">
                <div class="col text-center blue-header">
                  <h4>@lang('blog.events')</h4>
                </div>
                <div class="well-sm" style="background-color: white;">
                  @foreach($events as $value)
                  <div class="row">
                    <div class="col-xs-4" style="padding-top: 10px">
                      <a href="{{URL(App::getLocale().'/event/'.$value->event_category_id)}}"><img class="center-block"
                          src="{{URL(App::getLocale().'/downloads?type=event&id='.$value->group)}}" width="77"
                          height="63"></a>
                    </div>
                    <div class="col-xs-8">
                      <a href="{{URL(App::getLocale().'/event/'.$value->event_category_id)}}">
                        <h6>{{$value->title}}</h6>
                      </a>
                    </div>
                  </div><!-- .row -->
                  @endforeach
                </div>
              </div>
            </div>
            <!--Sidebar Тендерлар ва конкурслар-->
            <div class="col tenders">
              <div class="col-xs-12 text-center blue-header">
                <h4>@lang('blog.tender')</h4>
              </div>
              <div class="well-sm force-margin" style="background-color: white;">

                @section('tender')
                <div class="row">
                  <div class="col-xs-4" style="padding-top: 10px">
                    <a href="#"><img class="img-responsive center-block"
                        src="{{URL('/images/CandidateManagement.png')}}" alt=""></a>
                  </div>
                  <div class="col-xs-8">
                    <a href="#">
                      <h6>@lang('blog.vacan')</h6>
                    </a>
                  </div>
                </div><!-- .row -->
                <div class="row">
                  <div class="col-xs-4" style="padding-top: 5px">
                    <a href="#"><img class="img-responsive center-block" src="{{URL('/images/water-intensiv.png')}}"
                        alt=""></a>
                  </div>
                  <div class="col-xs-8">
                    <a href="#">
                      <h6>@lang('blog.new_technoligy')</h6>
                    </a>
                  </div>
                </div>
                @show
              </div>
            </div>
            @section('sorovnoma')

            <div class="survey-widget">


              @include('layout.sorov')


            </div>
            @show
            <div class="currency-widget ">


              @include("layout.kurs")

            </div>
            <div class="weather-widget ">

              @include("layout.weather")
            </div>

          </div><br />
          @show

          @section('video_foto_baner')

          <div class="col-sm-12 media-blok">


            @include('layout.photovideo')


          </div>
          @show



        </div>
      </div>
    </div><br />
  </div>

  @section('regional_uprav')
  <!--banner/hududiy boshqarmalar-->
  <div id="locals" class="container-fluid">
    <div class="row" style="background-color: #D4E2EA; opacity: 0.7; padding: 50px;">
      <div class="container text-center">
        <div class="col-sm-4 hidden-xs">
          <hr />
        </div>
        <div class="col-sm-4">
          <h4 style="color: #000;"><b>@lang('blog.local_department')</b></h4>
        </div>
        <div class="col-sm-4 hidden-xs">
          <hr />
        </div>
      </div><br />
      <div class="col-md-1 hidden-sm hidden-xs"></div>
      <div class="col-md-6">
        <svg id="map" version="1.1" viewBox="0 0 700 450" height="300pt" width="500pt"
          xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

          <path class="map-highlight" fill="#3D7C9D" stroke="#fff" stroke-width="1" id="uz_fa"
            d="M648.2,291.3 L644.2,289.7 L647.9,287.0 L649.2,287.1 Z M623.1,286.1 L625.3,285.1 L626.0,286.5 L623.6,288.7 L625.8,291.9 L625.5,294.3 L621.6,295.4 L619.3,294.0 L617.8,295.4 L617.1,293.8 L618.6,290.9 L618.3,289.3 L616.0,288.6 L614.0,285.0 L614.7,281.4 L616.9,281.0 L618.4,283.7 Z M636.4,245.1 L639.5,249.1 L640.1,247.9 L646.3,248.9 L649.0,252.0 L657.9,252.4 L663.8,253.9 L664.7,259.3 L662.1,259.9 L659.5,261.7 L658.6,264.9 L654.3,268.3 L654.5,269.8 L657.2,272.1 L649.7,272.3 L647.5,276.3 L644.9,278.5 L643.4,278.5 L641.8,273.2 L640.3,273.4 L639.9,276.1 L635.0,275.3 L633.3,273.3 L630.0,271.8 L626.5,271.9 L624.6,270.9 L623.3,274.1 L617.2,274.1 L614.8,274.7 L613.5,276.4 L609.0,277.0 L603.2,279.4 L599.7,279.7 L598.0,278.7 L596.3,274.0 L594.1,272.0 L591.6,272.6 L588.6,271.7 L589.0,269.8 L587.5,266.8 L589.2,264.8 L592.0,263.9 L594.1,260.8 L602.9,252.5 L605.7,249.7 L607.9,249.5 L609.7,247.6 L613.2,248.2 L617.8,247.5 L615.5,251.3 L624.4,254.8 L625.3,254.5 L629.6,248.9 Z">
          </path>

          <path class="map-highlight" fill="#d01a20" stroke="#fff" stroke-width="1" id="uz_tk" aria-selected="true"
            d="M543.4,224.6 L538.8,229.3 L534.2,226.1 L535.3,221.7 L537.3,219.4 L542.5,220.8 L542.2,222.8 Z"></path>

          <path class="map-highlight" fill="#3D7C9D" stroke="#fff" stroke-width="1" id="uz_an"
            d="M660.2,230.0 L664.2,228.4 L665.4,225.8 L667.3,227.8 L671.6,228.5 L672.2,230.7 L674.8,231.1 L678.3,234.9 L681.7,235.5 L686.9,234.4 L688.6,234.6 L688.9,237.1 L694.0,233.7 L696.3,235.3 L700.0,235.0 L699.3,237.8 L693.8,241.0 L690.5,243.7 L686.3,245.5 L685.4,250.8 L681.9,251.0 L681.6,253.5 L679.1,255.1 L676.0,253.4 L673.1,252.9 L670.1,250.4 L668.9,251.1 L669.9,255.9 L672.8,258.5 L672.6,261.2 L670.9,262.7 L666.6,261.1 L664.7,259.3 L663.8,253.9 L657.9,252.4 L649.0,252.0 L646.3,248.9 L640.1,247.9 L639.5,249.1 L636.4,245.1 L637.4,243.8 L636.2,241.2 L638.3,238.6 L642.4,237.0 L648.9,236.1 L654.4,236.8 L659.5,235.5 Z">
          </path>

          <path class="map-highlight" fill="#3D7C9D" stroke="#fff" stroke-width="1" id="uz_na"
            d="M636.4,245.1 L629.6,248.9 L625.3,254.5 L624.4,254.8 L615.5,251.3 L617.8,247.5 L613.2,248.2 L609.7,247.6 L607.9,249.5 L605.7,249.7 L602.9,252.5 L603.2,250.2 L597.7,248.9 L597.1,246.5 L600.3,247.7 L599.9,246.2 L589.2,236.3 L588.7,229.9 L586.5,227.1 L587.1,222.8 L585.6,222.3 L585.5,220.1 L587.9,215.3 L594.2,211.3 L597.2,212.3 L599.8,216.0 L600.1,221.6 L600.9,223.2 L603.2,222.4 L606.9,225.1 L611.5,224.9 L615.6,226.2 L618.2,228.7 L618.1,224.8 L619.8,224.2 L622.6,227.9 L623.9,225.5 L626.9,227.6 L627.8,224.8 L626.5,215.5 L627.2,214.9 L631.2,217.2 L633.6,215.5 L635.1,209.4 L633.1,206.2 L634.9,203.0 L636.4,203.7 L636.4,209.0 L639.7,208.1 L644.9,214.9 L645.9,221.2 L650.2,220.8 L652.7,222.6 L655.6,220.1 L658.2,221.4 L660.2,230.0 L659.5,235.5 L654.4,236.8 L648.9,236.1 L642.4,237.0 L638.3,238.6 L636.2,241.2 L637.4,243.8 Z M597.1,239.1 L595.8,236.9 L593.5,237.1 L596.4,239.9 Z">
          </path>

          <path class="map-highlight" fill="#3D7C9D" stroke="#fff" stroke-width="1" id="uz_ji"
            d="M518.0,286.7 L515.5,287.9 L520.5,290.4 L518.3,294.1 L519.4,299.0 L519.0,304.8 L518.1,305.9 L518.2,314.6 L517.6,317.0 L514.9,319.4 L514.9,321.2 L511.6,322.5 L507.5,322.8 L504.0,321.8 L497.8,322.0 L483.3,319.0 L479.9,319.7 L476.1,322.7 L472.8,323.4 L472.4,326.6 L470.0,327.1 L464.9,323.0 L463.9,321.5 L464.1,316.8 L466.6,316.3 L466.7,311.7 L471.9,308.8 L469.8,302.7 L453.4,300.2 L451.3,296.3 L447.9,296.4 L447.8,293.4 L449.2,290.9 L447.9,288.1 L446.4,287.1 L445.1,280.3 L445.7,277.7 L444.6,274.8 L433.8,274.3 L439.5,261.8 L440.6,258.9 L439.1,256.2 L438.6,252.8 L434.9,251.9 L433.2,250.1 L432.2,242.6 L433.0,241.1 L437.9,238.6 L440.3,239.1 L478.1,235.0 L481.7,236.3 L485.8,233.7 L488.7,238.1 L490.2,242.0 L493.5,240.5 L493.0,243.4 L493.9,244.4 L492.6,251.0 L489.2,254.5 L492.4,255.6 L496.3,259.1 L500.9,261.9 L500.4,264.7 L497.2,265.9 L497.1,269.2 L499.3,269.9 L495.1,281.3 L495.8,285.4 L506.4,285.2 L518.5,281.3 L517.4,285.8 Z">
          </path>

          <path class="map-highlight" fill="#3D7C9D" stroke="#fff" stroke-width="1" id="uz_si"
            d="M520.5,290.4 L530.0,287.9 L532.1,289.2 L532.3,292.2 L528.3,292.1 L525.6,294.0 L523.8,291.9 L524.7,296.5 L528.7,301.3 L527.2,303.4 L524.4,297.9 L523.3,297.8 L525.0,301.8 L523.6,305.7 L520.8,303.6 L519.0,304.8 L519.4,299.0 L518.3,294.1 Z M535.7,283.7 L533.4,283.1 L526.7,284.6 L524.6,285.9 L521.2,285.8 L518.0,286.7 L517.4,285.8 L518.5,281.3 L506.4,285.2 L495.8,285.4 L495.1,281.3 L499.3,269.9 L497.1,269.2 L497.2,265.9 L500.4,264.7 L500.9,261.9 L509.2,265.6 L511.7,263.6 L514.5,264.4 L515.7,260.7 L514.8,258.1 L513.0,257.3 L511.9,251.9 L512.5,247.6 L515.6,245.3 L517.8,247.1 L519.7,250.8 L522.8,251.4 L529.0,257.7 L529.3,259.5 L531.5,258.8 L530.8,260.5 L533.2,260.0 L535.6,263.1 L534.6,267.2 L536.9,270.5 L535.7,273.2 L535.2,278.2 L536.3,280.8 Z">
          </path>

          <path class="map-highlight" fill="#3D7C9D" stroke="#fff" stroke-width="1" id="uz_ta"
            d="M587.9,215.3 L585.5,220.1 L585.6,222.3 L587.1,222.8 L586.5,227.1 L588.7,229.9 L589.2,236.3 L585.3,235.7 L584.6,241.5 L582.6,244.4 L575.6,248.4 L572.0,251.7 L564.6,254.7 L561.5,258.3 L558.2,259.3 L551.4,252.4 L548.3,251.1 L545.1,252.6 L543.6,255.4 L544.1,261.9 L540.9,263.4 L539.6,265.7 L541.4,268.3 L544.7,275.1 L545.0,278.9 L540.9,279.0 L541.2,280.5 L544.4,283.0 L544.5,284.3 L540.9,285.2 L535.7,283.7 L536.3,280.8 L535.2,278.2 L535.7,273.2 L536.9,270.5 L534.6,267.2 L535.6,263.1 L533.2,260.0 L530.8,260.5 L531.5,258.8 L529.3,259.5 L529.0,257.7 L522.8,251.4 L519.7,250.8 L517.8,247.1 L515.6,245.3 L518.0,243.4 L519.2,239.0 L522.9,236.3 L524.3,233.7 L526.9,233.0 L530.5,229.8 L530.8,224.6 L529.7,221.9 L536.8,216.4 L539.3,216.4 L541.4,215.1 L543.8,215.3 L543.7,211.3 L546.9,209.5 L552.5,203.9 L557.8,202.0 L563.9,200.6 L566.1,197.6 L568.3,196.6 L572.4,192.6 L574.7,187.6 L577.7,185.2 L578.7,181.9 L584.0,178.2 L586.1,179.4 L587.5,181.7 L590.6,181.3 L592.6,175.7 L594.7,171.6 L597.6,171.9 L600.5,170.6 L605.5,165.7 L608.1,165.8 L614.1,169.3 L615.5,169.7 L615.1,171.7 L610.5,174.2 L605.2,179.0 L600.0,180.2 L599.7,185.4 L598.0,187.0 L594.0,187.8 L589.1,192.4 L585.8,198.8 L581.1,202.6 L574.9,207.0 L574.2,208.5 L576.6,210.8 L582.4,210.9 Z M543.4,224.6 L542.2,222.8 L542.5,220.8 L537.3,219.4 L535.3,221.7 L534.2,226.1 L538.8,229.3 Z">
          </path>

          <path class="map-highlight" fill="#3D7C9D" stroke="#fff" stroke-width="1" id="uz_bu"
            d="M342.5,360.6 L340.2,358.4 L334.6,360.4 L332.1,359.6 L314.7,347.4 L312.2,344.8 L307.6,338.6 L305.0,336.1 L268.2,309.9 L262.4,303.4 L261.1,297.7 L261.9,294.6 L260.5,290.7 L260.2,287.1 L258.8,284.0 L258.4,280.7 L251.6,276.6 L260.3,266.1 L262.4,261.5 L260.6,257.6 L254.0,250.1 L263.3,245.8 L263.2,245.0 L251.8,228.9 L266.2,223.6 L269.6,223.7 L271.9,228.4 L278.7,236.5 L284.2,246.2 L294.1,249.6 L300.4,253.1 L312.7,260.6 L315.1,264.8 L320.0,263.0 L322.9,258.7 L325.2,253.6 L327.6,251.6 L330.0,253.6 L330.3,259.0 L332.7,260.8 L343.8,261.9 L344.7,261.1 L345.8,256.2 L348.0,255.2 L353.4,254.9 L356.4,253.9 L357.7,252.0 L358.6,253.4 L360.6,261.7 L363.5,263.7 L367.5,264.6 L380.0,265.1 L381.9,264.5 L381.0,267.9 L381.1,274.3 L377.6,274.0 L375.8,279.2 L374.2,281.0 L372.9,284.9 L368.1,284.9 L364.6,283.1 L361.2,284.3 L362.3,287.9 L361.6,291.4 L363.7,293.9 L360.6,295.2 L358.7,299.2 L354.2,302.5 L350.9,308.4 L354.7,313.8 L359.7,317.2 L361.4,316.3 L367.5,319.2 L369.2,324.9 L373.1,327.6 L374.2,331.8 L368.2,337.6 L365.7,338.6 L362.6,342.1 L362.1,344.2 L364.2,347.2 L363.7,348.3 L348.8,354.3 L346.9,355.6 Z">
          </path>

          <path class="map-highlight" fill="#3D7C9D" stroke="#fff" stroke-width="1" id="uz_xo"
            d="M254.0,250.1 L260.6,257.6 L262.4,261.5 L260.3,266.1 L251.6,276.6 L248.9,271.6 L248.1,268.3 L245.9,265.3 L243.5,256.1 L243.1,249.1 L239.4,243.2 L230.4,236.3 L222.9,233.6 L220.5,233.9 L219.5,236.9 L215.1,241.0 L211.9,240.3 L207.8,237.3 L202.8,238.3 L200.9,236.3 L198.1,235.5 L189.9,235.8 L185.0,237.3 L182.5,237.3 L180.0,236.0 L175.4,231.8 L167.2,227.2 L165.9,224.8 L166.5,220.5 L170.4,216.8 L166.4,209.5 L166.1,207.6 L168.3,205.4 L173.2,207.2 L173.9,204.9 L170.0,201.2 L171.0,199.5 L170.4,197.5 L173.4,196.6 L176.5,194.5 L182.9,196.6 L182.9,200.2 L186.3,206.9 L190.4,208.2 L191.4,211.2 L193.7,214.6 L203.1,223.5 L205.1,224.2 L207.7,227.1 L211.7,228.4 L214.7,233.2 L218.3,233.5 L220.0,230.4 L222.0,228.8 L225.0,228.7 L232.8,230.7 L238.9,234.6 L245.7,242.3 L250.5,250.1 Z">
          </path>

          <path class="map-highlight" fill="#3D7C9D" stroke="#fff" stroke-width="1" id="uz_qo"
            d="M251.8,228.9 L263.2,245.0 L263.3,245.8 L254.0,250.1 L250.5,250.1 L245.7,242.3 L238.9,234.6 L232.8,230.7 L225.0,228.7 L222.0,228.8 L220.0,230.4 L218.3,233.5 L214.7,233.2 L211.7,228.4 L207.7,227.1 L205.1,224.2 L203.1,223.5 L193.7,214.6 L191.4,211.2 L190.4,208.2 L186.3,206.9 L182.9,200.2 L182.9,196.6 L176.5,194.5 L173.4,196.6 L170.4,197.5 L171.0,199.5 L170.0,201.2 L168.0,198.7 L161.7,197.0 L161.3,194.7 L164.5,193.7 L163.7,188.9 L164.2,186.4 L166.4,185.2 L166.1,183.5 L163.4,182.2 L159.8,177.7 L152.7,177.1 L144.2,178.1 L141.2,177.5 L139.7,175.7 L136.7,175.0 L135.1,173.4 L134.0,167.3 L130.6,163.9 L127.2,164.7 L121.6,162.9 L119.0,160.3 L111.0,149.8 L109.3,150.4 L108.5,154.9 L105.9,156.8 L101.8,156.0 L97.6,154.0 L91.4,156.4 L91.9,158.9 L98.1,162.7 L102.8,172.2 L104.9,175.1 L101.7,176.1 L100.6,175.1 L100.8,170.5 L98.6,168.0 L94.7,165.9 L90.4,165.9 L89.0,163.9 L85.7,163.9 L81.9,167.1 L82.8,170.4 L80.6,176.1 L78.0,177.8 L78.8,179.8 L70.4,181.4 L69.5,176.6 L65.9,173.5 L64.2,173.2 L60.9,170.3 L57.6,170.9 L54.3,173.0 L52.8,175.5 L46.5,192.0 L41.5,195.0 L42.0,201.4 L41.1,206.8 L42.9,211.7 L42.8,216.7 L44.8,220.7 L48.2,222.4 L44.7,224.6 L41.7,228.1 L33.0,225.6 L0.0,221.3 L16.6,23.4 L16.7,23.4 L75.3,9.5 L94.6,4.9 L115.9,0.0 L118.1,0.9 L116.2,7.3 L110.8,14.2 L108.3,22.2 L102.9,33.3 L102.2,38.8 L105.0,47.4 L104.2,50.3 L101.5,54.4 L102.2,58.6 L103.8,60.4 L107.2,60.7 L113.0,56.7 L119.6,48.2 L119.3,46.5 L116.2,46.2 L117.5,42.6 L119.6,42.5 L121.2,45.0 L123.2,44.0 L121.8,41.2 L122.5,38.2 L121.9,33.7 L123.8,33.4 L125.3,28.4 L119.5,31.3 L118.4,29.3 L120.3,25.2 L125.4,20.5 L122.8,17.8 L121.8,12.3 L122.0,9.2 L123.7,5.1 L149.5,24.3 L146.3,30.8 L144.2,33.6 L143.2,37.3 L140.4,41.5 L138.9,45.4 L140.1,50.5 L144.3,55.9 L151.2,63.4 L155.1,66.6 L154.6,70.5 L152.7,71.6 L150.4,76.4 L150.9,77.9 L160.1,77.2 L165.5,74.3 L166.7,72.3 L164.5,70.9 L165.7,68.1 L169.8,67.7 L171.0,63.5 L170.5,58.9 L168.9,51.7 L172.0,46.8 L172.3,41.0 L209.2,67.1 L210.8,69.7 L211.6,75.1 L213.8,78.8 L222.3,88.4 L245.3,115.7 L246.9,116.4 L251.0,123.6 L253.0,125.5 L263.6,128.5 L264.0,130.0 L253.1,150.2 L242.7,169.6 L240.4,174.7 L239.4,187.0 L244.7,197.2 L235.3,202.7 L234.8,204.9 Z">
          </path>

          <path class="map-highlight" fill="#3D7C9D" stroke="#fff" stroke-width="1" id="uz_nv"
            d="M437.9,238.6 L433.0,241.1 L432.2,242.6 L433.2,250.1 L434.9,251.9 L438.6,252.8 L439.1,256.2 L440.6,258.9 L439.5,261.8 L433.8,274.3 L432.4,270.7 L429.5,267.7 L423.0,270.3 L419.4,268.7 L416.8,272.7 L417.6,276.2 L416.0,278.7 L416.9,286.3 L413.9,294.1 L416.6,295.3 L413.0,299.0 L404.1,301.2 L396.4,298.6 L394.6,296.5 L389.4,294.7 L388.3,295.0 L386.6,300.5 L387.7,301.5 L386.0,307.7 L382.7,308.0 L379.5,306.9 L378.4,309.1 L373.9,310.1 L373.4,311.5 L376.1,314.5 L377.5,318.9 L376.2,323.9 L379.1,330.2 L378.3,330.7 L374.2,331.8 L373.1,327.6 L369.2,324.9 L367.5,319.2 L361.4,316.3 L359.7,317.2 L354.7,313.8 L350.9,308.4 L354.2,302.5 L358.7,299.2 L360.6,295.2 L363.7,293.9 L361.6,291.4 L362.3,287.9 L361.2,284.3 L364.6,283.1 L368.1,284.9 L372.9,284.9 L374.2,281.0 L375.8,279.2 L377.6,274.0 L381.1,274.3 L381.0,267.9 L381.9,264.5 L380.0,265.1 L367.5,264.6 L363.5,263.7 L360.6,261.7 L358.6,253.4 L357.7,252.0 L356.4,253.9 L353.4,254.9 L348.0,255.2 L345.8,256.2 L344.7,261.1 L343.8,261.9 L332.7,260.8 L330.3,259.0 L330.0,253.6 L327.6,251.6 L325.2,253.6 L322.9,258.7 L320.0,263.0 L315.1,264.8 L312.7,260.6 L300.4,253.1 L294.1,249.6 L284.2,246.2 L278.7,236.5 L271.9,228.4 L269.6,223.7 L266.2,223.6 L251.8,228.9 L234.8,204.9 L235.3,202.7 L244.7,197.2 L239.4,187.0 L240.4,174.7 L242.7,169.6 L253.1,150.2 L264.0,130.0 L263.6,128.5 L253.0,125.5 L251.0,123.6 L246.9,116.4 L264.6,113.3 L293.2,108.7 L340.9,112.6 L342.3,112.2 L357.5,103.3 L360.1,102.9 L361.5,104.1 L370.2,114.8 L374.2,118.8 L384.0,125.0 L395.7,147.3 L396.4,147.3 L407.6,140.8 L406.8,170.4 L405.3,172.5 L405.7,193.5 L406.2,194.3 L425.8,193.8 L427.7,207.4 L430.8,220.6 L435.0,236.3 Z">
          </path>

          <path class="map-highlight" fill="#3D7C9D" stroke="#fff" stroke-width="1" id="uz_sa"
            d="M470.0,327.1 L469.3,329.7 L468.5,337.5 L467.3,337.8 L457.2,335.7 L455.0,335.7 L453.9,338.1 L447.9,337.9 L447.8,334.8 L446.8,332.5 L439.0,331.5 L436.5,332.8 L434.8,335.3 L431.7,336.7 L426.5,333.8 L419.5,335.5 L414.1,338.4 L409.8,337.8 L408.9,333.7 L404.3,330.0 L402.3,326.2 L399.5,326.4 L399.4,328.3 L396.9,330.1 L379.1,330.2 L376.2,323.9 L377.5,318.9 L376.1,314.5 L373.4,311.5 L373.9,310.1 L378.4,309.1 L379.5,306.9 L382.7,308.0 L386.0,307.7 L387.7,301.5 L386.6,300.5 L388.3,295.0 L389.4,294.7 L394.6,296.5 L396.4,298.6 L404.1,301.2 L413.0,299.0 L416.6,295.3 L413.9,294.1 L416.9,286.3 L416.0,278.7 L417.6,276.2 L416.8,272.7 L419.4,268.7 L423.0,270.3 L429.5,267.7 L432.4,270.7 L433.8,274.3 L444.6,274.8 L445.7,277.7 L445.1,280.3 L446.4,287.1 L447.9,288.1 L449.2,290.9 L447.8,293.4 L447.9,296.4 L451.3,296.3 L453.4,300.2 L469.8,302.7 L471.9,308.8 L466.7,311.7 L466.6,316.3 L464.1,316.8 L463.9,321.5 L464.9,323.0 Z">
          </path>

          <path class="map-highlight" fill="#3D7C9D" stroke="#fff" stroke-width="1" id="uz_qa"
            d="M467.3,337.8 L467.1,341.6 L468.4,342.7 L473.5,344.2 L476.9,344.2 L481.2,347.1 L481.3,352.6 L475.6,354.3 L474.8,356.1 L476.8,361.6 L477.1,365.4 L476.0,369.2 L472.1,367.7 L470.1,369.1 L467.8,374.1 L464.0,376.7 L460.6,381.6 L459.7,386.9 L454.6,391.5 L450.3,393.4 L447.7,398.9 L442.7,404.0 L441.2,409.5 L439.9,410.4 L439.4,408.9 L436.3,407.3 L431.4,407.0 L425.7,404.8 L422.3,401.2 L418.1,399.9 L414.2,397.3 L411.4,397.0 L407.0,395.0 L404.4,395.5 L401.3,397.8 L398.4,398.2 L395.5,397.3 L378.3,386.3 L368.5,377.8 L365.6,376.1 L359.4,374.0 L353.9,371.0 L344.9,363.6 L342.5,360.6 L346.9,355.6 L348.8,354.3 L363.7,348.3 L364.2,347.2 L362.1,344.2 L362.6,342.1 L365.7,338.6 L368.2,337.6 L374.2,331.8 L378.3,330.7 L379.1,330.2 L396.9,330.1 L399.4,328.3 L399.5,326.4 L402.3,326.2 L404.3,330.0 L408.9,333.7 L409.8,337.8 L414.1,338.4 L419.5,335.5 L426.5,333.8 L431.7,336.7 L434.8,335.3 L436.5,332.8 L439.0,331.5 L446.8,332.5 L447.8,334.8 L447.9,337.9 L453.9,338.1 L455.0,335.7 L457.2,335.7 Z">
          </path>

          <path class="map-highlight" fill="#3D7C9D" stroke="#fff" stroke-width="1" id="uz_su"
            d="M439.9,410.4 L441.2,409.5 L442.7,404.0 L447.7,398.9 L450.3,393.4 L454.6,391.5 L459.7,386.9 L460.6,381.6 L464.0,376.7 L467.8,374.1 L470.1,369.1 L472.1,367.7 L476.0,369.2 L477.1,365.4 L476.8,361.6 L474.8,356.1 L475.6,354.3 L481.3,352.6 L482.0,353.3 L488.6,353.8 L492.9,352.1 L495.9,353.1 L498.6,352.2 L502.2,357.7 L502.7,360.0 L500.6,362.7 L498.4,363.3 L499.0,366.0 L497.5,368.6 L498.4,371.5 L498.7,376.9 L500.2,379.1 L500.8,382.4 L504.8,387.4 L511.3,392.0 L512.8,395.7 L511.4,401.9 L508.7,408.1 L503.4,410.5 L501.9,416.1 L497.9,423.2 L493.6,428.4 L492.0,431.7 L490.9,437.3 L492.2,443.8 L490.8,450.1 L490.0,448.4 L484.3,446.9 L480.6,448.3 L479.6,446.1 L477.7,445.9 L474.0,449.2 L469.3,451.1 L467.4,451.0 L466.0,448.3 L462.3,446.4 L461.0,443.3 L457.0,441.1 L451.0,442.2 L445.4,442.7 L443.7,443.8 L439.1,442.7 L436.2,443.0 L435.1,441.2 L437.1,438.3 L434.7,434.5 L435.6,429.0 L435.3,420.5 L440.4,411.5 Z">
          </path>

          <style>
            path:hover {
              cursor: pointer;
              fill: #d01a20;
            }
          </style>
        </svg>
      </div>
      <div class="col-md-4">
        <select id="myselect" class="form-control form-control-sm">
          <option value="uz_tk" selected="selected">@lang('blog.svgmap_default_select')</option>
          <option value="uz_an">@lang('blog.uz_an')</option>
          <option value="uz_na">@lang('blog.uz_na')</option>
          <option value="uz_fa">@lang('blog.uz_fa')</option>
          <option value="uz_ta">@lang('blog.uz_ta')</option>
          <option value="uz_si">@lang('blog.uz_si')</option>
          <option value="uz_ji">@lang('blog.uz_ji')</option>
          <option value="uz_sa">@lang('blog.uz_sa')</option>
          <option value="uz_qa">@lang('blog.uz_qa')</option>
          <option value="uz_su">@lang('blog.uz_su')</option>
          <option value="uz_bu">@lang('blog.uz_bu')</option>
          <option value="uz_nv">@lang('blog.uz_nv')</option>
          <option value="uz_xo">@lang('blog.uz_xo')</option>
          <option value="uz_qo">@lang('blog.uz_qo')</option>
        </select>
        <br />
        <div style="background-color: #fff; padding: 20px;">
          <p>@lang('blog.svgmap_manager'):</p>
          <h4 id="name"></h4>
          <p>@lang('blog.svgmap_phone'):</p>
          <h4 id="phone"></h4>
          <p>@lang('blog.svgmap_email'):</p>
          <h4 id="email"></h4>
        </div>
      </div>
      <div class="col-sm-1 hidden-sm hidden-xs"></div>
    </div>
  </div>
  @show

  @section('poleznaya-info')
  <!--foydali havolalar-->
  <div id="useful-links" class="container-fluid" style="background-color: #1873B7">
    <div class="row"><br />
      <div class="container text-center">
        <div class="col-sm-4 hidden-xs">
          <hr />
        </div>
        <div class="col-sm-4">
          <h3>@lang('blog.links')</h3>
        </div>
        <div class="col-sm-4 hidden-xs">
          <hr />
        </div>
      </div>
      <div class="container">
        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" style="margin-top: -23px;" href="#tab-1">Давлат органлари</a></li>
          <li><a data-toggle="tab" href="#tab-2">Ҳокимликлар</a></li>
          <li><a data-toggle="tab" href="#tab-3">Агро-саноат</a></li>
          <li><a data-toggle="tab" href="#tab-4">Молиявий</a></li>
          <li><a data-toggle="tab" href="#tab-5">Ахборот</a></li>
          <li><a data-toggle="tab" href="#tab-6">Олий таълим муассасалари</a></li>
        </ul>
      </div>
      <div class="tab-content container-fluid">
        <div id="tab-1" class="tab-pane fade in active">
          <div id="myCarousel1" class="carousel slide" data-ride="carousel" data-interval="0"><br />
            <div class="carousel-inner">
              <div class="item active container">
                <div class="row" style="margin-bottom: 15px">
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://press-service.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/4b672ff4319b3af87bb4ccbb4eb13a0a.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Ўзбекистон Республикаси Президентининг Матбуот хизмати <a
                              href="http://press-service.uz"><i>http://press-service.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://gov.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/ed491e092adbe6ee3415266ef5fd1f43.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Ўзбекистон Республикасининг Ҳукумат портали <a
                              href="http://gov.uz"><i>http://gov.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://parliament.gov.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/ac647d11476a0a672d0b71979511f83c.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Ўзбекистон Республикаси Олий Мажлиси Қонунчилик палатаси <a
                              href="http://parliament.gov.uz"><i>http://parliament.gov.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://senat.gov.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/321c9e15d092eefbc937ee31aac4b5e9.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Ўзбекистон Республикаси Олий Мажлисининг Сенати <a
                              href="http://senat.gov.uz"><i>http://senat.gov.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://mfa.uz" target="_blank"><img class="img-circle"
                              src="{{URL('/images/ab0b014bf588d43f5990253d105dead0.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Ўзбекистон Республикаси Ташқи ишлар вазирлиги <a
                              href="http://mfa.uz"><i>http://mfa.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://mfer.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/79149419336731cfcf652e5f0de970b5.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Ўзбекистон Республикаси Ташқи иқтисодий алоқалар вазирлиги <a
                              href="http://mfer.uz"><i>http://mfer.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://mineconomy.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/777a93ff01da92d3bba4d6336bf17250.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Ўзбекистон Республикаси Иқтисодиёт вазирлиги <a
                              href="http://mineconomy.uz"><i>http://mineconomy.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://mf.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/6d8252b7d8812814c780142f39a3a6ef.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Ўзбекистон Республикаси Молия вазирлиги <a href="http://mf.uz"><i>http://mf.uz</i></a>
                          </h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                </div>
              </div>
              <div class="item container">
                <div class="row" style="margin-bottom: 15px">
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://soliq.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/b5af77c13874cc738ec3769065ac6fb9.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Ўзбекистон Республикаси Давлат солиқ қўмитаси <a
                              href="http://soliq.uz"><i>http://soliq.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://my.gov.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/21f4a2839aa609b522f317db7f1b4598.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Ягона интерактив давлат хизматлари портали <a
                              href="http://my.gov.uz"><i>http://my.gov.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://minjust.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/16755169f85499570f948c472dfa4f8a.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Ўзбекистон Республикаси Адлия вазирлиги <a
                              href="http://minjust.uz"><i>http://minjust.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://fvv.uz/" target="_blank"><img class="img-circle"
                              src="{{URL('images/314ba204201f5f2f45dd620cdbaba293.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Ўзбекистон Республикаси Фавқулодда вазиятлар вазирлиги <a
                              href="http://fvv.uz/"><i>http://fvv.uz/</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                </div><!-- .row -->
                <div class="row">
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="www.gis.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/05d891941204b74cc928bc62d913a534.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Алоқа, ахборотлаштириш ва телекоммуникация технологиялари соҳасида назорат бўйича давлат
                            инспекцияси <a href="www.gis.uz"><i>www.gis.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://strategy.gov.uz/uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/a2db4b2182c8611e223b953e90944ea2.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>2017-2021 йилларда Ўзбекистон Республикасини ривожлантиришнинг ҳаракатлар стратегияси <a
                              href="http://strategy.gov.uz/uz"><i>http://strategy.gov.uz/uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://customs.uz/" target="_blank"><img class="img-circle"
                              src="{{URL('images/9c6c0b3d78653979d70d1adb49f11910.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Ўзбекистон Республикаси Давлат божхона қўмитаси <a
                              href="http://customs.uz/"><i>http://customs.uz/</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://stat.uz/" target="_blank"><img class="img-circle"
                              src="{{URL('images/ef1d28619337deaa2ccb5d8556ae614f.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Ўзбекистон Республикаси Давлат статистика қўмитаси <a
                              href="http://stat.uz/"><i>http://stat.uz/</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                </div><!-- .row -->
              </div>
              <div class="item container">
                <div class="row" style="margin-bottom: 15px">
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://uznature.uz/" target="_blank"><img class="img-circle"
                              src="{{URL('images/aa7ed273f3c4f3353134c89a20ac5084.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Ўзбекистон Республикаси Табиатни муҳофаза қилиш давлат қўмитаси <a
                              href="http://uznature.uz/"><i>http://uznature.uz/</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://davarx.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/8690d5e184d221df37a2d63679b682b5.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Ўзбекистон Республикаси Давлат архитектура ва қурилиш қўмитаси <a
                              href="http://davarx.uz"><i>http://davarx.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://www.mehnat.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/1842e6dbc134e5e7ad6b5af28b68605b.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Ўзбекистон Республикаси Бандлик ва меҳнат муносабатлари вазирлиги <a
                              href="http://www.mehnat.uz"><i>http://www.mehnat.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->

                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://reestr.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/fe6084ee0a2165599633b4e5d9915d8f.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Давлат ахборотга оид манбаъларни ва ахборотга оид тизимларини давлат идоралар Рўйхати <a
                              href="http://reestr.uz"><i>http://reestr.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                </div><!-- .row -->
              </div>
            </div>
            <a class="left carousel-control" href="#myCarousel1" data-slide="prev" style="width: 10%">
              <span class="glyphicon glyphicon-menu-left" style="color: #fff; top:45%;"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel1" data-slide="next" style="width: 10%">
              <span class="glyphicon glyphicon-menu-right" style="color: #fff; top:45%;"></span>
              <span class="sr-only">Next</span>
            </a><br />
          </div><!-- #myCarousel1 -->
        </div>
        <div id="tab-2" class="tab-pane fade">
          <div id="myCarousel2" class="carousel slide" data-ride="carousel" data-interval="0"><br />
            <div class="carousel-inner">
              <div class="item active container">
                <div class="row" style="margin-bottom: 15px">
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://sovminrk.gov.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/6029693faa7cd8087951e7a372b3fa34.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Қорақалпоғистон Республикаси Вазирлар Кенгаши <a
                              href="http://sovminrk.gov.uz"><i>http://sovminrk.gov.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://andijan.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/1beab5420fbb29bc7ff7c6d153ad531c.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Андижон вилоят ҳокимлиги <a href="http://andijan.uz"><i>http://andijan.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://buxoro.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/e3a01b421f227a9e726d64f85eeee232.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Бухоро вилоят ҳокимлиги <a href="http://buxoro.uz"><i>http://buxoro.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://jizzax.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/7c546762422513cab8ea379e6d6fb933.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Жиззах вилоят ҳокимлиги <a href="http://jizzax.uz"><i>http://jizzax.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://qashqadaryo.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/753a353e1a57aa54cae56249ecfffc61.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Хокимият Кашкадарьинской области <a
                              href="http://qashqadaryo.uz"><i>http://qashqadaryo.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://navoi.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/6cc73af8ca031caf2d2f2c235bc8f3ef.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Навойи вилоят ҳокимлиги <a href="http://navoi.uz"><i>http://navoi.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://namangan.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/c7c2621e2dece1ce1c10ec8716e3f9c1.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Наманган вилоят ҳокимлиги <a href="http://namangan.uz"><i>http://namangan.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://samarkand.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/c20e51ce18fd89e9f6fd449bdb9e3068.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Самарқанд вилоят ҳокимлиги <a href="http://samarkand.uz"><i>http://samarkand.uz</i></a>
                          </h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                </div>
              </div>
              <div class="item container">
                <div class="row" style="margin-bottom: 15px">
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://soliq.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/904fe494618b894e422db509bcb6df85.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Сурхондарё вилоят ҳокимлиги <a
                              href="http://surxondaryo.uz"><i>http://surxondaryo.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://sirdaryo.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/a53f2720644b643f1040d16db24680ec.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Сирдарё вилоят ҳокимлиги <a href="http://sirdaryo.uz"><i>http://sirdaryo.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://toshvil.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/522e8bbece9a5fd7724ae950ec0a4cae.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Тошкент вилоят ҳокимлиги <a href="http://toshvil.uz"><i>http://toshvil.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://ferghana.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/857c3216e3d8090167706d8f7f196dc4.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Фарғона вилоят ҳокимлиги <a href="http://ferghana.uz"><i>http://ferghana.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                </div><!-- .row -->
                <div class="row" style="margin-bottom: 15px">
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://xorazm.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/7a66b2e342f2d74afa83ce42e022efcc.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Хоразм вилоят ҳокимлиги <a href="http://xorazm.uz"><i>http://xorazm.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                </div><!-- .row -->
              </div>
            </div>
            <a class="left carousel-control" href="#myCarousel2" data-slide="prev" style="width: 10%">
              <span class="glyphicon glyphicon-menu-left" style="color: #fff; top:45%;"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel2" data-slide="next" style="width: 10%">
              <span class="glyphicon glyphicon-menu-right" style="color: #fff; top:45%;"></span>
              <span class="sr-only">Next</span>
            </a><br />
          </div><!-- #myCarousel2 -->
        </div>
        <div id="tab-3" class="tab-pane fade">
          <div id="myCarousel3" class="carousel slide" data-ride="carousel" data-interval="0"><br />
            <div class="carousel-inner">
              <div class="item active container">
                <div class="row" style="margin-bottom: 15px">
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://ygk.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/08a4dda8c9fd2e400fcca5b004c1355f.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Ўзбекистон Республикаси Ер ресурслари, геодезия, картография ва давлат кадастри давлат
                            қўмитаси <a href="http://ygk.uz"><i>http://ygk.uz</i></a></h6>
                        </div>
                      </div>
                    </div><!-- .col-sm-3 -->
                  </div>
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://uzgeolcom.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/c8ddd74d447b8a50772956a00fd52319.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Ўзбекистон Республикаси Давлат геология ва минерал ресурслар қўмитаси <a
                              href="http://uzgeolcom.uz"><i>http://uzgeolcom.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://uzdon.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/bbb1e6f5cab0c96eba7ebd8fa02f35de.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>"Ўздонмахсулот" АК <a href="http://uzdon.uz"><i>http://uzdon.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://meteo.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/f157b52cb560cc262b660758aebef394.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Гидрометеорология хизмат маркази <a href="http://meteo.uz"
                              target="_blank"><i>http://meteo.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://paxta.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/e850ca90aa73c1d4ef8885ab5c0c7ec3.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>"Ўзпахтасаноат" уюшмаси <a href="http://paxta.uz"
                              target="_blank"><i>http://paxta.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- .item -->
            </div><!-- .block-items -->
            <a class="left carousel-control" href="#myCarousel3" data-slide="prev" style="width: 10%">
              <span class="glyphicon glyphicon-menu-left" style="color: #fff; top:45%;"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel3" data-slide="next" style="width: 10%">
              <span class="glyphicon glyphicon-menu-right" style="color: #fff; top:45%;"></span>
              <span class="sr-only">Next</span>
            </a><br />
          </div>
        </div>
        <div id="tab-4" class="tab-pane fade">
          <div id="myCarousel4" class="carousel slide" data-ride="carousel" data-interval="0"><br />
            <div class="carousel-inner">
              <div class="item active container">
                <div class="row" style="margin-bottom: 15px">
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://qishloqqurilishbank.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/7f58414a1576f822e801b76711d36a14.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Кишлок курилиш банк <a href="http://qishloqqurilishbank.uz"
                              target="_blank"><i>http://qishloqqurilishbank.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://chamber.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/fba88b80796eddc35e2143e5d474433f.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Ўзбекистон савдо-саноат палатаси <a href="http://chamber.uz"
                              target="_blank"><i>http://chamber.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://agros.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/ef5a8e6a1251f24d630f1c90cf90cf18.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>“Ўзагросуғурта” ДАСК (АЖ) <a href="http://agros.uz"
                              target="_blank"><i>http://agros.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://agrobank.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/eb3711047e92157ecad6fae07cdfa310.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>«Agrobank» OATB <a href="http://agrobank.uz" target="_blank"><i>http://agrobank.uz</i></a>
                          </h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                </div><!-- .row -->
                <div class="row">
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://uzex.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/a581d534923dad6169c8ae2211b81120.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Ўзбекистон Республика товар хомашё биржаси <a href="http://uzex.uz"
                              target="_blank"><i>http://uzex.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                </div><!-- .row -->
              </div>
            </div><!-- .item -->
            <a class="left carousel-control" href="#myCarousel4" data-slide="prev" style="width: 10%">
              <span class="glyphicon glyphicon-menu-left" style="color: #fff; top:45%;"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel4" data-slide="next" style="width: 10%">
              <span class="glyphicon glyphicon-menu-right" style="color: #fff; top:45%;"></span>
              <span class="sr-only">Next</span>
            </a><br />
          </div><!-- .block-items -->
        </div>
        <div id="tab-5" class="tab-pane fade">
          <div id="myCarousel5" class="carousel slide" data-ride="carousel" data-interval="0"><br />
            <div class="carousel-inner">
              <div class="item active container">
                <div class="row" style="margin-bottom: 15px">
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://uza.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/f51ec7f74279bc148a69d8afbc2aab32.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Ўзбекистон Миллий ахборот агентлиги <a href="http://uza.uz"
                              target="_blank"><i>http://uza.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://uz24.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/8246257160f906c43f509075eced6f4f.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Uz24.uz Ўзбекистон матбуот ва ахборот агентлиги <a href="http://uz24.uz"
                              target="_blank"><i>http://uz24.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://uForum.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/b8d74c798382b6518f72e1f60af0f00f.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>uForum.uz <a href="http://uForum.uz" target="_blank"><i>http://uForum.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://id.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/9fbbd62ebde9e941341b2bf767a64b91.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>ID.UZ - ягона идентификация тизими <a href="http://id.uz"
                              target="_blank"><i>http://id.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://www.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/36bb68524343b475f74441d05c32647d.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Миллий Қидирув тизими <a href="http://www.uz" target="_blank"><i>http://www.uz</i></a>
                          </h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                </div><!-- .row -->
              </div>
            </div><!-- .item -->
            <a class="left carousel-control" href="#myCarousel5" data-slide="prev" style="width: 10%">
              <span class="glyphicon glyphicon-menu-left" style="color: #fff; top:45%;"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel5" data-slide="next" style="width: 10%">
              <span class="glyphicon glyphicon-menu-right" style="color: #fff; top:45%;"></span>
              <span class="sr-only">Next</span>
            </a><br />
          </div><!-- .block-items -->
        </div>
        <div id="tab-6" class="tab-pane fade">
          <div id="myCarousel6" class="carousel slide" data-ride="carousel" data-interval="0"><br />
            <div class="carousel-inner">
              <div class="item active container">
                <div class="row" style="margin-bottom: 15px">
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://samqxi.uz/index.php/uz/" target="_blank"><img class="img-circle"
                              src="{{URL('images/6c32962fb5d0b26f19c6587ec6b2ab01.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Самарқанд қишлоқ хўжалиги институти <a href="http://samqxi.uz/index.php/uz/"
                              target="_blank"><i>samqxi.uz/index.php/uz/</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://andqxi.uz/uz/" target="_blank"><img class="img-circle"
                              src="{{URL('images/8ff7093135951aaf45f36e179413b595.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Андижон қишлоқ хўжалиги институти <a href="http://andqxi.uz/uz/"
                              target="_blank"><i>http://andqxi.uz/uz/</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://tiimbf.uz/" target="_blank"><img class="img-circle"
                              src="{{URL('images/40548d7da007511c08ee422c8f4f7ab6.jpg')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Тошкент ирригация ва мелиорация институти Бухоро филиали <a href="http://tiimbf.uz/"
                              target="_blank"><i>http://tiimbf.uz/</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://agrar.uz/nukus-branch" target="_blank"><img class="img-circle"
                              src="{{URL('images/8b21530c59c10ce02b3dffd72cacac09.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Тошкент давлат аграр университети Нукус филиали <a href="http://agrar.uz/nukus-branch"
                              target="_blank"><i>http://agrar.uz/nukus-branch</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                </div><!-- .row -->
                <div class="row" style="margin-bottom: 15px">
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://tiim.uz/" target="_blank"><img class="img-circle"
                              src="{{URL('images/8d5670675ef6f2ee2726615077ee7657.jpg')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Тошкент ирригация ва мелиорация институти <a href="http://tiim.uz/"
                              target="_blank"><i>http://tiim.uz/</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://agrar.uz/" target="_blank"><img class="img-circle"
                              src="{{URL('images/186fe6a17c9a6f13212e4a40ba5e36ec.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Тошкент давлат аграр университети <a href="http://agrar.uz/"
                              target="_blank"><i>http://agrar.uz/</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://academy.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/b2a3bbcb9a4da3d7b5a9d9a430fa91f1.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>Ўзбекистон Республикаси фанлар академияси <a href="http://academy.uz"
                              target="_blank"><i>http://academy.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://natlib.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/2d22a4e1edcc2fac5e028e76c7c2d9a1.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>А. Навоий номидаги Ўзбекистон миллий кутубхонаси <a href="http://natlib.uz"
                              target="_blank"><i>http://natlib.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                </div><!-- .row -->
              </div>
              <div class="item container">
                <div class="row">
                  <div class="col-sm-3">
                    <div class="well-sm col-sm-12">
                      <div class="media">
                        <div class="media-left">
                          <a href="http://ziyonet.uz" target="_blank"><img class="img-circle"
                              src="{{URL('images/229ff45be340a1941e0cdddd64bb3ac4.png')}}" alt="" width="67"
                              height="67"></a>
                        </div>
                        <div class="media-body">
                          <h6>ZiyoNet <a href="http://ziyonet.uz" target="_blank"><i>http://ziyonet.uz</i></a></h6>
                        </div>
                      </div>
                    </div>
                  </div><!-- .col-sm-3 -->
                </div><!-- .row -->
              </div>
            </div><!-- .item -->
            <a class="left carousel-control" href="#myCarousel6" data-slide="prev" style="width: 10%">
              <span class="glyphicon glyphicon-menu-left" style="color: #fff; top:45%;"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel6" data-slide="next" style="width: 10%">
              <span class="glyphicon glyphicon-menu-right" style="color: #fff; top:45%;"></span>
              <span class="sr-only">Next</span>
            </a><br />
          </div><!-- .block-items -->
        </div>
      </div>
    </div>
  </div>
  @show

  @section('footer')
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-sm-6 col-xs-12">
            <h3><a href="#">@lang('blog.callback')</a></h3>
            <div class="item">
              <b>@lang('blog.ishonch_tel')</b>: <br />(71) 202-47-00<br />
              <br />
              <b>@lang('blog.devonxona_tel')</b>: <br />(71) 237-09-26<br />
              <br />
              <b>@lang('blog.fax')</b>:<br />(71) 237-09-26<br />
              <br />
              <b>@lang('blog.contact_email')</b>:<br />mwr@minwater.uz<br />
              <br />
              <b>@lang('blog.ministry_address')</b>: @lang('blog.ministry_address_text')

            </div><!-- .item -->
          </div>
          <div class="col-md-4 col-sm-6 col-xs-12">
            <h3><a href="#">@lang('blog.map_point')</a></h3>
            <div class="text-center">
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2996.357490631375!2d69.29338711492503!3d41.32283910795801!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38aef4ceea33d96b%3A0x38cfc38a75f4c3a8!2sTashkent+Institute+of+Irrigation+and+Agricultural+Mechanization+Engineers!5e0!3m2!1sen!2s!4v1543275622132"
                style="border: 0; width: 100%; height: 250px;" allowfullscreen></iframe>
            </div>
          </div>
          <div class="col-md-4 col-sm-6  col-xs-12">
            <h3><a href="#">@lang('blog.obuna')</a></h3>
            <p>@lang('blog.email_send')</p><br />
            @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif
            @if(session()->has('message'))
            <div class="alert alert-success">
              <p>Мурожаатингиз қабул қилинди</p>
            </div>
            @endif
            <form class="form-horizontal" action="{{URL('/obuna')}}" method="post">
              {{csrf_field()}}
              <div class="form-group col-xs-12">
                <input type="email" class="form-control" id="exampleInputEmail2" name="email"
                  placeholder="@lang('blog.email_push')">
              </div>
              <div class="form-group col-xs-12">
                <button type="submit" class="btn btn-primary btn-block"
                  style="padding-top: 10px; padding-bottom: 10px">@lang('blog.obuna_bulish')</button>
              </div>
            </form>

          </div>

        </div>

      </div><!-- .container -->
    </div><br /><!-- .footer-top -->
    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <div class="col-xs-8">
            <!---<div class="bottom-menu">
                <h6>
                  <a href="/uz/information/terms/">Сайт маълумотларидан фойдаланиш шарти</a>
                  <span> | </span>
                  <a href="#">Қидириш</a>
                  <span> | </span>
                  <a href="#">Cайт харитаси</a>
                  <span> | </span>
                  <a href="#">Корпоратив почта</a>
                  <span> | </span>
                  <a href="#">Почта</a>
                </h6>
              </div>-->
            <div class="row">
              <div class="col-md-6">
                <div class="send-error hidden-xs">
                  <a href="//orphus.ru" id="orphus" target="_blank" title="Система Orphus"><img alt="Система Orphus"
                      src="/images/orphus.gif" border="0" width="240" height="48"></a>
                  <h6>@lang('blog.error')</h6>
                </div>

              </div>
              <div class="col-md-6">
                <div class="row center-block">
                  <div>
                    <?php $date=date_create($last) ?>
                    <p><span class="lastmodify">@lang('blog.last_update') {{date_format($date,"d.m.Y")}} y. |
                        {{date_format($date,"H:i")}}</span></p>
                  </div>
                  <div>
                    <p>@lang('blog.online'): {{$numberOfGuests + $numberOfUsers}} киши</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-xs-3">
            <div class="row text-right">
              <div class="col-xs-12">
                <a href="http://kibera.uz" title="Kibera">@lang('blog.creator'): <img
                    src="{{URL('images/logo-kibera.png')}}" title="kibera.uz" alt="kibera.uz" width="95"
                    height="30"></a><br /><br />
                <span class="counters">
                  <a href="http://my.gov.uz"><img src="{{URL('images/mygovuz.jpg')}}" width="88" height="31"
                      title="Единый портал интерактивных государственных услуг" alt="My.gov.uz"></a>
                  <a href="/uz/PKM_675/"><img src="{{URL('images/pkm.png')}}" width="88" height="31"
                      title="ПКМ №675 от 31.12.2013 г." alt="ПКМ №675 от 31.12.2013 г."></a>
                  <a id="bxid_363847" target="_top" href="http://www.uz/rus/toprating/cmd/stat/id/14779"><img
                      id="bxid_80137" width="88" src="{{URL('images/counter.png')}}" alt="Топ рейтинг www.uz"></a>
                </span>
              </div>
            </div>
          </div>
        </div><!-- .row -->
      </div><!-- .container -->
    </div><!-- .footer-bottom -->
    <br />
    <div class="container-fluid text-center" style="background-color: #063E78">
      <h6>© 2018 - <script>
          document.write(new Date().getFullYear());
        </script> | @lang('blog.company_name')</h6>
    </div>
  </footer>
  @show
  <script type="text/javascript" src="{{URL('js/orphus.js')}}"></script>
  <script>
    var app = new Vue({
        el:'#app',
        data:{
          isChecked:false,

        },
        methods:{
          readCookie:function (name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for(var i=0;i < ca.length;i++) {
              var c = ca[i];
              while (c.charAt(0)==' ') c = c.substring(1,c.length);
              if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
            }
            return null;

          },
          check:function () {
            if(this.readCookie('voce') == 'off')
            {
              this.isChecked = false;
            }
            else
            {
              this.isChecked = true;
            }

          }


        },
        created(){
         console.log(this.readCookie('voice'));
        }
      });

  </script>
</body>

</html>

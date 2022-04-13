<!DOCTYPE html>
<html lang="uz">

<head>
  <title>@lang('blog.company_name')</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="{{ URL('bootstrap/css/bootstrap.min.css') }}" />
  <script src="{{URL('js/jquery.min.js')}}"></script>
  <script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ URL::asset('main.js') }}"></script>
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
        <a href="/" id="normalversion" data-set="normalversion" title="Полная версия сайта">Сайтни тўлиқ нусхаси</a>
      </div>
    </div> <!-- .special-settings-wrapper -->
    <div class="clr"></div>
  </div>

  @section('header')
  <header id="header">
    <div class="container">
      <div class="header-panel">
        <div class="row">
          <div class="col-sm-8 col-xs-6">
            <a href="/" class="btn mobile-link hidden-sm btn-open-adaptive hidden-xs hidden-sm"><span
                class="glyphicon glyphicon-phone"></span><span class="hidden-xs">@lang('blog.mobile_version')</span></a>
            <button class="specialversion btn"><span class="glyphicon glyphicon-eye-open"></span><span
                class="hidden-xs hidden-sm">@lang('blog.blind')</span></button>
            <a href="#" class="btn sitemap-link"><span class="glyphicon glyphicon-globe"></span><span
                class="hidden-xs hidden-sm"> @lang('blog.map')</span></a>
          </div>
          <div class="col-sm-4 col-xs-6 text-right">
            <div class="lang-menu">
              @section('lan')
              <a href="/home" class="btn auth-link"><span class="glyphicon glyphicon-log-in"></span><span
                  class="hidden-xs hidden-sm">@lang('blog.enter')</span></a>
              @foreach($languages->get() as $key=>$language)
              @if(App::getLocale() == $language->language_prefix)
              <a href="{{URL('/locale/'.$language->language_prefix)}}" class="btn lang selected"><span
                  class="hidden-xs">{{$language->language_name}}</span><span
                  class="visible-xs">{{$language->language_prefix}}</span></a>
              @else
              <a href="{{URL('/locale/'.$language->language_prefix)}}" class="btn lang "><span
                  class="hidden-xs">{{$language->language_name}}</span><span
                  class="visible-xs">{{$language->language_prefix}}</span></a>
              @endif
              @endforeach
              @show
            </div>
          </div>
        </div>
      </div>

      <div class="row hidden-xs">
        <div class="col-sm-3 col-md-2">
          <a href="{{URL('/')}}"><img src="{{URL('images/flag_gerb_uz.png')}}" alt="" class="img-responsive"
              width="190"></a>
        </div>
        <div class="col-sm-6 site-name">
          <h2><a href="{{URL('/')}}" title="ЎзРес Сув хўжалиги вазирлиги">@lang('blog.company_name')</a></h2>
        </div>
      </div>
      <div class="col-xs-4"><a href="/">
          <img src="{{URL('/images/logo.png')}}" alt="" class="" width="100%"></a>
      </div>
    </div>
    <div class="row visible-xs">
      <div class="col-xs-4"><a href="/">
          <img src="{{URL('images/flag_gerb_uz.png')}}" alt="" class="" width="100%"></a>
      </div>
      <div class="col-xs-8" style="padding-top: 10px">
        <div class="site-name">
          <h5><a href="{{URL('/')}}">@lang('blog.company_name')</a></h5>
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



  <div class="first-layer" style="background-color: white">
    @section('content')
    <div class="container-fluid" id="main-content">

      <div class="container">





      </div>


    </div>
    @show
  </div>



  @section('footer')
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-sm-6 col-xs-12">
            <h3><a href="#">@lang('blog.callback')</a></h3>
            <div class="item">
              <b>Ишонч телефонлари</b>:<br />(+998 71) 999-99-99; (+998 71) 999-99-99<br />
              <b>Канцелярия</b>: <br />(+998 71) 999-99-99; (+998 71) 999-99-99<br />
              <b>Факс</b>:<br />(+998 71) 999-99-99<br />
              <b>Манзил</b>: 100140, Тошкент вилояти, Қибрай тумани, Университет кўчаси, 2-уй
            </div><!-- .item -->
          </div>
          <div class="col-md-4 col-sm-6 col-xs-12">
            <h3><a href="#">@lang('blog.map_point')</a></h3>
            <div class="text-center">
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2996.357490631375!2d69.29338711492503!3d41.32283910795801!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38aef4ceea33d96b%3A0x38cfc38a75f4c3a8!2sTashkent+Institute+of+Irrigation+and+Agricultural+Mechanization+Engineers!5e0!3m2!1sen!2s!4v1543275622132"
                style="border: 0; width: 100%; height: auto;" allowfullscreen></iframe>
            </div>
          </div>
          <div class="col-md-4 col-sm-6  col-xs-12">
            <h3><a href="#">@lang('blog.obuna')</a></h3>
            <p>@lang('blog.email_send')</p><br />
            <form class="form-horizontal">
              <div class="form-group col-xs-12">
                <input type="email" class="form-control" id="exampleInputEmail2" placeholder="@lang('blog.email_push')">
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
            <div class="bottom-menu">
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
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="send-error hidden-xs">
                  <h6>@lang('blog.error')</h6>
                </div>
                <span class="counters">
                  <a href="http://my.gov.uz"><img src="{{URL('images/mygovuz.jpg')}}" width="88" height="31"
                      title="Единый портал интерактивных государственных услуг" alt="My.gov.uz"></a>
                  <a href="/uz/PKM_675/"><img src="{{URL('images/pkm.png')}}" width="88" height="31"
                      title="ПКМ №675 от 31.12.2013 г." alt="ПКМ №675 от 31.12.2013 г."></a>
                  <a id="bxid_363847" target="_top" href="http://www.uz/rus/toprating/cmd/stat/id/14779"><img
                      id="bxid_80137" width="88" src="{{URL('images/counter.png')}}" alt="Топ рейтинг www.uz"></a>
                </span>
              </div>
              <div class="col-md-6">
                <div class="row center-block">
                  <div>
                    <p><span class="lastmodify">@lang('blog.last_update') 02.10.2018 y. | 16:00</span></p>
                  </div>
                  <div>
                    <p>@lang('blog.online'): 56 киши</p>
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
</body>

</html>

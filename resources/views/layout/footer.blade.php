<?php $translate_footer = DB::table("translate")->where("type","=","footer")->orderByDesc("id")->first();
if($translate_footer)
{
    $jsonf =json_decode($translate_footer->jsons);
  //  dd($jsonf);
}
$language_id = $languages->where('status', '1')->where("language_prefix", app()->getLocale())->first()->id;
?>
<footer id="footer">
  <div class="footer-top">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
          <h3><a href="#">@lang('blog.callback')</a></h3>
          <div class="item">
            <b>@lang('blog.ishonch_tel')</b>: <br />{{ $jsonf->telephone }}<br />
            <br />
            <b>@lang('blog.devonxona_tel')</b>: <br />{{ $jsonf->devonxona }}<br />
            <br />
            <b>@lang('blog.fax')</b>:<br />{{ $jsonf->fax }}<br />
            <br />
            <b>@lang('blog.contact_email')</b>:<br />{{ $jsonf->email }}<br />
            <br />
            <b>@lang('blog.ministry_address')</b>: {{ $jsonf->manzil[$language_id-1] }}
            <br><br>
            <a href="https://www.facebook.com/suvxujaligivazirligi" target="_blank" title="Facebook"><img
                src="/social/facebook.png" width="30px" style="margin:5px"></a>
            <a href="https://t.me/TGminwater" target="_blank" title="Telegram"><img src="/social/telegram.png"
                width="40px" style="margin:5px"></a>
            <a href="http://instagram.com/" target="_blank" title="Instagram"><img src="/social/instagram.png"
                width="30px" style="margin:5px"></a>
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
          <p>{{ $jsonf->obuna[$language_id-1] }}</p><br />
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

          <div class="row">
            <div class="col-md-6">
              <div class="send-error hidden-xs">

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
                  <p>@lang('blog.online'): {{$numberOfGuests + $numberOfUsers}}</p>
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
                <!--<a id="bxid_363847" target="_top" href="http://www.uz/rus/toprating/cmd/stat/id/14779"><img id="bxid_80137" width="88" src="{{URL('images/counter.png')}}" alt="Топ рейтинг www.uz"></a>-->
                <!-- START WWW.UZ TOP-RATING -->
                <SCRIPT language="javascript" type="text/javascript">
                  <!--
                  top_js="1.0";top_r="id=43202&r="+escape(document.referrer)+"&pg="+escape(window.location.href);document.cookie="smart_top=1; path=/"; top_r+="&c="+(document.cookie?"Y":"N")
//
                  -->
                </SCRIPT>
                <SCRIPT language="javascript1.1" type="text/javascript">
                  <!--
                  top_js="1.1";top_r+="&j="+(navigator.javaEnabled()?"Y":"N")
//
                  -->
                </SCRIPT>
                <SCRIPT language="javascript1.2" type="text/javascript">
                  <!--
                  top_js="1.2";top_r+="&wh="+screen.width+'x'+screen.height+"&px="+
(((navigator.appName.substring(0,3)=="Mic"))?screen.colorDepth:screen.pixelDepth)
//
                  -->
                </SCRIPT>
                <SCRIPT language="javascript1.3" type="text/javascript">
                  <!--
                  top_js="1.3";
//
                  -->
                </SCRIPT>
                <SCRIPT language="JavaScript" type="text/javascript">
                  <!--
                  top_rat="&col=133E43&t=ffffff&p=E6850F";top_r+="&js="+top_js+"";document.write('<a href="http://www.uz/ru/res/visitor/index?id=43202" target=_top><img src="http://cnt0.www.uz/counter/collect?'+top_r+top_rat+'" width=88 height=31 border=0 alt="Топ рейтинг www.uz"></a>')//
                  -->
                </SCRIPT><NOSCRIPT><A href="http://www.uz/ru/res/visitor/index?id=43202" target=_top><IMG height=31
                      src="http://cnt0.www.uz/counter/collect?id=43202&pg=http%3A//uzinfocom.uz&&col=133E43&amp;t=ffffff&amp;p=E6850F"
                      width=88 border=0 alt="Топ рейтинг www.uz"></A></NOSCRIPT><!-- FINISH WWW.UZ TOP-RATING -->
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

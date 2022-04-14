<div class="info-block" id="weather">
    <div class="col-xs-12 info-header">
        <h4 class="text-center">@lang('blog.weather')</h4>
    </div>
    <div class="col-xs-12 info-content force-margin">
        <br>
        <p class="pull-right"><span>@lang('blog.weather_title')</span></p>
        <div class="">
            <select id="" class="form-control form-control-sm" v-model="cur_city" @change="getvalue()">

                <!-- ngRepeat: city in cities -->
                <option  value="andijan"  style="">@lang('blog.uz_and')</option><!-- end ngRepeat: city in cities -->
                <option  value="bukhara" >@lang('blog.uz_bux')</option><!-- end ngRepeat: city in cities -->
                <option  value="gulistan" >@lang('blog.uz_gul')</option><!-- end ngRepeat: city in cities -->
                <option  value="jizzakh" >@lang('blog.uz_jiz')</option><!-- end ngRepeat: city in cities -->
                <option  value="kamchik" >@lang('blog.uz_kam')</option><!-- end ngRepeat: city in cities -->
                <option  value="qarshi" >@lang('blog.uz_kar')</option><!-- end ngRepeat: city in cities -->
                <option  value="navoiy" >@lang('blog.uz_nav')</option><!-- end ngRepeat: city in cities -->
                <option  value="namangan" >@lang('blog.uz_nam')</option><!-- end ngRepeat: city in cities -->
                <option  value="nukus" >@lang('blog.uz_nuk')</option><!-- end ngRepeat: city in cities -->
                <option  value="nurafshon" >@lang('blog.uz_nur')</option><!-- end ngRepeat: city in cities -->
                <option value="samarkand" >@lang('blog.uz_sam')</option><!-- end ngRepeat: city in cities -->
                <option  value="tashkent"  >@lang('blog.uz_tas')</option><!-- end ngRepeat: city in cities -->
                <option  value="termez" >@lang('blog.uz_ter')</option><!-- end ngRepeat: city in cities -->
                <option value="urgench" >@lang('blog.uz_urg')</option><!-- end ngRepeat: city in cities -->
                <option value="fergana" >@lang('blog.uz_fer')</option><!-- end ngRepeat: city in cities -->
                <option  value="chimgan" >@lang('blog.uz_chi')</option><!-- end ngRepeat: city in cities -->
            </select>
        </div>
        <div class="clearfix"></div>

        <div class="row" style="padding-top: 15px">
            <div class="col-xs-4">
                <img style="filter: none!important;" :src="'http://www.meteo.uz/img/weather-icons/wi_'+weather_icon+'_'+day_party+'.png'" alt="" width="50">
            </div>
            <div class="col-xs-8">
                <p style="font-size: 17pt;">@{{ weather_min }}...+@{{ weather_max }} &#186;С</p>
                <!--<p>переменная облачность</p>-->
            </div>
        </div>
        <div class="row">
            <div class="col-xs-4">
                <img src="{{ URL('images/039-wind-2.svg') }}" alt="" width="50">
            </div>
            <div class="col-xs-8">
                <p style="font-size: 17pt;padding-top: 10px">@{{ weather_wind_min }}-@{{ weather_wind_max }} м/с</p>
            </div>
        </div><br>
        <a href="http://meteo.uz/">@lang('blog.source'): @lang('blog.weather-source')</a>
    </div>


</div>


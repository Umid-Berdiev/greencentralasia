<?php

$all =DB::table('translate')->where('type',"=","kurs")->orderByDesc("id")->first();
;

?>
<div class="info-block" id="kurs">
    <div class="col-xs-12 info-header">
        <h4 class="text-center">@lang('blog.curse')</h4>
    </div>
    <div class="col-xs-12 info-content force-margin">
        <br>
        <div class="text-center">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>@lang('blog.currency-code')</th>
                        <th>@lang('blog.currency-rate')</th>
                        <th>@lang('blog.currency-diff')</th>
                    </tr>
                </thead>
                <tbody>
                    {{--                @foreach(json_decode($all->jsons) as $key=>$value)--}}


                    {{--                <tr>--}}
                    {{--                    <td>{!! $value->Ccy !!}</td>--}}
                    {{--                    <td>{!! $value->Rate !!}</td>--}}
                    {{--                    <td>{!! $value->Diff !!}</td>--}}

                    {{--                </tr>--}}
                    {{--                    @if($key == 3)--}}
                    {{--                        @break--}}
                    {{--                        @endif--}}
                    {{--                    @endforeach--}}

                </tbody>
            </table>
            <a href="http://cbu.uz/ru/arkhiv-kursov-valyut/">@lang('blog.source'): @lang('blog.currency-source')</a>
        </div>
    </div>
</div>
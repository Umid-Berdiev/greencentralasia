<?php
$translate = DB::table("translate")->where("type","=","contact")->orderByDesc("id")->first();

$json =json_decode($translate->jsons);
$language_id = $languages->where('status', 1)->where("language_prefix", app()->currentLocale())->first();
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
            <li><a href="{{URL(App::getLocale().'/')}}" title="{{ __('blog.bosh') }}">{{ __('blog.bosh') }}</a></li>
          </ol>
        </div>
      </div>

      <div class="page-header row">
        <div class="col-md-9">
          <h4><b>{{ $json->title[$language_id-1] }}</b></h4>
        </div>
        <div class="col-md-3 hidden-xs hidden-sm" style="padding-top: 11px;">
          <a class="page-print-link" style="cursor:pointer;" target="_self"><span
              class="glyphicon glyphicon-print"></span> {{ __('blog.print_button') }}</a>
        </div>
      </div>
      <div class="container-fluid" id="print_all">
        <h4 style="text-align: justify">{{ $json->description[$language_id-1] }}</h4><br />
        <div class="table-responsive">
          <table class="table table-bordered" style="max-width: 750px;">
            <thead>
              <tr class="info">
                <th width="150">{{ $json->rahbar[$language_id-1] }}</th>
                <th width="150">{{ $json->lavozim[$language_id-1] }}</th>
                <th width="200">{{ $json->kun[$language_id-1] }}</th>
                <th width="100">{{ $json->soat[$language_id-1] }}</th>
              </tr>
            </thead>
            <tbody>
              @if(isset($json->tb_one_uz))
              @foreach($json->tb_one_uz as $key=>$val)
              <tr>
                @if($language_id-1==0)
                <td>{!! $json->tb_one_uz[$key] ?? null !!}</td>
                <td>{!! $json->tb_two_uz[$key] ?? null !!}</td>
                <td>{!! $json->tb_three_uz[$key] ?? null !!}</td>
                <td>{!! $json->tb_four_uz[$key] ?? null !!}</td>
                @elseif($language_id-1==1)
                <td>{!! $json->tb_one_ru[$key] ?? null !!}</td>
                <td>{!! $json->tb_two_ru[$key] ?? null !!}</td>
                <td>{!! $json->tb_three_ru[$key] ?? null !!}</td>
                <td>{!! $json->tb_four_ru[$key] ?? null !!}</td>
                @elseif($language_id-1==2)
                <td>{!! $json->tb_one_en[$key] ?? null!!}</td>
                <td>{!! $json->tb_two_en[$key] ?? null !!}</td>
                <td>{!! $json->tb_three_en[$key] ?? null !!}</td>
                <td>{!! $json->tb_four_en[$key] ?? null !!}</td>
                @endif
              </tr>
              @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
      <div class="container-fluid text-left">
        <div class="row" style="border-bottom: 1px solid blue">
          <h4><b>{{ $json->map_target[$language_id-1] }}</b></h4>
        </div>
        <div class="row">
          <div class="col-sm-6"><br />
            <img class="img-responsive" src="{{URL('images/googlemaps_july2016.jpg')}}" alt="" />
          </div>
          <div class="col-sm-6">
            <div class="text-center">
              <h4>{{ $json->bottom_title[$language_id-1] }}</h4>
            </div><br />
            @if($language_id-1==0)
            <div class="row">
              <div class="col-xs-2">
                <img class="img-responsive" src="{{URL('images/loca.png')}}" alt="" />
              </div>
              <div class="col-xs-10">
                <p>{!! $json->bottom_table_tb_one_uz[0] !!}</p>
              </div>
            </div><br />
            <div class="row">
              <div class="col-xs-2">
                <img class="img-responsive" src="{{URL('images/phone_icon.png')}}" alt="" />
              </div>
              <div class="col-xs-10">
                <p>{!! $json->bottom_table_tb_two_uz[0] !!}<br>
                  {!! $json->bottom_table_tb_three_uz[0] !!}</p>
              </div>
            </div><br />
            <div class="row">
              <div class="col-xs-2">
                <img class="img-responsive" src="{{URL('images/bus__654365.png')}}" alt="" />
              </div>
              <div class="col-xs-10">
                <p>{!! $json->bottom_table_tb_four_uz[0] !!}</p>
              </div>
            </div>
            @elseif($language_id-1==1)

            <div class="row">
              <div class="col-xs-2">
                <img class="img-responsive" src="{{URL('images/loca.png')}}" alt="" />
              </div>
              <div class="col-xs-10">
                <p>{!! $json->bottom_table_tb_one_ru[0] !!}</p>
              </div>
            </div><br />
            <div class="row">
              <div class="col-xs-2">
                <img class="img-responsive" src="{{URL('images/phone_icon.png')}}" alt="" />
              </div>
              <div class="col-xs-10">
                <p>{!! $json->bottom_table_tb_two_ru[0] !!}<br>
                  {!! $json->bottom_table_tb_three_ru[0] !!}</p>
              </div>
            </div><br />
            <div class="row">
              <div class="col-xs-2">
                <img class="img-responsive" src="{{URL('images/bus__654365.png')}}" alt="" />
              </div>
              <div class="col-xs-10">
                <p>{!! $json->bottom_table_tb_four_ru[0] !!}</p>
              </div>
            </div>
            @elseif($language_id-1==2)

            <div class="row">
              <div class="col-xs-2">
                <img class="img-responsive" src="{{URL('images/loca.png')}}" alt="" />
              </div>
              <div class="col-xs-10">
                <p>{!! $json->bottom_table_tb_one_en[0] !!}}</p>
              </div>
            </div><br />
            <div class="row">
              <div class="col-xs-2">
                <img class="img-responsive" src="{{URL('images/phone_icon.png')}}" alt="" />
              </div>
              <div class="col-xs-10">
                <p>{!! $json->bottom_table_tb_two_en[0] !!}<br>
                  {!! $json->bottom_table_tb_three_en[0] !!}</p>
              </div>
            </div><br />
            <div class="row">
              <div class="col-xs-2">
                <img class="img-responsive" src="{{URL('images/bus__654365.png')}}" alt="" />
              </div>
              <div class="col-xs-10">
                <p>{!! $json->bottom_table_tb_four_en[0] !!}</p>
              </div>
            </div>
            @endif

          </div>
        </div>
      </div><br />
      <div class="container-fluid text-left">
        <div class="row" style="border-bottom: 1px solid blue">
          <h4><b>{{ __('blog.feedback') }}</b></h4>
        </div><br />
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
          <p>{{ session()->get('message') }}</p>
        </div>
        @endif
        <form action="{{URL('/contact_post')}}" method="post">
          {{csrf_field()}}
          <div class="form-group">
            <label for="">{{ __('blog.full_name') }}<span class="fio">*</span>:</label>
            <input type="text" value="" name="fio" title="" placeholder="{{ __('blog.full_name_placeholder') }}"
              class="form-control" id="">
          </div>
          <div class="form-group">
            <label for="">{{ __('blog.email') }} <span class="required">*</span>:</label>
            <input type="email" value="" name="email" title="" placeholder="{{ __('blog.email_placeholder') }}"
              class="form-control" id="">
          </div>
          <div class="form-group">
            <label for="">{{ __('blog.message_text') }}<span class="required">*</span>:</label>
            <textarea resize="no" name="comment" cols="25" rows="5" title=""
              placeholder="{{ __('blog.message_text_placeholder') }}" class="form-control textarea" id=""></textarea>
          </div>
          <!--<div class="form-group">
                                <label for="">Расмдаги кодни киритинг</label><br>
                                <img src="images/captcha.jpg" width="150" height="40" style="border: 1px solid #dcdcdc;" class="captcha-image" alt="CAPTCHA" id="">&nbsp;
                                <a href="#" class="" title="">Расмни ўзгартириш</a>
                                <input type="text" name="captcha_word" class="form-control" value="" maxlength="5">
                                <br>
                            </div>-->
          <div class="form-group">
            <input type="submit" class="btn btn-primary" value="{{ __('blog.form_btn_send') }}">
          </div>
          <div class="alert alert-warning">
            <span class="required">*</span>{{ __('blog.required_fields_note') }}
          </div>

        </form>
      </div>

      @endsection

      @section('statistika')
      @endsection
    </div>
    @section('nav_page')
    <div class="col-md-3" style="padding-top: 50px;">
      <div class="col menu-item-structure">

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

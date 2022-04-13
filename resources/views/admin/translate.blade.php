<?php

$values =  config('contact');
$translate = DB::table("translate")->where("type","=","contact")->orderByDesc("id")->first();
$translate_footer = DB::table("translate")->where("type","=","footer")->orderByDesc("id")->first();
$translate_svg = DB::table("translate")->where("type","=","svg")->orderByDesc("id")->first();

$json =json_decode($translate->jsons);

if($translate_footer) {
  $jsonf =json_decode($translate_footer->jsons);
}

if($translate_svg) {
  $jsons =json_decode($translate_svg->jsons);

  $ars =  json_decode(json_encode($jsons),true);

  $myar = [
    $ars[0]["uz_tk"],
    $ars[1]["uz_an"],
    $ars[2]["uz_na"],
    $ars[3]["uz_fa"],
    $ars[4]["uz_ta"],
    $ars[5]["uz_si"],
    $ars[6]["uz_ji"],
    $ars[7]["uz_sa"],
    $ars[8]["uz_qa"],
    $ars[9]["uz_su"],
    $ars[10]["uz_bu"],
    $ars[11]["uz_nv"],
    $ars[12]["uz_xo"],
    $ars[13]["uz_qo"]
  ];
}
?>

@extends("admin.layouts.admin-layout")

@section("content")

<div class="col-md-12" style="background-color: white;padding: 25px;">

  <ul class="nav nav-pills">
    <li class="active">
      <a href="#1a" data-toggle="tab">Contact</a>
    </li>
    <li><a href="#2a" data-toggle="tab">Footer</a>
    </li>

    <li><a href="#3a" data-toggle="tab">Свг карта</a>
    </li>

  </ul>

  <div class="tab-content clearfix">
    <div class="tab-pane active" id="1a">
      <form method="post" action="{{ URL('/admin/translate') }}">
        @csrf
        <div class="row">
          <h3> TITLE</h3>
          @foreach($languages->get() as $key=>$value)
          <input class="hidden" name="language_ids[]" value="{{ $value->id }}">
          <div class="col-md-3">
            <div class="form-group">
              <h4>{{ $value->language_prefix }}</h4>
              <input class="form-control" name="titles[]" value="{{ $json->title[$key] }}">

            </div>
          </div>
          @endforeach
        </div>

        <div class="row">
          <h3>Description</h3>
          @foreach($languages->get() as $key=>$value)
          <div class="col-md-3">
            <div class="form-group">
              <h4>{{ $value->language_prefix }}</h4>
              <input class="form-control" name="descriptions[]" value="{{ $json->description[$key] }}">

            </div>
          </div>
          @endforeach
        </div>
        <div class="row" id="tables">
          <h3>Table</h3>
          @foreach($languages->get() as $value)

          <div class="col-md-4" id="{{ $value->id }}x">


            <div class="form-group">

              <h4>{{ $value->language_prefix }}</h4>



              @switch($value->language_prefix)

              @case("uz")
              @foreach($json->tb_one_uz as $key=>$val)

              <div style="margin: 40px;" id="{{ $value->id }}{{$key}}x">
                <input class="form-control" name="tb_one_{{ $value->language_prefix }}[]"
                  value="{!! $json->tb_one_uz[$key] !!}">
                <input class="form-control" name="tb_two_{{ $value->language_prefix }}[]"
                  value="{!! $json->tb_two_uz[$key] !!}">
                <input class="form-control" name="tb_three_{{ $value->language_prefix }}[]"
                  value="{!! $json->tb_three_uz[$key] !!}">
                <input class="form-control" name="tb_four_{{ $value->language_prefix }}[]"
                  value="{!! $json->tb_four_uz[$key] !!}">
              </div>
              @endforeach
              @break

              @case("ru")
              @foreach($json->tb_one_ru as $key=>$val)

              <div style="margin: 40px;" id="{{ $value->id }}{{$key}}x">
                <input class="form-control" name="tb_one_{{ $value->language_prefix }}[]"
                  value="{!! $json->tb_one_ru[$key] !!}">
                <input class="form-control" name="tb_two_{{ $value->language_prefix }}[]"
                  value="{!! $json->tb_two_ru[$key] !!}">
                <input class="form-control" name="tb_three_{{ $value->language_prefix }}[]"
                  value="{!!$json->tb_three_ru[$key] !!}">
                <input class="form-control" name="tb_four_{{ $value->language_prefix }}[]"
                  value="{!! $json->tb_four_ru[$key] !!}">
              </div>
              @endforeach
              @break

              @case("en")
              @foreach($json->tb_one_en as $key=>$val)
              <div style="margin: 40px;" id="{{ $value->id }}{{$key}}x">
                <input class="form-control" name="tb_one_{{ $value->language_prefix }}[]"
                  value="{!! $json->tb_one_en[$key] !!}">
                <input class="form-control" name="tb_two_{{ $value->language_prefix }}[]"
                  value="{!! $json->tb_two_en[$key] !!}">
                <input class="form-control" name="tb_three_{{ $value->language_prefix }}[]"
                  value="{!! $json->tb_three_en[$key] !!}">
                <span><input class="form-control" name="tb_four_{{ $value->language_prefix }}[]"
                    value="{!! $json->tb_four_en[$key] !!}"></span>


              </div>
              <a href="#" onclick="remove_id('{{$key}}x')" class="btn btn-danger"
                style="position: absolute;right: 0;margin-top: -190px;"><i class="fa fa-remove"></i></a>


              @endforeach
              @break

              @endswitch


            </div>



          </div>
          @endforeach


        </div>
        <button type="button" onclick="clickmeadd()" class="btn btn-success"><i class="fa fa-plus"></i></button>


        <div class="row">
          <h3> MAP TARGET</h3>
          @foreach($languages->get() as $key=>$value)

          <div class="col-md-3">
            <div class="form-group">
              <h4>{{ $value->language_prefix }}</h4>
              <input class="form-control" name="map_target[]" value="{{ $json->map_target[$key] }}">

            </div>
          </div>
          @endforeach
        </div>

        <div class="row">
          <h3> BOTTOM TITLE</h3>
          @foreach($languages->get() as $key=>$value)

          <div class="col-md-3">
            <div class="form-group">
              <h4>{{ $value->language_prefix }}</h4>
              <input class="form-control" name="bottom_title[]" value="{{ $json->bottom_title[$key] }}">

            </div>
          </div>
          @endforeach
        </div>

        <div class="row">
          <h3>Bottom table</h3>
          @foreach($languages->get() as $key=>$value)
          <div class="col-md-3">
            <div class="form-group">
              <h4>{{ $value->language_prefix }}</h4>
              <?php $tabs = $values['contact_'.$value->language_prefix]['bottom_table']; ?>

              @switch($value->language_prefix)

              @case("uz")
              <input class="form-control" name="bottom_table_tb_one_{{ $value->language_prefix  }}[]"
                value="{!! $json->bottom_table_tb_one_uz[0] !!}">
              <input class="form-control" name="bottom_table_tb_two_{{ $value->language_prefix  }}[]"
                value="{!! $json->bottom_table_tb_two_uz[0] !!}">
              <input class="form-control" name="bottom_table_tb_three_{{ $value->language_prefix  }}[]"
                value="{!! $json->bottom_table_tb_three_uz[0] !!}">
              <input class="form-control" name="bottom_table_tb_four_{{ $value->language_prefix  }}[]"
                value="{!! $json->bottom_table_tb_four_uz[0] !!}">

              @break
              @case("ru")
              <input class="form-control" name="bottom_table_tb_one_{{ $value->language_prefix  }}[]"
                value="{!! $json->bottom_table_tb_one_ru[0] !!}">
              <input class="form-control" name="bottom_table_tb_two_{{ $value->language_prefix  }}[]"
                value="{!! $json->bottom_table_tb_two_ru[0] !!}">
              <input class="form-control" name="bottom_table_tb_three_{{ $value->language_prefix  }}[]"
                value="{!! $json->bottom_table_tb_three_ru[0] !!}">
              <input class="form-control" name="bottom_table_tb_four_{{ $value->language_prefix  }}[]"
                value="{!! $json->bottom_table_tb_four_ru[0] !!}">
              @break
              @case("en")
              <input class="form-control" name="bottom_table_tb_one_{{ $value->language_prefix  }}[]"
                value="{!! $json->bottom_table_tb_one_en[0] !!}">
              <input class="form-control" name="bottom_table_tb_two_{{ $value->language_prefix  }}[]"
                value="{!! $json->bottom_table_tb_two_en[0] !!}">
              <input class="form-control" name="bottom_table_tb_three_{{ $value->language_prefix  }}[]"
                value="{!! $json->bottom_table_tb_three_en[0] !!}">
              <input class="form-control" name="bottom_table_tb_four_{{ $value->language_prefix  }}[]"
                value="{!! $json->bottom_table_tb_four_en[0] !!}">

              @break



              @endswitch
            </div>
          </div>
          @endforeach
        </div>

        <div class="row">
          <h3>Rahbar</h3>
          @foreach($languages->get() as $key=>$value)

          <div class="col-md-3">
            <div class="form-group">
              <h4>{{ $value->language_prefix }}</h4>
              <input class="form-control" name="rahbar[]" value="{{ $json->rahbar[$key] }}">

            </div>
          </div>
          @endforeach
        </div>

        <div class="row">
          <h3>Lavozim</h3>
          @foreach($languages->get() as $key=>$value)

          <div class="col-md-3">
            <div class="form-group">
              <h4>{{ $value->language_prefix }}</h4>
              <input class="form-control" name="lavozim[]" value="{{ $json->lavozim[$key] }}">

            </div>
          </div>
          @endforeach
        </div>

        <div class="row">
          <h3>Kun</h3>
          @foreach($languages->get() as $key=>$value)

          <div class="col-md-3">
            <div class="form-group">
              <h4>{{ $value->language_prefix }}</h4>
              <input class="form-control" name="kun[]" value="{{ $json->kun[$key] }}">

            </div>
          </div>
          @endforeach
        </div>

        <div class="row">
          <h3>Soat</h3>
          @foreach($languages->get() as $key=>$value)

          <div class="col-md-3">
            <div class="form-group">
              <h4>{{ $value->language_prefix }}</h4>
              <input class="form-control" name="soat[]" value="{{ $json->soat[$key] }}">

            </div>
          </div>
          @endforeach
        </div>

        <button class="btn btn-success" type="submit">save</button>
      </form>
    </div>
    <div class="tab-pane" id="2a">
      <form method="post" action="{{ URL('/admin/translate_footer') }}">
        @csrf
        <div class="row">
          <h3>Ишонч телефони: </h3>


          <div class="col-md-3">
            <div class="form-group">

              <input class="form-control" name="telephone" value="{{ $jsonf->telephone ?? ""}}">

            </div>
          </div>

        </div>

        <div class="row">
          <h3>Девонхона: </h3>


          <div class="col-md-3">
            <div class="form-group">

              <input class="form-control" name="devonxona" value="{{ $jsonf->devonxona ?? ""}}">

            </div>
          </div>

        </div>
        <div class="row">
          <h3>Факс: </h3>


          <div class="col-md-3">
            <div class="form-group">

              <input class="form-control" name="fax" value="{{ $jsonf->fax ?? ""}}">

            </div>
          </div>

        </div>
        <div class="row">
          <h3>Email: </h3>


          <div class="col-md-3">
            <div class="form-group">

              <input class="form-control" name="email" value="{{ $jsonf->email ?? ""}}">

            </div>
          </div>

        </div>
        <div class="row">
          <h3>Манзил: </h3>

          @foreach($languages->get() as $key=>$value)
          <div class="col-md-3">
            <div class="form-group">
              <h4>{{ $value->language_prefix }}</h4>
              <input class="form-control" name="manzil[]" value="{{ $jsonf->manzil[$key] ?? "" }}"
                placeholder="{{ $value->language_prefix }}">

            </div>
          </div>
          @endforeach

        </div>
        <div class="row">
          <h3>Обуна: </h3>

          @foreach($languages->get() as $key=>$value)
          <div class="col-md-3">
            <div class="form-group">
              <h4>{{ $value->language_prefix }}</h4>
              <input class="form-control" name="obuna[]" value="{{ $jsonf->obuna[$key] ?? ""}}"
                placeholder="{{ $value->language_prefix }}">

            </div>
          </div>
          @endforeach

        </div>


        <button class="btn btn-success" type="submit">save</button>
      </form>
    </div>
    <div class="tab-pane" id="3a">

      <?php
                    $countries = [
                        ['Тошкент шахри','uz_tk'],
                        ['Андижон вилояти','uz_an'],
                        ['Наманган вилояти','uz_na'],
                        ['Фарғона вилояти','uz_fa'],
                        ['Тошкент вилояти','uz_ta'],
                        ['Сирдарё вилояти','uz_si'],
                        ['Жиззах вилояти','uz_ji'],
                        ['Самарқанд вилояти','uz_sa'],
                        ['[Қашқадарё вилояти','uz_qa'],
                        ['Сурхондарё вилояти','uz_su'],
                        ['Бухоро вилояти','uz_bu'],
                        ['Навоий вилояти','uz_nv'],
                        ['Хоразм вилояти','uz_xo'],
                        ['Қорақалпоғистон','uz_qo'],
                    ];
                    ?>
      <form method="post" action="{{ URL('/admin/translate_svg') }}">
        @csrf
        <div class="row">
          @foreach($countries as $key=>$value)
          <h3>{{ $value[0] }}</h3>
          <input class="hidden" name="code[]" value="{{ $value[1] }}">
          <div class="col-md-12">
            <div class="form-group">

              <input class="form-control" name="telefon[]" value="{{ $myar[$key][" telefon"] ?? "" }}"
                placeholder="Телефон">

            </div>

            <div class="form-group">
              @foreach($languages->get() as $value)

              <input class="form-control" name="rahbar_{{ $value->language_prefix }}[]" value="{{ $myar[$key]["
                rahbar_".$value->language_prefix] ?? "" }}" placeholder="Рахбар">
              @endforeach

            </div>

            <div class="form-group">

              <input class="form-control" name="email[]" value="{{ $myar[$key][" email"] ?? "" }}" placeholder="Почта">

            </div>
          </div>
          @endforeach
        </div>

        <button class="btn btn-success" type="submit">save</button>
      </form>
    </div>

  </div>

</div>

<script>
  function clickmeadd() {
            @foreach($languages->get() as $value)
            $("#tables").append('<div class="col-md-4"> <div class="form-group" > <div style="margin: 40px;"> <input class="form-control" name="tb_one_{{ $value->language_prefix }}[]" value=""> <input class="form-control" name="tb_two_{{ $value->language_prefix }}[]" value=""> <input class="form-control" name="tb_three_{{ $value->language_prefix }}[]" value=""> <input class="form-control" name="tb_four_{{ $value->language_prefix }}[]" value=""></div> </div> </div>');
        @endforeach
        }
        function remove_id(str) {

            console.log(str);
            $("#1"+str).remove();
            $("#2"+str).remove();
            $("#3"+str).remove();

        }
</script>

@endsection

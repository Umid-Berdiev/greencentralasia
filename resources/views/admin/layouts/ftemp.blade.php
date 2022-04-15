<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
  <title>BOOKS (QRBOOK.UZ)</title>

  <!-- BEGIN META -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="keywords" content="your,keywords">
  <meta name="description" content="All book in qrcode">
  <!-- END META -->

  <!-- BEGIN STYLESHEETS -->

  <link rel="stylesheet" href="{{ URL::asset('frondend/css/font-awesome.min.css') }}">

  <link rel="stylesheet" href="{{ URL::asset('frondend/plugins/owl/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('frondend/plugins/starrr.css') }}">

  <link rel="stylesheet" href="{{ URL::asset('frondend/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('frondend/css/style.css') }}">



  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>

    <![endif]-->
</head>

<body>


  @include("admin.layouts.fmenu")
  <div class="wrapper">
    @include("admin.layouts.fheader")

    <div class="container">
      @section("content")
      @show
    </div>

    @include("admin.layouts.ffooter")
  </div>

  <script src="{{ URL::asset('frondend/js/jquery-2.2.3.min.js') }}"></script>
  <script src="{{ URL::asset('frondend/libs/bootstrap.min.js') }}"></script>
  <script src="{{ URL::asset('frondend/js/general.js') }}"></script>
  <script src="{{ URL::asset('frondend/qrcode.js') }}"></script>
  <script src="{{ URL::asset('frondend/plugins/starrr.js') }}"></script>
  <script src="{{ URL::asset('frondend/js/general.js') }}"></script>
  <script src="{{ URL::asset('frondend/js/common.js') }}"></script>
  <script src="{{ URL::asset('frondend/js/star-settings.js') }}"></script>

  <script type="text/javascript">
    @if(isset($typs))
    new QRCode(document.getElementById("qrcode"), {
        text: "{{ URL(App::getLocale()."/download?id=".$book->id ?? 0) }}",
        width: 128,
        height: 128,
        colorDark : "#000000",
        colorLight : "#ffffff",
        correctLevel : QRCode.CorrectLevel.H
    });
    @endif
  </script>
</body>

</html>

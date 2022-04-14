<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href="{{ asset('project_gca/css/bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('project_gca/font/stylesheet.css') }}" />
  <link rel="stylesheet" href="{{ asset('project_gca/css/datepicker.css') }}" />
  <link rel="stylesheet" href="{{ asset('project_gca/css/jquery.fancybox.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('project_gca/css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('project_gca/css/media.css') }}" />

  <!-- Link Custom CSS -->
  <link rel="stylesheet" href="{{ asset('css/custom.styles.css') }}" />

  <title>GCA</title>

  @stack('custom-css')
</head>

<body>
  <header>
    @include('gca.blocks.top-navbar')
    {{-- @include('gca.blocks.menu') --}}
    <x-partials.main-menu />
  </header>

  @yield('main_top_layout')
  @yield('content')
  @include('gca.blocks.footer')

  <script src="{{ asset('project_gca/js/jquery.min.js') }}"></script>
  <script src="{{ asset('project_gca/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('project_gca/js/bootstrap-datepicker.js') }}"></script>
  <script src="{{ asset('project_gca/js/jquery.fancybox.min.js') }}"></script>
  {{-- <script src="https://unpkg.com/swiper/swiper-bundle.js"></script> --}}

  @stack('scripts')
</body>

</html>

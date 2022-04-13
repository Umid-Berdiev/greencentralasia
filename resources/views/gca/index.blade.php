@extends('gca.layout')
{{-- @section('main_top_layout') --}}
@section('content')
    @include('partials.alerts')
    @include('gca.home-page.partners-section')
    @include('gca.home-page.main-slider')
    @include('gca.home-page.aboutus-section')
    @include('gca.home-page.news-section')
    @include('gca.home-page.wish-section')
    @include('gca.home-page.report-section')
    @include('gca.home-page.map-section')
   {{--  @include('gca.home-page.event-calendar') --}}
    @include('gca.home-page.media-section')
@endsection

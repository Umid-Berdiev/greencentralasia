@extends('gca.layouts.master')

@section('content')
@section('main_top_layout')
<section class="main_top_layout" style="background-image: url({{ asset('project_gca/images/main.jpg') }});">
  <div class="container">
    <h2>
      <span>@lang('blog.registration_info')</span>
    </h2>
  </div>
</section>
@endsection

<section class="contact_inner">
  <div class="container">
    <div class="row">
      <div class="col col-md-8 col-xl-6 mx-auto">
        <p>Deutsche Gesellschaft für Internationale Zusammenarbeit (GIZ) GmbH</p>
        @if (app()->currentLocale() === 'en')
        <div>
          <h4>Registered offices</h4>
          <p>Bonn and Eschborn<br />
            Germany</p>

          <p>Friedrich-Ebert-Allee 32 + 36<br />
            53113 Bonn<br />
            Germany<br />
            T +49 228 44 60-0<br />
            F +49 228 44 60-17 66</p>

          <p>Dag-Hammarskjöld-Weg 1 - 5<br />
            65760 Eschborn<br />
            Germany<br />
            T +49 61 96 79-0<br />
            F +49 61 96 79-11 15</p>

          <p>E info@giz.de<br />
            I www.giz.de</p>

          <h4>Registered at</h4>
          <p>Local court (Amtsgericht) Bonn, Germany: HRB 18384</p>
          <p>Local court (Amtsgericht) Frankfurt am Main, Germany: HRB 12394</p>

          <h4>VAT no.</h4>
          <p>DE 113891176</p>

          <h4>Chairperson of the Supervisory Board</h4>
          <p>Jochen Flasbarth, State Secretary in the Federal Ministry for Economic Cooperation and Development</p>

          <h4>Management Board</h4>
          <p>Tanja Gönner (Chair of the Management Board)<br />
            Ingrid-Gabriela Hoven<br />
            Thorsten Schäfer-Gümbel</p>
        </div>
        @else
        <div>
          <h4>Места нахождения общества</h4>
          <p>г. Бонн и г. Эшборн, Германия</p>

          <p>Friedrich-Ebert-Allee 32 + 36<br />
            53113 Bonn, Германия<br />
            Тел. +49 228 44 60-0<br />
            Факс +49 228 44 60-17 66</p>

          <p>Dag-Hammarskjöld-Weg 1 - 5<br />
            65760 Eschborn, Германия<br />
            Тел. +49 61 96 79-0<br />
            Факс +49 61 96 79-11 15</p>

          <p>E-mail info@giz.de<br />
            Интернет www.giz.de</p>

          <h4>Регистрационный суд:</h4>
          <p>участковый суд (Amtsgericht)<br />
            Бонн, Германия<br />
            Регистрационный номер: HRB 18384<br />
            участковый суд (Amtsgericht)<br />
            Франкфурт-на-Майне, Германия<br />
            Регистрационный номер: HRB 12394</p>

          <h4>Председатель Наблюдательного совета:</h4>
          <p>Йохен Фласбарт/ Jochen Flasbarth,<br />
            статс-секретарь</p>

          <h4>Правление</h4>
          <p>Таня Гённер/Tanja Gönner<br />
            (председатель правления)<br />
            Ингрид-Габриэла Ховен/ Ingrid-Gabriela Hoven<br />
            Торстен Шефер-Гюмбель/Thorsten Schäfer-Gümbel</p>
        </div>
        @endif
      </div>
    </div>
</section>

@endsection
@push('scripts')
<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
  function enable() {
    var btn = document.getElementById('btn')
    btn.disabled = false;
  }
</script>
@endpush

@if (session('success'))
<div class="alert small alert-success text-center mb-0">
  {{ session('success') }}
</div>
@endif

@if (session('warning'))
<div class="alert alert-warning small text-center mb-0 py-2">
  {{ session('warning') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger small text-center   mb-0 py-2 ">
  {{ session('error') }}
</div>
@endif
{{-- @dd($errors->all()) --}}
@if ($errors->any())
<div class="alert alert-danger small">
  <p>Ошибки:</p>
  @foreach ($errors->all() as $error)
  <p>{{ $error }}</p>
  @endforeach
</div>
@endif

{{-- @if (session()->has('failures'))
<div class="alert small alert-danger text-center mb-0">
  <p>Ошибки:</p>
  <ul class="list-group list-group-flush">
    @foreach (session()->get('failures') as $failure)
    @if ($failure->attribute() == 'year')
    <li class="list-group-item list-group-item-danger">
      {{'Ошибка в строке: ' . $failure->row() . ', в столбике: "' . $failure->attribute() . '"'}}<br>
Год должен быть минимум 1900 и максимум этот год
</li>
@elseif($failure->attribute() == 'cadaster_number')
<li class="list-group-item list-group-item-danger">
  {{'Ошибка в строке: ' . $failure->row() . ', в столбике: "' . $failure->attribute() . '"'}}<br>
  Проверте кадастрового номера свкажины
</li>
@endif
@endforeach
</ul>
</div>
@endif --}}
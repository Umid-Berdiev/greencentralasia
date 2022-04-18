@extends("admin.layouts.admin-layout")

@section('content')
<div class="col-md-12" style="background-color: white;padding: 25px;">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th></th>
        <th>
          ОНЛАЙН<br>
          (последний 3 мин)
        </th>
        <th>
          СЕГОДНЯ<br>
          {{ date('d.m.Y') }}
        </th>
        <th>
          ВЧЕРА<br>
          {{ date('d.m.Y', strtotime("-1 days")) }}
        </th>
        <th>
          НЕДЕЛЯ<br>
          {{ date('d.m', strtotime("-7 days")) . ' - ' . date('d.m') }}
        </th>
        <th>
          МЕСЯЦ<br>
          {{ date('M Y', strtotime("-1 month")) }}
        </th>
        <th>ВСЕГО</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><button type="button">?</button></td>
        <td>Посетители</td>
        <td>{{ $online_users }}</td>
        <td>{{ $today_users }}</td>
        <td>{{ $yesterday }}</td>
        <td>{{ $last_week }}</td>
        <td>{{ $last_month }}</td>
        <td>{{ $alltime_users }}</td>
      </tr>
    </tbody>
  </table>
</div>
@endsection

@extends("admin.layouts.admin-layout")

@section("content")

<div class="col-md-12" style="background-color: white;padding: 25px;">
  <div class="col-md-12">
    <div class="form-group">
      <p>
        <button type="button" class="btn ink-reaction btn-floating-action btn-lg btn-primary"
          onclick="window.location.href=\" {{ URL('/admin/years/create') }}\"">
          <i class="fa fa-plus"></i>
        </button>
      </p>
    </div>
    <table class="table table-condensed no-margin">
      <thead>
        <tr>
          <td width="80px">№</td>
          <td width="80px">img</td>
          <td width="80px"></td>
        </tr>
      </thead>
      <tbody>
        @foreach($years as $key => $year)
        <tr>
          <td>{{$key+1}}</td>
          <td> <img class="img-responsive" width="100"
              src="{{ URL(App::getLocale().'/downloads?type=years&id='.$year->id) }}"></td>
          <td>
            <span><a href="{{URL('/admin/years/edit?id='.$year->group)}}"><i class="fa fa-edit"></i></a></span>
            <span><a onclick="return confirm('Are you sure you want to delete this thing into the database?')"
                href="{{URL('/admin/years/delete?id='.$year->group)}}"><i class="fa fa-remove"></i></a></span>

          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{ $years->links() }}
  </div>
</div>

@endsection

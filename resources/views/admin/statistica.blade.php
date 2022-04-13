@extends("admin.layouts.admin-layout")

@section("content")

<div class="col-md-12" style="background-color: white;padding: 25px;">
  <div class="col-md-12">
    <div class="form-group">
      <p>
        <button type="button" class="btn ink-reaction btn-floating-action btn-lg btn-primary"
          onclick="window.location.href=\" {{ URL('/admin/statistica/create') }}\"">
          <i class="fa fa-plus"></i>
        </button>
      </p>
    </div>
    <table class="table table-condensed no-margin">
      <thead>
        <tr>
          <td width="80px">№</td>
          <td width="80px">name</td>
          <td width="80px">photo_url</td>
          <td width="80px"></td>
        </tr>
      </thead>
      <tbody>
        @foreach($statistica as $key => $stat)
        <tr>
          <td>{{$key+1}}</td>

          <td>{{$stat->name}}</td>
          <td><img class="img-responsive" width="100"
              src="{{URL(App::getLocale().'/downloads?type=statistica&id='.$stat->id)}}"></td>
          <td>
            <span><a onclick="return confirm('Are you sure you want to delete this thing into the database?')"
                href="{{URL('/admin/statistica/destroy?id='.$stat->group)}}"><i class="fa fa-remove"></i></a></span>

          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{ $statistica->links() }}
  </div>
</div>

@endsection

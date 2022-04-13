@extends("admin.layouts.admin-layout")

@section("content")

<div class="col-md-12" style="background-color: white;padding: 25px;">
  <div class="col-md-12">
    <div class="form-group">
      <p>
        <button type="button" class="btn ink-reaction btn-floating-action btn-lg btn-primary"
          onclick="window.location.href=\" {{ URL('/admin/sorov/create') }}\"">
          <i class="fa fa-plus"></i>
        </button>
      </p>
      <form action="{{ URL('admin/sorov') }}" method="get">
        <div class="input-group">
          <div class="input-group-content">
            <input type="text" class="form-control" name="search" placeholder="SEARCH" id="groupbutton9">
            <label for="groupbutton9"></label>
          </div>
          <div class="input-group-btn">
            <button class="btn btn-default" type="submit">Go!</button>
          </div>

        </div>
      </form>
    </div>
    <table class="table table-condensed no-margin">
      <thead>
        <tr>
          <td width="80px">№</td>
          <td width="80px">Savol</td>
          <td width="80px">Language</td>

          <td width="80px">JAVOB</td>
          <td width="80px"></td>
        </tr>
      </thead>
      <tbody>
        @foreach($table as $key => $page)
        <tr>
          <td>{{$key+1}}</td>

          <td>{{$page->savol}}</td>
          <td>{{$page->language_name}}</td>
          <td> <span><a href="{{URL('/admin/sorovatter/?id='.$page->id)}}"><i class="fa fa-list"></i></a></span></td>
          <td>
            <span><a href="{{URL('/admin/sorov/edit?id='.$page->group)}}"><i class="fa fa-edit"></i></a></span>
            <span><a onclick="return confirm('Are you sure you want to delete this thing into the database?')"
                href="{{URL('/admin/sorov/delete?id='.$page->group)}}"><i class="fa fa-remove"></i></a></span>

          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{ $table->links() }}
  </div>
</div>

@endsection

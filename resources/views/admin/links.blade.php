@extends("admin.layouts.admin-layout")

@section("content")

<div class="col-md-12" style="background-color: white;padding: 25px;">
  <div class="col-md-12">
    <div class="form-group">
      <p>
        <button type="button" class="btn ink-reaction btn-floating-action btn-lg btn-primary"
          onclick="window.location.href=\" {{ URL('/admin/links/create') }}\"">
          <i class="fa fa-plus"></i>
        </button>
      </p>

    </div>
    <table class="table table-condensed no-margin">
      <thead>
        <tr>
          <td width="80px">№</td>
          <td width="80px"></td>
          <td width="80px">title</td>
          <td width="80px">Categories</td>
          <td width="80px">Language</td>

          <td width="80px"></td>
        </tr>
      </thead>
      <tbody>
        @foreach($table as $key => $page)
        <tr>
          <td>{{$key+1}}</td>

          <td><img width="100" src="{{URL(App::getLocale().'/downloads?type=link&id='.$page->id) }}"></td>
          <td>{{$page->title}}</td>
          <td>{{$page->category_name}}</td>
          <td>{{$page->language_name}}</td>
          <td>
            <span><a href="{{URL('/admin/links/edit?id='.$page->group)}}"><i class="fa fa-edit"></i></a></span>
            <span><a onclick="return confirm('Are you sure you want to delete this thing into the database?')"
                href="{{URL('/admin/links/delete?id='.$page->group)}}"><i class="fa fa-remove"></i></a></span>

          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{ $table->links() }}
  </div>
</div>

@endsection

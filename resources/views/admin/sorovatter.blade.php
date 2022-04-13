@extends("admin.layouts.admin-layout")

@section("content")

<div class="col-md-12" style="background-color: white;padding: 25px;">
  <div class="col-md-12">
    savol:{{ $savol->savol }}
  </div>
  <div class="col-md-12">
    <div class="form-group">
      <form action="{{URL('admin/sorovatter')}}" method="get">
        <div class="input-group">
          <div class="input-group-content">
            <input type="text" class="form-control" name="search" placeholder="SEARCH" id="groupbutton9">
            <input type="hidden" class="form-control" name="id" value="{{ $savol->id }}">
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
          <td width="80px">Javob</td>
          <td width="80px">vote</td>

          <td width="80px"></td>
        </tr>
      </thead>
      <tbody>
        @foreach($table as $key => $page)
        <tr>
          <td>{{$key+1}}</td>

          <td>{{$page->javob}}</td>
          <td>{{$page->order}}</td>
          <td>
            <span><a href="{{URL('/admin/sorovatter/edit?id='.$page->group)}}"><i class="fa fa-edit"></i></a></span>
            <span><a onclick="confirm('are you sure delete?')"
                href="{{URL('/admin/sorovatter/delete?id='.$page->group)}}"><i class="fa fa-remove"></i></a></span>

          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{ $table->links() }}
  </div>


</div>

<div class="container">

  <div class="col-md-12">
    <div class="card-head">
      <ul class="nav nav-tabs" style="background-color: whitesmoke;" data-toggle="tabs">
        @foreach($languages->get() as $key =>$language)
        @if($key == 0)
        <li class="active"><a href="#{{$language->id}}">{{$language->language_name}}</a></li>
        @else
        <li><a href="#{{$language->id}}">{{$language->language_name}}</a></li>
        @endif

        @endforeach
      </ul>
    </div>
    <form class="form" role="form" enctype="multipart/form-data" method="post"
      action="{{ URL('/admin/sorovatter/insert') }}">
      @csrf
      <input type="hidden" name="savol_id" value="{{$savol->group}}">
      <div class="card-body tab-content" style="background-color: white">
        @foreach($languages->get() as $key =>$language)
        @if($key == 0)
        <div class="tab-pane active" id="{{$language->id}}">
          <div class="form" role="form">

            <input type="hidden" name="language_ids[]" value="{{$language->id}}">
            <div class="form-group floating-label">
              <input type="text" name="javob[]" class="form-control" value="-" required id="regular2">
              <label for="regular2">javob</label>
            </div>


          </div>
        </div>
        @else
        <div class="tab-pane" id="{{$language->id}}">
          <div class="form" role="form">

            <input type="hidden" name="language_ids[]" value="{{$language->id}}">
            <div class="form-group floating-label">
              <input type="text" name="javob[]" class="form-control" value="-" required id="regular2">
              <label for="regular2">javob</label>
            </div>
          </div>
        </div>
        @endif
        @endforeach
        <div class="card-actionbar-row">
          <button type="submit" class="btn btn-flat btn-primary ink-reaction">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

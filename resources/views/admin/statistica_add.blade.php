@extends("admin.layouts.admin-layout")

@section("content")

<div class="card-body" style="background-color: white">

  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
  <div class="col-md-12">
    <div class="card-head">
      <ul class="nav nav-tabs" data-toggle="tabs">
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
      action="{{ URL('/admin/statistica/store') }}">
      <div class="card-body tab-content">
        @csrf
        <div class="form-group floating-label">
          <input type="text" name="name" class="form-control" id="regular2">
          <label for="regular2">title</label>
        </div>
        @foreach($languages->get() as $key =>$language)
        @if($key == 0)
        <div class="tab-pane active" id="{{$language->id}}">
          <div class="form" role="form">
            <input type="hidden" name="language_ids[]" value="{{$language->id}}">
            <div class="form-group floating-label">
              <input type="file" name="cover[]" class="form-control" id="regular2">
              <label for="regular2"></label>
            </div>



          </div>
        </div>
        @else
        <div class="tab-pane" id="{{$language->id}}">
          <input type="hidden" name="language_ids[]" value="{{$language->id}}">
          <div class="form-group floating-label">
            <input type="file" name="cover[]" class="form-control" id="regular2">
            <label for="regular2"></label>
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
<!--end .table-responsive -->



@endsection

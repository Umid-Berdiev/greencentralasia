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
      action="{{ URL('/admin/links/categories/update') }}">
      <div class="card-body tab-content">
        @foreach($languages->get() as $key =>$language)
        @if($key == 0)
        @foreach($model as $val)

        @if($val->language_id ==$language->id)
        <div class="tab-pane active" id="{{$language->id}}">
          <div class="form" role="form">
            @csrf
            <input type="hidden" name="group" value="{{$val->group}}">
            <input type="hidden" name="language_ids[]" value="{{$language->id}}">
            <div class="form-group floating-label">
              <input type="text" name="category_names[]" value="{{$val->title}}" class="form-control" id="regular2">
              <label for="regular2">category_name</label>
            </div>


          </div>
        </div>
        @endif
        @endforeach
        @else
        @foreach($model as $val)

        @if($val->language_id ==$language->id)
        <div class="tab-pane" id="{{$language->id}}">
          <div class="form" role="form">
            @csrf
            <input type="hidden" name="group" value="{{$val->group}}">
            <input type="hidden" name="language_ids[]" value="{{$language->id}}">
            <div class="form-group floating-label">
              <input type="text" name="category_names[]" value="{{$val->title}}" class="form-control" id="regular2">
              <label for="regular2">category_name</label>
            </div>
          </div>
        </div>
        @endif
        @endforeach
        @endif
        @endforeach
        <div class="card-actionbar-row">
          <button type="submit" class="btn btn-flat btn-primary ink-reaction">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!--end .table-responsive -->

@endsection

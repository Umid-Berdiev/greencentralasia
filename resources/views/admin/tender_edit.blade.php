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
    <form class="form" role="form" enctype="multipart/form-data" method="post" action="{{ URL('/admin/tender/edit') }}">
      @csrf
      <input type="hidden" name="group" value="{{ $grp_id }}">
      <div class="card-body tab-content">
        @foreach($languages->get() as $key =>$language)
        @if($key == 0)

        @foreach($model as $val)

        @if($val->language_id ==$language->id)
        <div class="tab-pane active" id="{{$language->id}}">
          <div class="form" role="form">

            <input type="hidden" name="language_ids[]" value="{{$language->id}}">

            <div class="form-group floating-label">
              <select class="form-control" name="tender_category_id">
                @foreach($category as $value)
                @if($val->tender_category_id == $value->group)
                <option value="{{ $value->group }}" selected>{{ $value->category_name }}</option>
                @else
                <option value="{{ $value->group }}">{{ $value->category_name }}</option>
                @endif
                @endforeach
              </select>
              <label for="post_category_id">Tender category</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="titles[]" class="form-control" value="{{ $val->title }}" id="regular2">
              <label for="regular2">title</label>
            </div>
            <div class="form-group floating-label">
              <textarea name="descriptions[]" class="form-control" id="regular2">{{ $val->description }}</textarea>
              <label for="regular2">description</label>
            </div>

            <div class="form-group floating-label">
              <input type="date" name="deadline" class="form-control" value="{{ $val->deadline }}" id="regular2">
              <label for="regular2">deadline {{ $val->deadline }}</label>
            </div>


            <div class="form-group floating-label">
              <input type="checkbox" name="received" class="checkbox-styled" id="regular2">
              <label for="regular2">Held</label>
            </div>

            <div class="form-group floating-label">
              <input type="file" name="cover" class="form-control" id="regular2">
              <label for="regular2">cover</label>
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

            <input type="hidden" name="language_ids[]" value="{{$language->id}}">
            <div class="form-group floating-label">
              <input type="text" name="titles[]" class="form-control" value="{{ $val->title }}" id="regular2">
              <label for="regular2">title</label>
            </div>
            <div class="form-group floating-label">
              <textarea name="descriptions[]" class="form-control" id="regular2">{{ $val->description }}</textarea>

            </div>


          </div>
        </div>
        @endif
        @endforeach
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

@extends("admin.layouts.admin-layout")

@section("content")

<div class="container">
  <div class="row">
    <div class="col-auto ml-auto">
      @include('partials.alerts')
    </div>
  </div>
</div>

<div class="card-body" style="background-color: white">
  <div class="col-md-12">
    <div class="card-head">
      <ul class="nav nav-tabs" data-toggle="tabs">
        @foreach($languages->get() as $key =>$language)
        <li @if($key==0) class="active" @endif><a href="#{{$language->id}}">{{$language->language_name}}</a></li>
        @endforeach
      </ul>
    </div>
    <form class="form" role="form" enctype="multipart/form-data" method="post"
      action="{{ route('videoalbum.update', $grp_id) }}">
      @csrf
      @method('put')
      <div class="card-body tab-content">
        @foreach($languages->get() as $key =>$language)
        @if($key == 0)
        @foreach($model as $val)
        @if($val->language_id ==$language->id)
        <div class="tab-pane active" id="{{$language->id}}">
          <div class="form" role="form">
            <input type="hidden" name="language_ids[]" value="{{$language->id}}">
            <div class="form-group floating-label">
              <input type="text" name="titles[]" class="form-control" value="{{ $val->title }}" id="title">
              <label for="title">title</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="descriptions[]" class="form-control" value="{{ $val->Description }}" id="desc">
              <label for="desc">Description</label>
            </div>
            <div class="form-group floating-label">
              <label for="file" for="cover">Choose album cover</label>
              <input type="file" name="cover" class="form-control" id="cover">
              {{-- <input type="text" value="document.getElementById('cover').value"> --}}
            </div>
            @if ($val->cover && $val->cover != "null")
            <img src="{{ asset('storage/video-categories/' . $val->cover) }}" width="100px" />
            <input type="checkbox" name="remove_cover" id="remove-cover">
            <label for="remove-cover">Remove cover</label>
            @else <span>No image</span>
            @endif
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
              <input type="text" name="titles[]" class="form-control" value="{{ $val->title }}" id="title">
              <label for="title">title</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="descriptions[]" class="form-control" value="{{ $val->Description }}" id="desc">
              <label for="desc">description</label>
            </div>
          </div>
        </div>
        @endif
        @endforeach
        @endif
        @endforeach
        <div class="card-actionbar-row">
          <a href="{{ route('videoalbum.index') }}" class="btn btn-secondary">Back</a>
          <button type="submit" class="btn btn-primary ink-reaction">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!--end .table-responsive -->



@endsection

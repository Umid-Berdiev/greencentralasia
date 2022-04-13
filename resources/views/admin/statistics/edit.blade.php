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
      action="{{ route('statistics.update', $group_id) }}">
      @csrf
      @method('put')

      <input type="hidden" name="group" value="{{ $group_id }}">
      <div class="card-body tab-content">
        @foreach($languages->get() as $key => $language)
        @if($key == 0)
        @foreach($models as $val)
        @if($val->language_id == $language->id)
        <div class="tab-pane active" id="{{$language->id}}">
          <div class="form" role="form">
            <input type="hidden" name="language_ids[]" value="{{ $language->id }}">
            <div class="form-group floating-label">
              <input type="text" name="names[]" class="form-control" id="title" value="{{ $val->name }}">
              <label for="title">Title</label>
            </div>
          </div>

          <div class="form-group floating-label">
            <label for="cover">Cover</label>
            <input type="file" name="photo_url" class="form-control" id="cover">
          </div>
          @if ($val->photo_url && $val->photo_url != "null")
          <img src="{{ asset('storage/statistics/' . $val->photo_url) }}" width="100" />
          <input type="checkbox" name="remove_cover" id="remove-cover">
          <label for="remove-cover">Remove photo</label>
          @else <span>No image</span>
          @endif
        </div>
        @endif
        @endforeach
        @else
        @foreach($models as $val)
        @if($val->language_id == $language->id)
        <div class="tab-pane" id="{{ $language->id }}">
          <div class="form" role="form">
            <input type="hidden" name="language_ids[]" value="{{ $language->id }}">
            <div class="form-group floating-label">
              <input type="text" name="names[]" class="form-control" id="title" value="{{ $val->name }}">
              <label for="title">Title</label>
            </div>
          </div>
        </div>
        @endif
        @endforeach
        @endif
        @endforeach
        <div class="card-actionbar-row">
          <a href="{{ route('statistics.index') }}" class="btn btn-secondary">Back</a>
          <button type="submit" class="btn btn-primary ink-reaction">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

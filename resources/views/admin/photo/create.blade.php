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
        <li class="{{ $key==0 ? 'active' : ''}}"><a href="#{{$language->id}}">{{$language->language_name}}</a></li>
        @endforeach
      </ul>
    </div>
    <form class="form" role="form" enctype="multipart/form-data" method="post" action="{{ route(" photos.store") }}">
      @csrf
      <div class="card-body tab-content">
        <div class="form-group floating-label">
          <select class="form-control" name="category_id" id="category_id">
            @foreach($category as $value)
            <option value="{{ $value->group }}">{{ $value->title }}</option>
            @endforeach
          </select>
          <label for="category_id">Photo category</label>
        </div>
        @foreach($languages->get() as $key => $language)
        @if($key == 0)
        <div class="tab-pane active" id="{{$language->id}}">
          <div class="form" role="form">
            <input type="hidden" name="language_ids[]" value="{{$language->id}}">
            <div class="form-group floating-label">
              <input type="text" name="names[]" class="form-control" id="names">
              <label for="names">Name</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="descriptions[]" class="form-control" id="descriptions">
              <label for="descriptions">Description</label>
            </div>
            <div class="form-group floating-label">
              <label for="file">Cover</label>
              <input type="file" name="cover" class="form-control" id="cover">
            </div>
          </div>
        </div>
        @else
        <div class="tab-pane" id="{{$language->id}}">
          <div class="form" role="form">
            <input type="hidden" name="language_ids[]" value="{{$language->id}}">

            <div class="form-group floating-label">
              <input type="text" name="names[]" class="form-control" id="names">
              <label for="names">Name</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="descriptions[]" class="form-control" id="descriptions">
              <label for="descriptions">Description</label>
            </div>
          </div>
        </div>
        @endif
        @endforeach
        <div class="card-actionbar-row">
          <a href="{{ route('photos.index') }}" class="btn btn-secondary">Back</a>
          <button type="submit" class="btn btn-primary ink-reaction">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

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
    <form class="form" role="form" enctype="multipart/form-data" method="post" action="{{ route('posts.store') }}">
      @csrf
      <div class="card-body tab-content">
        @foreach($languages->get() as $key => $language)
        @if($key == 0)
        <div class="tab-pane active" id="{{$language->id}}">
          <div class="form" role="form">
            <input type="hidden" name="language_ids[]" value="{{$language->id}}">
            <div class="form-group floating-label">
              <input type="text" name="titles[]" class="form-control" id="regular2">
              <label for="regular2">Title</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="decriptions[]" class="form-control" id="regular2">
              <label for="regular2">Decription</label>
            </div>
            <div class="form-group floating-label">
              <textarea name="contents[]" class="form-control">Content</textarea>
            </div>
          </div>

          <div class="form-group floating-label">
            <select class="form-control" name="post_category_id">
              @foreach($category as $value)
              <option value="{{ $value->group }}">{{ $value->category_name }}</option>
              @endforeach
            </select>
            <label for="post_category_id">Post category</label>
          </div>
          <div class="form-group floating-label">
            <input type="datetime-local" name="datetime" class="form-control" id="regular2"
              value="{{ date('Y-m-d\TH:i') }}">
          </div>
          <div class="form-group floating-label">
            <label for="cover">Cover</label>
            <input type="file" name="cover" class="form-control" id="cover">
          </div>
          <div class="form-group floating-label">
            <select class="form-control" name="country_id" id="country">
              @foreach($gcainfo as $country)
              <option value="{{ $country->id }}">{{ $country->name }}</option>
              @endforeach
            </select>
            <label for="country">Country</label>
          </div>
        </div>
        @else
        <div class="tab-pane" id="{{$language->id}}">
          <div class="form" role="form">
            <input type="hidden" name="language_ids[]" value="{{$language->id}}">
            <div class="form-group floating-label">
              <input type="text" name="titles[]" class="form-control" id="regular2">
              <label for="regular2">Title</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="decriptions[]" class="form-control" id="regular2">
              <label for="regular2">Decription</label>
            </div>
            <div class="form-group floating-label">
              <textarea name="contents[]" class="form-control">Content</textarea>
            </div>
          </div>
        </div>
        @endif
        @endforeach
        <div class="card-actionbar-row">
          <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back</a>
          <button type="submit" class="btn btn-primary ink-reaction">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

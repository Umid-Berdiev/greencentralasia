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
        @foreach($languages->get() as $key => $language)
        <li @if($key==0) class="active" @endif>
          <a href="#{{ $language->id }}">{{ $language->language_name }}</a>
        </li>
        @endforeach
      </ul>
    </div>
    <form class="form" role="form" enctype="multipart/form-data" method="post" action="{{ route('pages.store') }}">
      @csrf

      <div class="card-body tab-content">
        {{-- <div class="form-group floating-label">
          <label for="photo">Photo</label>
          <input type="file" id="photo" name="photos" class="form-control" accept="image/*">
        </div> --}}
        <div class="form-group">
          <select class="form-control" id="select1" name="category_id">
            @foreach($categories as $key => $category)
            <option value="{{ $category->category_group_id }}">
              {{ $category->category_name }}
            </option>
            @endforeach
          </select>
          <label for="select1">Categories</label>
        </div>
        @foreach($languages->get() as $key =>$language)
        @if($key == 0)
        <div class="tab-pane active" id="{{ $language->id }}">
          <div class="form" role="form">
            <input type="hidden" name="language_ids[]" value="{{ $language->id }}">
            <div class="form-group floating-label">
              <input type="text" name="titles[]" class="form-control" id="regular2">
              <label for="regular2">Title</label>
            </div>
            {{-- <div class="form-group floating-label">
              <input type="text" name="descriptions[]" class="form-control" id="regular2">
              <label for="regular2">Description</label>
            </div> --}}
            <div class="form-group floating-label">
              <textarea name="contents[]" class="form-control" id="regular2"></textarea>
            </div>
          </div>
        </div>
        @else
        <div class="tab-pane" id="{{ $language->id }}">
          <div class="form" role="form">
            <input type="hidden" name="language_ids[]" value="{{ $language->id }}">
            <div class="form-group floating-label">
              <input type="text" name="titles[]" class="form-control" id="regular2">
              <label for="regular2">Title</label>
            </div>
            {{-- <div class="form-group floating-label">
              <input type="text" name="descriptions[]" class="form-control" id="regular2">
              <label for="regular2">Description</label>
            </div> --}}
            <div class="form-group">
              <textarea name="contents[]"></textarea>
            </div>
          </div>
        </div>
        @endif
        @endforeach

        <div class="card-actionbar-row">
          <a href="{{ route('pages.index') }}" class="btn btn-secondary">Back</a>
          <button type="submit" class="btn btn-primary ink-reaction">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!--end .table-responsive -->



@endsection

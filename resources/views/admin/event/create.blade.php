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
        <li @if($key==0) class="active" @endif><a href="#{{$language->id}}">{{$language->language_name}}</a></li>
        @endforeach
      </ul>
    </div>
    <form class="form" role="form" enctype="multipart/form-data" method="post" action="{{ route('events.store') }}">
      @csrf
      <div class="card-body tab-content">
        <div class="form-group floating-label">
          <select class="form-control" name="category_id" id="post_category_id">
            @foreach($categories as $value)
            <option value="{{ old('category_id') ?? $value->group }}">{{ $value->category_name }}</option>
            @endforeach
          </select>
          <label for="post_category_id">Event category</label>
        </div>

        @foreach($languages->get() as $key => $language)
        @if($key == 0)
        <div class="tab-pane active" id="{{ $language->id }}">
          <div class="form" role="form">
            <input type="hidden" name="language_ids[]" value="{{ $language->id }}">
            <div class="form-group floating-label">
              <input type="date" name="datestart" class="form-control" id="datestart"
                value="{{ old('datestart') ?? date('Y-m-d') }}">
              <label for="datestart">Date start</label>
            </div>
            <div class="form-group floating-label">
              <input type="date" name="dateend" class="form-control" id="dateend"
                value="{{ old('dateend') ?? date('Y-m-d') }}">
              <label for="dateend">Date end</label>
            </div>
            <div class="form-group floating-label">
              <input type="file" name="cover" class="form-control" value="{{ old('cover') }}">
            </div>
            <div class="form-group floating-label">
              <input type="text" name="titles[]" class="form-control" id="title" value="{{ old('titles[0]') }}">
              <label for="title">Title</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="descriptions[]" class="form-control" id="desc"
                value="{{ old('descriptions[0]') }}">
              <label for="desc">Description</label>
            </div>
            <div class="form-group floating-label">
              <textarea name="contents[]" class="form-control">{{ old('contents[0]') }}</textarea>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="organizations[]" class="form-control" id="org"
                value="{{ old('organizations[0]') }}">
              <label for="org">Organization</label>
            </div>
          </div>
        </div>
        @else
        <div class="tab-pane" id="{{ $language->id }}">
          <div class="form" role="form">
            <input type="hidden" name="language_ids[]" value="{{ $language->id }}">
            <div class="form-group floating-label">
              <input type="text" name="titles[]" class="form-control" id="title" value="{{ old('titles[1]') }}">
              <label for="title">Title</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="descriptions[]" class="form-control" id="desc"
                value="{{ old('descriptions[0]') }}">
              <label for="desc">Description</label>
            </div>
            <div class="form-group floating-label">
              <textarea name="contents[]" class="form-control">{{ old('contents[1]') }}</textarea>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="organizations[]" class="form-control" id="org"
                value="{{ old('organizations[0]') }}">
              <label for="org">Organization</label>
            </div>
          </div>
        </div>
        @endif
        @endforeach
        <div class="card-actionbar-row">
          <a href="{{ route('events.index') }}" class="btn btn-secondary">Back</a>
          <button type="submit" class="btn btn-primary ink-reaction">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

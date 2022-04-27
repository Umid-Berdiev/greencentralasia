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
        <li @if($key==0) class="active" @endif>
          <a href="#{{$language->id}}">{{$language->language_name}}</a>
        </li>
        @endforeach
      </ul>
    </div>
    <form class="form" role="form" enctype="multipart/form-data" method="post"
      action="{{ route('pages.update', $page_group->id) }}">
      @csrf
      @method('put')

      <div class="card-body tab-content">
        <div class="form-group">
          <select class="form-control" id="select1" name="category_id">
            @foreach($categories as $key =>$categories)
            <option @if($categories->category_group_id == $page_group->page_category_group_id) selected @endif
              value="{{ $categories->category_group_id }}">
              {{ $categories->category_name }}
            </option>
            @endforeach
          </select>
          <label for="select1">Categories</label>
        </div>
        @foreach($languages->get() as $key => $val)
        @if($key == 0)
        <div class="tab-pane active" id="{{ $languages[$key]->id }}">
          <div class="form" role="form">
            <input type="hidden" name="language_ids[]" value="{{ $languages[$key]->id }}">
            <input type="hidden" name="page_ids[]" value="{{ $pages[$key]->id }}">
            <div class="form-group floating-label">
              <input type="text" name="titles[]" value="{{ $pages[$key]->title }}" class="form-control" id="title">
              <label for="title">Title</label>
            </div>
            {{-- <div class="form-group floating-label">
              <input type="text" name="descriptions[]" value="{{ $pages[$key]->description }}" class="form-control"
                id="desc">
              <label for="desc">Description</label>
            </div> --}}
            <div class="form-group floating-label">
              <textarea name="contents[]" class="form-control">{{ $pages[$key]->content }}</textarea>
            </div>
          </div>
        </div>
        @else
        <div class="tab-pane" id="{{ $languages[$key]->id }}">
          <div class="form" role="form">
            <input type="hidden" name="language_ids[]" value="{{ $languages[$key]->id }}">
            <input type="hidden" name="page_ids[]" value="{{ $pages[$key]->id }}">
            <div class="form-group floating-label">
              <input type="text" name="titles[]" value="{{ $pages[$key]->title }}" class="form-control" id="title">
              <label for="title">Title</label>
            </div>
            {{-- <div class="form-group floating-label">
              <input type="text" name="descriptions[]" value="{{ $pages[$key]->description }}" class="form-control"
                id="desc">
              <label for="desc">Description</label>
            </div> --}}
            <div class="form-group floating-label">
              <textarea name="contents[]" class="form-control">{{ $pages[$key]->content }}</textarea>
            </div>
          </div>
        </div>
        @endif
        @endforeach

        <div class="card-actionbar-row">
          <a href="{{ route('pages.index') }}" class="btn btn-secondary">Back</a>
          <button type="submit" class="btn btn-primary ink-reaction">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

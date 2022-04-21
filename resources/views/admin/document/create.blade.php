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
    <form class="form" role="form" enctype="multipart/form-data" method="post" action="{{ route('documents.store') }}">
      @csrf
      <div class="card-body tab-content">
        <div class="form-group floating-label">
          <select class="form-control" name="category_id">
            @foreach($category as $value)
            <option value="{{ $value->group }}">{{ $value->category_name }}</option>
            @endforeach
          </select>
          <label for="post_category_id">Category</label>
        </div>
        @foreach($languages->get() as $key => $language)
        @if($key == 0)
        <div class="tab-pane active" id="{{$language->id}}">
          <div class="form" role="form">
            <input type="hidden" name="language_ids[]" value="{{$language->id}}">
            <div class="form-group floating-label">
              <input type="text" name="titles[]" class="form-control" id="titles">
              <label for="titles">Title</label>
            </div>
            <div class="form-group floating-label">
              <textarea name="descriptions[]" class="form-control"></textarea>
            </div>
            <div class="form-group floating-label">
              <input type="file" name="files[]" class="form-control">
            </div>
            <div class="form-group floating-label">
              <input type="text" name="links" class="form-control" id="links">
              <label for="links">External link</label>
            </div>
            {{-- <div class="form-group floating-label">
              <input type="text" name="other_link" class="form-control" id="other_link">
              <label for="other_link">Other_link</label>
            </div> --}}
            <div class="form-group floating-label">
              <input type="text" name="register_numbers" class="form-control" id="register_numbers">
              <label for="register_numbers">Reference number</label>
            </div>

            <div class="form-group floating-label">
              <input type="date" name="register_dates" class="form-control" id="register_dates"
                value="{{ date('Y-m-d') }}">
              <label for="register_dates">Register date</label>
            </div>
          </div>
        </div>
        @else
        <div class="tab-pane" id="{{$language->id}}">
          <div class="form" role="form">
            <input type="hidden" name="language_ids[]" value="{{ $language->id }}">
            <div class="form-group floating-label">
              <input type="text" name="titles[]" class="form-control" id="titles">
              <label for="titles">Title</label>
            </div>

            <div class="form-group floating-label">
              <textarea name="descriptions[]" class="form-control"></textarea>
            </div>

            <div class="form-group floating-label">
              <input type="file" placeholder="PDF" name="files[]" class="form-control" id="pdf">
            </div>

            {{-- <div class="form-group floating-label">
              <input type="text" name="links[]" class="form-control" id="links">
              <label for="links">link</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="register_numbers[]" class="form-control" id="register_numbers">
              <label for="register_numbers">register number</label>
            </div>

            <div class="form-group floating-label">
              <input type="date" name="register_dates[]" class="form-control" id="register_dates"
                value="{{ date('Y-m-d') }}">
              <label for="register_dates">register date</label>
            </div> --}}

          </div>
        </div>
        @endif
        @endforeach
        <div class="card-actionbar-row">
          <a href="{{ route('documents.index') }}" class="btn btn-secondary">Back</a>
          <button type="submit" class="btn btn-primary ink-reaction">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!--end .table-responsive -->

@endsection

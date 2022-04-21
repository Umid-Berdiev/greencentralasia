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
        @foreach($langs as $key =>$language)
        <li @if($key==0) class="active" @endif>
          <a href="#{{ $language->id }}">
            {{$language->language_name}}
          </a>
        </li>
        @endforeach
      </ul>
    </div>
    <form class="form" enctype="multipart/form-data" method="post" action="{{ route('documents.update', $grp_id) }}">
      @csrf
      @method('put')
      <div class="card-body tab-content">
        @foreach($langs as $key => $language)
        @php
        $doc = $language->documents[0];
        @endphp
        @if($key == 0)
        <div class="tab-pane active" id="{{ $language->id }}">
          <div class="">
            <input type="hidden" name="language_ids[]" value="{{ $language->id }}">
            <div class="form-group floating-label">
              <select class="form-control" name="category_id" id="category_id">
                @foreach($category as $value)
                <option value="{{ $value->group }}" @if($doc->doc_category_id == $value->group) selected @endif>
                  {{ $value->category_name }}</option>
                @endforeach
              </select>
              <label for="category_id">Document category</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="titles[]" class="form-control" value="{{ $doc->title }}" id="titles">
              <label for="titles">title</label>
            </div>
            <div class="form-group floating-label">
              <textarea name="descriptions[]" class="form-control">{{ $doc->description }}</textarea>
            </div>
            <div class="form-group floating-label">
              <input type="file" name="files[]" class="form-control" value="{{ $doc->files }}">
            </div>
            <div class="form-group floating-label">
              <input type="text" name="links[]" class="form-control" value="{{ $doc->link }}" id="links">
              <label for="links">link</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="other_link" class="form-control" value="{{ $doc->other_link }}" id="other_link">
              <label for="other_link">other link</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="register_numbers[]" class="form-control" value="{{ $doc->r_number }}"
                id="register_numbers">
              <label for="register_numbers">register number</label>
            </div>
            <div class="form-group floating-label">
              <input type="date" name="register_dates[]" class="form-control"
                value="{{ $doc->r_date ?? date('Y-m-d') }}" id="register_dates">
              <label for="register_dates">register date</label>
            </div>
          </div>
        </div>
        @else
        <div class="tab-pane" id="{{ $language->id }}">
          <div class="">
            <input type="hidden" name="language_ids[]" value="{{ $language->id }}">
            <div class="form-group floating-label">
              <input type="text" name="titles[]" class="form-control" value="{{ $doc->title }}" id="titles">
              <label for="titles">title</label>
            </div>
            <div class="form-group floating-label">
              <textarea name="descriptions[]" class="form-control">{{ $doc->description }}</textarea>
            </div>
            <div class="form-group floating-label">
              <input type="file" name="files[]" class="form-control" value="{{ $doc->files }}">
            </div>
            <div class="form-group floating-label">
              <input type="text" name="links[]" class="form-control" value="{{ $doc->link }}" id="links">
              <label for="links">link</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="register_numbers[]" class="form-control" value="{{ $doc->r_number }}"
                id="register_numbers">
              <label for="register_numbers">register number</label>
            </div>
            <div class="form-group floating-label">
              <input type="date" name="register_dates[]" class="form-control"
                value="{{ $doc->r_date ?? date('Y-m-d') }}" id="register_dates">
              <label for="register_dates">register date</label>
            </div>
          </div>
        </div>
        @endif
        @endforeach
        <div class="card-actionbar-row">
          <a href="{{ route('documents.index') }}" class="btn btn-secondary">Back</a>
          <button type="submit" class="btn btn-primary ink-reaction">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

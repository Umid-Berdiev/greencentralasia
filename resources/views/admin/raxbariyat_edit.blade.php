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
    <form class="form" role="form" enctype="multipart/form-data" method="post"
      action="{{ URL('/admin/raxbariyat/update') }}">
      <div class="card-body tab-content">
        @csrf
        @foreach($languages->get() as $key =>$language)
        @if($key == 0)
        <div class="tab-pane active" id="{{$language->id}}">
          <div class="form" role="form">
            <input type="hidden" name="language_ids[]" value="{{$language->id}}">
            <input type="hidden" name="group" value="{{$raxbariyat[0]->group}}">
            <div class="form-group floating-label">
              <input type="text" name="fio[]" value="{{ $raxbariyat[$key]->fio }}" class="form-control" id="regular2">
              <label for="regular2">fio</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="major[]" value="{{ $raxbariyat[$key]->major }}" class="form-control"
                id="regular2">
              <label for="regular2">major</label>
            </div>

            <div class="form-group floating-label">
              <input type="text" name="qabul[]" value="{{ $raxbariyat[$key]->qabul }}" class="form-control"
                id="regular2">
              <label for="regular2">qabul</label>
            </div>
            <h4>Short</h4>
            <div class="form-group floating-label">
              <textarea name="short[]" class="form-control" id="regular2">{{ $raxbariyat[$key]->short }}</textarea>
            </div>
            <h4>Vazifalar</h4>
            <div class="form-group floating-label">
              <textarea name="vazifa[]" class="form-control" id="regular2">{{ $raxbariyat[$key]->vazifa }}</textarea>
            </div>


          </div>
        </div>
        @else
        <div class="tab-pane" id="{{$language->id}}">
          <div class="form" role="form">
            <input type="hidden" name="language_ids[]" value="{{$language->id}}">
            <div class="form-group floating-label">
              <input type="text" name="fio[]" value="{{ $raxbariyat[$key]->fio }}" class="form-control" id="regular2">
              <label for="regular2">fio</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="major[]" value="{{ $raxbariyat[$key]->major }}" class="form-control"
                id="regular2">
              <label for="regular2">major</label>
            </div>

            <div class="form-group floating-label">
              <input type="text" name="qabul[]" value="{{ $raxbariyat[$key]->qabul }}" class="form-control"
                id="regular2">
              <label for="regular2">qabul</label>
            </div>
            <h4>Short</h4>
            <div class="form-group floating-label">
              <textarea name="short[]" class="form-control" id="regular2">{{ $raxbariyat[$key]->short }}</textarea>
            </div>
            <h4>Vazifalar</h4>
            <div class="form-group floating-label">
              <textarea name="vazifa[]" class="form-control" id="regular2">{{ $raxbariyat[$key]->vazifa }}</textarea>
            </div>

          </div>
        </div>
        @endif
        @endforeach
        <div class="form-group floating-label">
          <input type="text" name="tel" value="{{ $raxbariyat[0]->tel }}" class="form-control" id="regular2">
          <label for="regular2">tel</label>
        </div>
        <div class="form-group floating-label">
          <input type="text" name="faks" value="{{ $raxbariyat[0]->faks }}" class="form-control" id="regular2">
          <label for="regular2">faks</label>
        </div>
        <div class="form-group floating-label">
          <input type="email" name="email" value="{{ $raxbariyat[0]->email }}" class="form-control" id="regular2">
          <label for="regular2">email</label>
        </div>

        <div class="form-group floating-label">
          <div><img width="100" src="{{URL(App::getLocale().'/downloads?type=raxbariyat&id='.$raxbariyat[0]->id) }}">
          </div>
          <input type="file" name="cover" class="form-control" id="regular2">
          <label for="regular2">cover</label>
        </div>
        <div class="card-actionbar-row">
          <button type="submit" class="btn btn-flat btn-primary ink-reaction">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!--end .table-responsive -->



@endsection

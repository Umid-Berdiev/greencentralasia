@extends("admin.layouts.admin-layout")

@section("content")

@include('partials.alerts')

@php
$current_lang_id = current_language()->id;
@endphp

<div class="col-md-12" style="background-color: white;padding: 25px;">
  <div class="col-md-6">
    <div class="card-body" style="background-color: white">
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
          action="{{ URL('/admin/menubuilder/insert') }}">
          <div class="card-body tab-content">
            @foreach($languages->get() as $key =>$language)
            @if($key == 0)
            <div class="tab-pane active" id="{{$language->id}}">
              <div class="form" role="form">
                @csrf
                <input type="hidden" name="language_ids[]" value="{{$language->id}}">
                <div class="form-group floating-label">
                  <input type="text" name="menu_name[]" class="form-control" id="regular2">
                  <label for="regular2">Menu item name</label>
                </div>
                <div class="form-group floating-label">

                  <select class="form-control" name="parent_id">

                    <option value="null">Select option</option>
                    @foreach($menues as $keyone=>$value)
                    <?php $modelsx = DB::table("menumakers")
                      ->where("language_id", $current_lang_id)
                      ->where("parent_id","=",$value->group)
                      ->get(); ?>
                    @if(count($modelsx) >0)

                    <option value="{{ $value->group }}">{{ $keyone+1 }}){{ $value->menu_name }}</option>

                    <ul>
                      @foreach($modelsx as $keytwo=>$valuex)
                      <?php $modelsxs = DB::table("menumakers")
                        ->where("language_id", $current_lang_id)
                        ->where("parent_id","=",$valuex->group)
                        ->get(); ?>
                      @if(count($modelsxs) >0)

                      <option value="{{ $valuex->group }}">{{ ($keyone+1).".".($keytwo+1) }}) {{ $valuex->menu_name }}
                      </option>

                      @foreach($modelsxs as $keythree=>$valuexx)
                      <option value="{{ $valuexx->group }}">{{ ($keyone+1).".".($keytwo+1).".".($keythree+1) }})
                        {{ $valuexx->menu_name }}</option>
                      @endforeach

                      @else
                      <option value="{{ $valuex->group }}">{{ ($keyone+1).".".($keytwo+1) }}) {{ $valuex->menu_name }}
                      </option>
                      @endif

                      @endforeach



                      @else
                      <option value="{{ $value->group }}">{{ $keyone+1 }}){{ $value->menu_name }}</option>
                      @endif
                      @endforeach


                  </select>
                  <label for="regular2">Menu item level</label>
                </div>
                <div class="form-group floating-label">

                  <select class="form-control" name="type">
                    <option value="1">Link</option>
                    <option value="2">Post</option>
                    <option value="3">Page</option>
                    <option value="4">Doc</option>
                    <option value="5">Event</option>
                    <option value="6">Tender</option>
                    <option value="7">video</option>
                    <option value="8">Photo</option>
                  </select>
                  <label for="regular2">Content type</label>
                </div>

                <div class="form-group floating-label">

                  <label for="regular2">Content source</label>

                  <select name="alias_category_id" class="form-control">
                    <optgroup label="Docs">
                      @foreach($categories["doc"] as $value)
                      <option value="{{ $value->group }}">{{ $value->category_name }}</option>
                      @endforeach
                    </optgroup>

                    <optgroup label="Tender">
                      @foreach($categories["tender"] as $value)
                      <option value="{{ $value->group }}">{{ $value->category_name }}</option>
                      @endforeach
                    </optgroup>
                    <optgroup label="Event">
                      @foreach($categories["event"] as $value)
                      <option value="{{ $value->group }}">{{ $value->category_name }}</option>
                      @endforeach
                    </optgroup>

                    <optgroup label="Post">
                      @foreach($categories["post"] as $value)
                      <option value="{{ $value->group }}">{{ $value->category_name }}</option>
                      @endforeach
                    </optgroup>

                    <optgroup label="Page">
                      @foreach($categories["page"] as $value)
                      <option value="{{ $value->page_group_id }}">{{ $value->title }}</option>
                      @endforeach
                    </optgroup>

                    <optgroup label="Photo">
                      @foreach($categories["photo"] as $value)
                      <option value="{{ $value->group }}">{{ $value->title }}</option>
                      @endforeach
                    </optgroup>
                    <optgroup label="Photo">
                      @foreach($categories["video"] as $value)
                      <option value="{{ $value->group }}">{{ $value->title }}</option>
                      @endforeach
                    </optgroup>
                  </select>
                </div>
                <div class="form-group floating-label">
                  <input type="text" name="link" class="form-control" id="regular2">
                  <label for="regular2">Link to custom content</label>
                </div>


              </div>
            </div>
            @else
            <div class="tab-pane" id="{{$language->id}}">
              <div class="form" role="form">
                @csrf
                <input type="hidden" name="language_ids[]" value="{{$language->id}}">
                <div class="form-group floating-label">
                  <input type="text" name="menu_name[]" class="form-control" id="regular2">
                  <label for="regular2">Menu item name</label>
                </div>
              </div>
            </div>
            @endif
            @endforeach
            <div class="card-actionbar-row">
              <button type="submit" class="btn btn-flat btn-primary ink-reaction">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

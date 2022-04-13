@extends("admin.layouts.admin-layout")

@php
$current_lang_id = current_language()->id;
$all_langs = $languages->get();
@endphp

@section("content")

@include('partials.alerts')

<div class="col-md-12" style="background-color: white;padding: 25px;">
  <div class="col-md-4">
    <ul id="main-menu" class="gui-controls">
      <li class="gui-folder expanded">
        <a>
          <div class="gui-icon"><i class="fa fa-folder-open fa-fw"></i></div>
          <span class="title">Menu</span>
        </a>
        <!--start submenu -->
        <ul>
          @foreach($menues as $value)
          @php $modelsx = DB::table("menumakers")
          ->where("language_id", $current_lang_id)
          ->where("parent_id","=",$value->group)
          ->get();
          @endphp
          @if(count($modelsx) >0)
          <li class="gui-folder">
            <a href="javascript:void(0);">
              <span class="title">{{ $value->menu_name }}</span>
            </a>
            <!--start submenu -->
            <ul>
              @foreach($modelsx as $valuex)
              <?php $modelsxs = DB::table("menumakers")
                                                ->where("language_id", $current_lang_id)
                                                ->where("parent_id","=",$valuex->group)
                                                ->get(); ?>
              @if(count($modelsxs) >0)

              <li class="gui-folder">
                <a href="javascript:void(0);">
                  <span class="title">{{ $valuex->menu_name }}</span>
                </a>

                <ul>
                  @foreach($modelsxs as $valuexx)
                  <li><a href="#"><span class="title">{{ $valuexx->menu_name }}</span></a></li>
                  @endforeach
                </ul>
              </li>
              @else
              <li><a href="#"><span class="title">{{ $valuex->menu_name }}</span></a></li>
              @endif

              @endforeach

            </ul>
            <!--end /submenu -->
          </li>
          @else
          <li><a href="#"><span class="title">{{ $value->menu_name }}</span></a></li>
          @endif
          @endforeach
        </ul>
        <!--end /submenu -->
      </li>
    </ul>
  </div>

  <div class="col-md-6">
    <div class="card-body" style="background-color: white">
      <div class="col-md-12">
        <div class="card-head">
          <ul class="nav nav-tabs" data-toggle="tabs">
            @foreach($all_langs as $key =>$language)
            @if($key == 0)
            <li class="active"><a href="#{{$language->id}}">{{$language->language_name}}</a></li>
            @else
            <li><a href="#{{$language->id}}">{{$language->language_name}}</a></li>
            @endif
            @endforeach
          </ul>
        </div>
        <form class="form" role="form" enctype="multipart/form-data" method="post"
          action="{{ url('/admin/menubuilder/') }}">
          @csrf
          @method('put')

          <div class="card-body tab-content">
            @foreach($all_langs as $key =>$language)
            @if($key == 0)
            @foreach($edit as $valuesx)
            @if($valuesx->language_id == $language->id)
            <div class="tab-pane active" id="{{$language->id}}">
              <div class="form" role="form">
                <input type="hidden" name="grp_id" value="{{$grp_id}}">
                <input type="hidden" name="language_ids[]" value="{{$language->id}}">
                <div class="form-group floating-label">
                  <input type="text" name="menu_name[]" value="{{ $valuesx->menu_name }}" class="form-control"
                    id="regular2">
                  <label for="regular2">Menu item name</label>
                </div>
                <div class="form-group floating-label">

                  <select class="form-control" name="parent_id">
                    <option value="0">Select option</option>


                    @foreach($menues as $keyone=>$value)
                    <?php $modelsx = DB::table("menumakers")
                      ->where("language_id", $current_lang_id)
                      ->where("parent_id","=",$value->group)
                      ->get(); ?>
                    @if(count($modelsx) >0)

                    @if($valuesx->parent_id == $value->group)
                    <option value="{{ $value->group }}" selected>{{ $keyone+1 }}){{ $value->menu_name }}</option>

                    @else
                    <option value="{{ $value->group }}">{{ $keyone+1 }}){{ $value->menu_name }}</option>

                    @endif
                    <ul>
                      @foreach($modelsx as $keytwo=>$valuex)
                      <?php $modelsxs = DB::table("menumakers")
                        ->where("language_id", $current_lang_id)
                        ->where("parent_id","=",$valuex->group)
                        ->get(); ?>
                      @if(count($modelsxs) >0)

                      @if($valuesx->parent_id == $valuex->group)
                      <option value="{{ $valuex->group }}" selected>{{ ($keyone+1).".".($keytwo+1) }})
                        {{ $valuex->menu_name }}</option>
                      @else
                      <option value="{{ $valuex->group }}">{{ ($keyone+1).".".($keytwo+1) }}) {{ $valuex->menu_name }}
                      </option>

                      @endif
                      @foreach($modelsxs as $keythree=>$valuexx)
                      @if($valuesx->parent_id == $valuexx->group)
                      <option value="{{ $valuexx->group }}">{{ ($keyone+1).".".($keytwo+1).".".($keythree+1) }})
                        {{ $valuexx->menu_name }}</option>
                      @else
                      <option value="{{ $valuexx->group }}" selected>
                        {{ ($keyone+1).".".($keytwo+1).".".($keythree+1) }}) {{ $valuexx->menu_name }}</option>

                      @endif
                      @endforeach

                      @else
                      @if($valuesx->parent_id == $valuex->group)
                      <option value="{{ $valuex->group }}" selected>{{ ($keyone+1).".".($keytwo+1) }})
                        {{ $valuex->menu_name }}</option>
                      @else
                      <option value="{{ $valuex->group }}">{{ ($keyone+1).".".($keytwo+1) }}) {{ $valuex->menu_name }}
                      </option>

                      @endif
                      @endif

                      @endforeach



                      @else
                      @if($valuesx->parent_id == $value->group)
                      <option value="{{ $value->group }}">{{ $keyone+1 }}){{ $value->menu_name }}</option>
                      @else
                      <option value="{{ $value->group }}">{{ $keyone+1 }}){{ $value->menu_name }}</option>
                      @endif
                      @endif
                      @endforeach


                  </select>
                  <label for="regular2">Menu item level</label>
                </div>
                <div class="form-group floating-label">

                  <select class="form-control" name="type">
                    <option value="1" @if($valuesx->type =="1") selected @endif>Link</option>
                    <option value="2" @if($valuesx->type =="2") selected @endif>Post</option>
                    <option value="3" @if($valuesx->type =="3") selected @endif>Page</option>
                    <option value="4" @if($valuesx->type =="4") selected @endif>Doc</option>
                    <option value="5" @if($valuesx->type =="5") selected @endif>Event</option>
                    <option value="6" @if($valuesx->type =="6") selected @endif>Tender</option>
                    <option value="7" @if($valuesx->type =="7") selected @endif>video</option>
                    <option value="8" @if($valuesx->type =="8") selected @endif>Photo</option>
                  </select>
                  <label for="regular2">Content type</label>
                </div>
                <div class="form-group floating-label">

                  <label for="regular2">Content source</label>

                  <select name="alias_category_id" class="form-control">
                    <optgroup label="Docs">
                      @foreach($categories["doc"] as $value)
                      @if($valuesx->alias_category_id == $value->group)
                      <option value="{{ $value->group }}" selected>{{ $value->category_name }}</option>
                      @else
                      <option value="{{ $value->group }}">{{ $value->category_name }}</option>

                      @endif
                      @endforeach
                    </optgroup>

                    <optgroup label="Tender">
                      @foreach($categories["tender"] as $value)

                      @if($valuesx->alias_category_id == $value->group)
                      <option value="{{ $value->group }}" selected>{{ $value->category_name }}</option>
                      @else
                      <option value="{{ $value->group }}">{{ $value->category_name }}</option>

                      @endif
                      @endforeach
                    </optgroup>
                    <optgroup label="Event">
                      @foreach($categories["event"] as $value)
                      @if($valuesx->alias_category_id == $value->group)
                      <option value="{{ $value->group }}" selected>{{ $value->category_name }}</option>
                      @else
                      <option value="{{ $value->group }}">{{ $value->category_name }}</option>

                      @endif
                      @endforeach
                    </optgroup>

                    <optgroup label="Post">
                      @foreach($categories["post"] as $value)
                      @if($valuesx->alias_category_id == $value->group)
                      <option value="{{ $value->group }}" selected>{{ $value->category_name }}</option>
                      @else
                      <option value="{{ $value->group }}">{{ $value->category_name }}</option>

                      @endif
                      @endforeach
                    </optgroup>

                    <optgroup label="Page">
                      @foreach($categories["page"] as $value)
                      @if($valuesx->alias_category_id == $value->page_group_id)
                      <option value="{{ $value->page_group_id }}" selected>{{ $value->title }}</option>
                      @else
                      <option value="{{ $value->page_group_id }}">{{ $value->title }}</option>

                      @endif

                      @endforeach
                    </optgroup>

                    <optgroup label="Photo">
                      @foreach($categories["photo"] as $value)
                      @if($valuesx->alias_category_id == $value->group)
                      <option value="{{ $value->group }}" selected>{{ $value->title }}</option>
                      @else
                      <option value="{{ $value->group }}">{{ $value->title }}</option>

                      @endif

                      @endforeach
                    </optgroup>
                    <optgroup label="Photo">
                      @foreach($categories["video"] as $value)
                      @if($valuesx->alias_category_id == $value->group)
                      <option value="{{ $value->group }}" selected>{{ $value->title }}</option>
                      @else
                      <option value="{{ $value->group }}">{{ $value->title }}</option>

                      @endif
                      @endforeach
                    </optgroup>
                  </select>
                </div>
                <div class="form-group floating-label">
                  <input type="text" name="link" class="form-control" id="regular2" value="{{ $valuesx->link }}">
                  <label for="regular2">Link to custom content</label>
                </div>
              </div>
            </div>
            @endif
            @endforeach
            @else
            @foreach($edit as $valuesx)
            @if($valuesx->language_id == $language->id)
            <div class="tab-pane" id="{{$language->id}}">
              <div class="form" role="form">
                <input type="hidden" name="language_ids[]" value="{{$language->id}}">
                <div class="form-group floating-label">
                  <input type="text" name="menu_name[]" value="{{ $valuesx->menu_name }}" class="form-control"
                    id="regular2">
                  <label for="regular2">Menu item name</label>
                </div>
              </div>
            </div>
            @endif
            @endforeach
            @endif
            @endforeach
            <div class="card-actionbar-row">
              <a type="button" class="btn btn-flat btn-primary ink-reaction" href="{{ url()->previous(); }}">Back</a>
              <button type="submit" class="btn btn-flat btn-primary ink-reaction">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>

@endsection

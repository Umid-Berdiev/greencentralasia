@extends("admin.layouts.admin-layout")

@section("content")

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
    <form class="form" role="form" method="post" action="{{route('page_categories_update')}}">
      <div class="card-body tab-content">
        @foreach($page_categories as $key =>$page_category)
        <input type="hidden" name="page_categories_group_id" value="{{$page_category->category_group_id}}">
        @if($key == 0)
        <div class="tab-pane active" id="{{$page_category->language_id}}">
          <div class="form" role="form">
            @csrf
            <input type="hidden" name="language_ids[]" value="{{$page_category->language_id}}">
            <div class="form-group floating-label">
              <input type="text" name="category_names[]" value="{{$page_category->category_name}}" class="form-control"
                id="regular2">
              <label for="regular2">Page Category name</label>
            </div>

          </div>
        </div>
        @else
        <div class="tab-pane" id="{{$page_category->language_id}}">
          <div class="form" role="form">
            @csrf
            <input type="hidden" name="language_ids[]" value="{{$page_category->language_id}}">
            <div class="form-group floating-label">
              <input type="text" name="category_names[]" value="{{$page_category->category_name}}" class="form-control"
                id="regular2">
              <label for="regular2">Page Category name</label>
            </div>

          </div>
        </div>
        @endif
        @endforeach
        <div class="card-actionbar-row">
          <button type="submit" class="btn btn-flat btn-primary ink-reaction">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!--end .table-responsive -->



@endsection

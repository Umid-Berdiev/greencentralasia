@extends("admin.layouts.admin-layout")

@section("content")

<div class="card-body" style="background-color: white">
  <div class="col-md-12">
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <form class="form" role="form" enctype="multipart/form-data" method="post"
      action="{{ URL('/admin/murojat_update') }}">
      @csrf
      <input type="hidden" name="id" value="{{$object->id}}">
      <div class="card-body tab-content">
        <div class="form-group floating-label">
          <input type="text" name="unique_number" disabled class="form-control" value="{{$object->unique_number}}"
            id="regular2">
          <label for="regular2">unique_number</label>
        </div>
        <div class="form-group floating-label">
          <input type="text" disabled class="form-control" value="{{$object->fio}}" id="regular2">
          <label for="regular2">fio</label>
        </div>
        <div class="form-group floating-label">
          <input type="text" disabled class="form-control" value="{{$object->email}}" id="regular2">
          <label for="regular2">email</label>
        </div>
        <div class="form-group floating-label">
          <input type="text" disabled class="form-control" value="{{$object->phone_number}}" id="regular2">
          <label for="regular2">phone_number</label>
        </div>
        <div class="form-group floating-label">
          <input type="text" disabled class="form-control" value="{{$object->passport}}" id="regular2">
          <label for="regular2">Passport</label>
        </div>
        <div class="form-group floating-label">
          <input type="text" disabled class="form-control" value="{{$object->adress}}" id="regular2">
          <label for="regular2">adress</label>
        </div>
        <div class="form-group floating-label">
          <input type="text" disabled class="form-control" value="{{$object->index}}" id="regular2">
          <label for="regular2">index</label>
        </div>
        <div class="form-group floating-label">
          <input type="text" disabled class="form-control" value="{{$object->object_type}}" id="regular2">
          <label for="regular2">object_type</label>
        </div>
        <div class="form-group floating-label">
          <input type="text" disabled class="form-control" value="{{$object->birth}}" id="regular2">
          <label for="regular2">birth</label>
        </div>


        <div class="form-group">
          <select class="form-control" id="select1" name="status">
            @for($i=0;$i < 4;$i++) @switch($i) @case(0) @if($object->status == $i)
              <option value="{{$i}}" selected>
                Янги мурожаат
              </option>
              @else
              <option value="{{$i}}">
                Янги мурожаат
              </option>
              @endif

              @break
              @case(1)
              @if($object->status == $i)
              <option value="{{$i}}" selected>
                Қайта ишланмоқда
              </option>
              @else
              <option value="{{$i}}">
                Қайта ишланмоқда
              </option>
              @endif
              @break
              @case(2)
              @if($object->status == $i)
              <option value="{{$i}}" selected>
                Кўриб чиқилмоқда
              </option>
              @else
              <option value="{{$i}}">
                Кўриб чиқилмоқда
              </option>
              @endif
              @break
              @case(3)
              @if($object->status == $i)
              <option value="{{$i}}" selected>
                Жавоб жўнатилди
              </option>
              @else
              <option value="{{$i}}">
                Жавоб жўнатилди
              </option>
              @endif
              @break
              @endswitch
              @endfor
          </select>
          <label for="select1">Categories</label>
        </div>


        <div class="form-group floating-label">
          <textarea name="comment" disabled class="form-control" id="regular2">{{$object->comment}}</textarea>
        </div>





        <div class="card-actionbar-row">
          <button type="submit" class="btn btn-flat btn-primary ink-reaction">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!--end .table-responsive -->



@endsection

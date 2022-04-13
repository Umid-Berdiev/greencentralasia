@extends("admin.layouts.admin-layout")

@section("content")

<div class="card-body" style="background-color: white">
  <div class="col-md-12">

    <form class="form" role="form" enctype="multipart/form-data" method="post" action="{{route('gca.info.update')}}">

      <div class="form" role="form">
        @csrf
        <input type="hidden" name="id" value="{{$gca->id}}">

        <div class="form-group floating-label">
          <input type="text" name="name" value="{{$gca->name}}" class="form-control" id="regular2">
          <label for="regular2">name</label>
        </div>
        <div class="form-group floating-label">
          <input type="text" name="prefix" value="{{$gca->prefix}}" class="form-control" id="regular2">
          <label for="regular2">prefix</label>
        </div>
        <div class="form-group floating-label">
          <input type="text" name="title" value="{{$gca->title}}" class="form-control" id="regular2">
          <label for="regular2">title</label>
        </div>
        <div class="form-group floating-label">
          <input type="text" name="phone" value="{{$gca->phone}}" class="form-control" id="regular2">
          <label for="regular2">phone</label>
        </div>
        <div class="form-group floating-label">
          <input type="text" name="address" value="{{$gca->address}}" class="form-control" id="regular2">
          <label for="regular2">address</label>
        </div>
        <div class="form-group floating-label">
          <input type="text" name="wep" value="{{$gca->wep}}" class="form-control" id="regular2">
          <label for="regular2">wep</label>
        </div>
        <div class="form-group floating-label">
          <input type="text" name="email" value="{{$gca->email}}" class="form-control" id="regular2">
          <label for="regular2">email</label>
        </div>
        <div class="form-group floating-label">
          <label for="desc">Description</label>
          <textarea name="desc" class="form-control" id=desc>{{ $gca->desc }}</textarea>
        </div>
      </div>
      <div class="card-actionbar-row">
        <button type="submit" class="btn btn-flat btn-primary ink-reaction">Update</button>
      </div>
    </form>


  </div>
</div>
<!--end .table-responsive -->



@endsection

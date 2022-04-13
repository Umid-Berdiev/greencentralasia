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
    <form class="form" role="form" enctype="multipart/form-data" method="post" action="{{URL('/admin/users/store')}}">
      <div class="card-body tab-content">
        <div class="form-group">
          <select class="form-control" id="select1" name="categories">
            <option value="1">Administrator</option>
            <option value="2">Author</option>
          </select>
          <label for="select1">Role</label>
        </div>
        <div class="tab-pane active" id="">
          <div class="form" role="form">
            @csrf
            <div class="form-group floating-label">
              <input type="text" name="name" class="form-control">
              <label for="regular2">Name</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="email" class="form-control">
              <label for="regular2">Email</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="login" class="form-control">
              <label for="regular2">login</label>
            </div>
            <div class="form-group floating-label">
              <input type="password" name="password" class="form-control">
              <label for="regular2">password</label>
            </div>


          </div>
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

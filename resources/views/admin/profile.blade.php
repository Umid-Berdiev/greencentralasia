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
      action="{{URL('/admin/users/profile_update')}}">
      <div class="card-body tab-content">
        <div class="tab-pane active" id="">
          <div class="form" role="form">
            @csrf
            <div class="form-group floating-label">
              <input type="text" name="name" value="{{ $user->name }}" class="form-control" id="regular2">
              <label for="regular2">Name</label>
            </div>
            <div class="form-group floating-label">
              <input type="password" name="old_password" class="form-control" id="regular2">
              <label for="regular2">old password</label>
            </div>
            <div class="form-group floating-label">
              <input type="password" name="new_password" class="form-control" id="regular2">
              <label for="regular2">new password</label>
            </div>
            <div class="form-group floating-label">
              <input type="password" name="confirm_password" class="form-control" id="regular2">
              <label for="regular2">confirm new password</label>
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

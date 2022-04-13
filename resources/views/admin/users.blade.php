@extends("admin.layouts.admin-layout")
@section("content")
<div class="col-md-12" style="background-color: white;padding: 25px;">
  <div class="col-md-12">
    <p>
      <button type="button" class="btn ink-reaction btn-floating-action btn-lg btn-primary"
        onclick="window.location.href=\" {{ URL('/admin/users/create') }}\"">
        <i class="fa fa-plus"></i>
      </button>
    </p>
    <div class="col-md-2">
    </div>
    <div class="col-md-12">
      <table class="table">
        <thead>
          <tr>
            <td width="80px">№</td>
            <td width="180px">Name</td>
            <td width="180px">Login</td>
            <td width="180px">Role</td>
            <td width="80px"> </td>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $key=>$user)
          <tr>
            <td width="80px">{{ $key+1 }}</td>
            <td width="180px">{{ $user->name }}</td>
            <td width="180px">{{ $user->email }}</td>
            @switch($user->status)
            @case(1)
            <td width="180px">Administrator</td>
            @break
            @case(2)
            <td width="180px">Author</td>
            @break
            @endswitch
            <td>
              <span><a href="{{URL('/admin/users/show?id='.$user->id)}}"><i class="fa fa-edit"></i></a></span>
              <span onclick="return confirm('Are you sure you want to delete this thing into the database?')"><a
                  href="{{URL('/admin/users/delete?id='.$user->id)}}"><i class="fa fa-remove"></i></a></span>

            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{ $users->links() }}
    </div>
  </div>
  @endsection

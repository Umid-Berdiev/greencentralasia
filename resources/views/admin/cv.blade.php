@extends("admin.layouts.admin-layout")

@section("content")

<div class="col-md-12" style="background-color: white;padding: 25px;">
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
    <div class="form-group">
      <form action="{{URL('admin/cv/search')}}" method="get">
        <div class="input-group">
          <div class="input-group-content">
            <input type="text" class="form-control" name="search" placeholder="SEARCH" id="groupbutton9">
            <label for="groupbutton9"></label>
          </div>
          <div class="input-group-btn">
            <button class="btn btn-default" type="submit">Go!</button>
          </div>

        </div>
      </form>
    </div>
    <table class="table table-condensed no-margin">
      <thead>
        <tr>
          <td width="80px">№</td>
          <td width="80px">FIO</td>
          <td width="80px">Email</td>
          <td width="80px">phone_number</td>
          <td width="80px"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></td>
        </tr>
      </thead>
      <tbody>
        @foreach($cvs as $key=>$cv)
        <tr href="#">
          <td width="80px">{{$key+1}}</td>
          <td width="80px">{{$cv->fio}}</td>
          <td width="80px">{{$cv->email}}</td>
          <td width="80px">{{$cv->phone_number}}</td>
          <td width="80px"><a href="{{URL('/admin/cv/'.$cv->id)}}"><span class="glyphicon glyphicon-edit"
                aria-hidden="true"></span></a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{ $cvs->links() }}
  </div>
</div>

@endsection

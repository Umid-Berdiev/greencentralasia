@extends("admin.layouts.admin-layout")

@section("content")
<div class="col-md-12" style="background-color: white;padding: 25px;">
  <div class="col-md-12">
    <table class="table table-condensed no-margin">
      <thead>
        <tr>
          <td width="80px">№</td>
          <td width="80px">name</td>
          <td width="80px">prefix</td>
          <td width="80px">title</td>
          <td width="80px">phone</td>
          <td width="80px">address</td>
          <td width="80px">wep</td>
          <td width="80px"></td>
        </tr>
      </thead>
      <tbody>
        @foreach($gcainfos as $key => $item)
        <tr>
          <td>{{$key+1}}</td>
          <td>{{$item->name}}</td>
          <td>{{$item->prefix}}</td>
          <td>{{$item->title}}</td>
          <td>{{$item->phone}}</td>
          <td>{{$item->address}}</td>
          <td>{{$item->wep}}</td>
          <td>
            <span><a href="{{route('gca.info.edit',$item->id)}}"><i class="fa fa-edit"></i></a></span>
            {{-- <span><a onclick="return confirm('Are you sure you want to delete this thing into the database?')"
                href="{{URL('/admin/pages/delete/'.$item->page_group_id)}}"><i class="fa fa-remove"></i></a></span>--}}

          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </div>
</div>

@endsection

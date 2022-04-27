@extends("admin.layouts.admin-layout")

@section("content")
<div class="container">
  <div class="row justify-content-right">
    <div class="col-auto">
      @include('partials.alerts')
    </div>
  </div>
</div>

<div class="col-md-12" style="background-color: white;padding: 25px;">
  <div class="col-md-12">
    <div class="form-group">
      <a class="btn ink-reaction btn-floating-action btn-lg btn-primary" href="{{ route('photos.create') }}">
        <i class="fa fa-plus"></i>
      </a>
      <br />
      <br />
      <form action="{{ route('photos.index') }}" method="get">
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
          <td>№</td>
          <td>NAME</td>
          <td>DESCRIPTION</td>
          <td>CATEGORY</td>
          <td>IMAGE</td>
          <td>ACTIONS</td>
        </tr>
      </thead>
      <tbody>
        @foreach($table as $key => $page)
        <tr>
          <td>{{$key+1}}</td>
          <td>{{$page->name}}</td>
          <td>{{$page->description}}</td>
          <td>{{$page->title}}</td>
          <td>
            <img src="{{ asset('/storage/photos/' . $page->cover) }}" alt="category's cover image" width="100">
          </td>
          <td>
            <form style="display: inline;" action="{{ route('photos.edit', $page->group) }}" method="get">
              <button>
                <i class="fa fa-edit"></i>
              </button>
            </form>
            <form style="display: inline;" action="{{ route('photos.destroy', $page->group) }}" method="POST">
              @csrf
              @method('delete')
              <button class="" type="submit" onclick="return confirm('Вы уверены?');">
                <i class="fa fa-remove"></i>
              </button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{ $table->links() }}
  </div>
</div>

@endsection

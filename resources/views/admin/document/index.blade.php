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
      <a class="btn ink-reaction btn-floating-action btn-lg btn-primary" href="{{ route('documents.create') }}">
        <i class="fa fa-plus"></i>
      </a>
      <br />
      <br />
      <form action="{{ route('documents.index') }}" method="get">
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
          <td>TITLE</td>
          <td>REGISTER No</td>
          <td>CATEGORY</td>
          <td>ACTIONS</td>
        </tr>
      </thead>
      <tbody>
        {{-- @dd($docs) --}}
        @foreach($docs as $key => $page)
        {{-- @dd($page->category->category_name) --}}
        <tr>
          <td>{{$key+1}}</td>
          <td>{{$page->title}}</td>
          <td>{{$page->r_number}}</td>
          <td>{{$page->category && $page->category->category_name}}</td>
          <td>
            <form style="display: inline;" action="{{ route('documents.edit', $page->group) }}" method="get">
              <button>
                <i class="fa fa-edit"></i>
              </button>
            </form>
            <form style="display: inline;" action="{{ route('documents.destroy', $page->group) }}" method="POST">
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
    {{ $docs->links() }}
  </div>
</div>

@endsection

@extends("admin.layouts.admin-layout")

@section("content")

<div class="container-fluid" style="background-color: white;padding: 25px;">
  <div class="row">
    <div class="col-auto ml-auto">
      @include('partials.alerts')
    </div>
  </div>
  <div class="row">
    <div class="col-md-3">
      <a class="btn ink-reaction btn-floating-action btn-lg btn-primary" href="{{ route('statistics.create') }}">
        <i class="fa fa-plus"></i>
      </a>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <form action="{{ route('statistics.index') }}" method="get">
        <div class="form-group">
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
  </div>
  <div class="row">
    <div class="col-md-12">
      <table class="table table-condensed no-margin">
        <thead>
          <tr>
            <td>№</td>
            <td>NAME</td>
            <td>PHOTO</td>
            <td>ACTIONS</td>
          </tr>
        </thead>
        <tbody>
          @foreach($statistics as $key => $page)
          <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $page->name }}</td>
            <td>
              {{-- @if ($page->photo_url != "null") --}}
              <img alt="Photo" class="img-responsive" src="{{ asset('/storage/statistics/' . $page->photo_url) }}"
                width="100">
              {{-- @endif --}}
            </td>
            <td>
              <form style="display: inline;" action="{{ route('statistics.edit', $page->group) }}" method="get">
                <button>
                  <i class="fa fa-edit"></i>
                </button>
              </form>
              <form style="display: inline;" action="{{ route('statistics.destroy', $page->group) }}" method="POST">
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
      {{ $statistics->links() }}
    </div>
  </div>
</div>


@endsection

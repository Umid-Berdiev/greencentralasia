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
    <a class="btn ink-reaction btn-floating-action btn-lg btn-primary" href="{{ route('languages.create') }}">
      <i class="fa fa-plus"></i>
    </a>
    <br />
    <br />
    <div class="col-md-12">
      <table class="table">
        <thead>
          <tr>
            <td>№</td>
            <td>Language name</td>
            <td>Language prefix</td>
            <td>Action</td>
          </tr>
        </thead>
        <tbody>
          @foreach($languages->get() as $key => $value)
          <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $value->language_name }}</td>
            <td>{{ $value->language_prefix }}</td>
            <td>
              <form style="display: inline;" action="{{ route('languages.edit', $value->id) }}" method="get">
                <button>
                  <i class="fa fa-edit"></i>
                </button>
              </form>
              <form style="display: inline;" action="{{ route('languages.destroy', $value->id) }}" method="POST">
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
    </div>
  </div>

  @endsection

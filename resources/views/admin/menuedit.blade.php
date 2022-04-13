@extends("admin.layouts.admin-layout")

@php
$current_lang_id = $languages->where('status', '1')->where("language_prefix", app()->getLocale())->first()->id;
@endphp

@section("content")
@include('partials.alerts')
<div class="col-md-12" style="background-color: white;padding: 25px;">
  <div class="col-md-12">
    {{-- <div class="form-group">
      <form action="{{ route('menu_edits') }}" method="get">
        <div class="input-group">
          <div class="form-group floating-label">
            <label for="id">Type</label>
            <select class="form-control" name="id" required>
              <option value="null" disabled selected>Select</option>
              @foreach($menus as $keyone=>$value)
              <?php
                $modelsx = DB::table("menumakers")
                  ->where("language_id", $current_lang_id)
                  ->where("parent_id","=",$value->group)
                  ->orderBy("orders")->get();
              ?>
              @if(count($modelsx) >0)

              <option value="{{ $value->group }}">{{ $keyone+1 }}){{ $value->menu_name }}</option>

              <ul>
                @foreach($modelsx as $keytwo=>$valuex)
                <?php $modelsxs = DB::table("menumakers")
                                                    ->where("language_id", $current_lang_id)
                                                    ->where("parent_id","=",$valuex->group)
                                                    ->orderBy("orders")->get(); ?>
                @if(count($modelsxs) >0)

                <option value="{{ $valuex->group }}">{{ ($keyone+1).".".($keytwo+1) }}) {{ $valuex->menu_name }}
                </option>

                @foreach($modelsxs as $keythree=>$valuexx)
                <option value="{{ $valuexx->group }}">{{ ($keyone+1).".".($keytwo+1).".".($keythree+1) }})
                  {{ $valuexx->menu_name }}</option>
                @endforeach

                @else
                <option value="{{ $valuex->group }}">{{ ($keyone+1).".".($keytwo+1) }}) {{ $valuex->menu_name }}
                </option>
                @endif

                @endforeach
                @else
                <option value="{{ $value->group }}">{{ $keyone+1 }}){{ $value->menu_name }}</option>
                @endif
                @endforeach
            </select>
          </div>
          <div class="input-group-btn">
            <button class="btn btn-default" type="submit">EDIT</button>
          </div>
        </div>
      </form>
    </div> --}}

    <div class="row">
      <table class="table">
        <thead>
          <tr>
            <td>#</td>
            <td>Названия</td>
            <td>Действия</td>
          </tr>
        </thead>
        @foreach($menus as $keyone => $value)
        {{-- @php
        $modelsx = DB::table("menumakers")
        ->where("language_id", $current_lang_id)
        ->where("parent_id","=",$value->group)
        ->orderBy("orders")->get();
        @endphp --}}

        <tr>
          <td>{{ $keyone+1 }}</td>
          <td>
            <a href="{{ route('menu_edits', ['id' => $value->group]) }}">
              {{ $value->menu_name }}</a> | {{$value->orders}}
          </td>
          <td>
            <span><a href="{{ URL('/admin/menuchange?id=' . $value->group . '&p=up') }}">
                <i class="fa fa-arrow-circle-o-up btn btn-primary"></i></a></span>
            <span><a href="{{ URL('/admin/menuchange?id=' . $value->group . '&p=down') }}">
                <i class="fa fa-arrow-circle-o-down btn btn-warning"></i></a></span>
            <span><a onclick="return confirm('Are you sure you want to delete this thing into the database?')"
                href="{{ URL('/admin/menudelete?id=' . $value->group) }}">
                <i class="fa fa-trash btn btn-danger"></i></a></span>
          </td>
        </tr>

        @if(count($value->children) > 0)
        @foreach($value->children as $keytwo => $valuex)
        {{-- @php
        $modelsxs = DB::table("menumakers")
        ->where("language_id", $current_lang_id)
        ->where("parent_id","=",$valuex->group)
        ->orderBy("orders")->get();
        @endphp --}}
        {{-- @if(count($modelsxs) >0) --}}
        <tr>
          <td>{{ ($keyone+1) . '.' . ($keytwo+1) }}</td>
          <td style="padding-left: 25px;">
            <a href="{{ route('menu_edits', ['id' => $valuex->group]) }}">
              {{ $valuex->menu_name }}</a> | {{ $valuex->orders }}
          </td>
          <td>
            <span><a href="{{ URL('/admin/menuchange?id=' . $valuex->group . '&p=up') }}">
                <i class="fa fa-arrow-circle-o-up btn btn-primary"></i></a></span>
            <span><a href="{{ URL('/admin/menuchange?id=' . $valuex->group . '&p=down') }}">
                <i class="fa fa-arrow-circle-o-down btn btn-warning"></i></a></span>
            <span><a onclick="return confirm('Are you sure you want to delete this thing into the database?')"
                href="{{ URL('/admin/menudelete?id=' . $valuex->group) }}">
                <i class="fa fa-trash btn btn-danger"></i></a></span>
          </td>
        </tr>

        {{-- @foreach($modelsxs as $keythree=>$valuexx)
        <tr>
          <td>{{ $keythree+1 }}</td>
          <td style="padding-left: 50px;"><span style="background-color: #daf9d1">--{{ $valuexx->menu_name }} |
              {{ $valuexx->orders }}</span></td>
          <td>
            <span><a href="{{ URL('/admin/menuchange?id=' . $valuexx->group . '&p=up') }}">
                <i class="fa fa-arrow-circle-o-up btn btn-primary"></i></a></span>
            <span><a href="{{ URL('/admin/menuchange?id=' . $valuexx->group . '&p=down') }}">
                <i class="fa fa-arrow-circle-o-down btn btn-warning"></i></a></span>
            <span><a onclick="return confirm('Are you sure you want to delete this thing into the database?')"
                href="{{ URL('/admin/menudelete?id=' . $valuexx->group) }}">
                <i class="fa fa-trash btn btn-danger"></i></a></span>
          </td>
        </tr>
        @endforeach
        @else
        <tr>
          <td>{{ $keytwo+1 }}</td>
          <td style="padding-left: 25px;"><span style="background-color: #e1fcff">-{{ $valuex->menu_name }} |
              {{ $valuex->orders }}</span></td>
          <td>
            <span><a href="{{ URL('/admin/menuchange?id=' . $valuex->group . '&p=up') }}">
                <i class="fa fa-arrow-circle-o-up btn btn-primary"></i></a></span>
            <span><a href="{{ URL('/admin/menuchange?id=' . $valuex->group . '&p=down') }}">
                <i class="fa fa-arrow-circle-o-down btn btn-warning"></i></a></span>
            <span><a onclick="return confirm('Are you sure you want to delete this thing into the database?')"
                href="{{ URL('/admin/menudelete?id=' . $valuex->group) }}">
                <i class="fa fa-trash btn btn-danger"></i></a></span>

          </td>
        </tr>
        @endif --}}

        @endforeach

        {{-- @else

        <tr>
          <td>{{ $keyone+1 }}</td>
          <td>{{ $value->menu_name }} | {{ $value->orders }}</td>
          <td>
            <span><a href="{{ URL('/admin/menuchange?id=' . $value->group . '&p=up') }}">
                <i class="fa fa-arrow-circle-o-up btn btn-primary"></i></a></span>
            <span><a href="{{ URL('/admin/menuchange?id=' . $value->group . '&p=down') }}">
                <i class="fa fa-arrow-circle-o-down btn btn-warning"></i></a></span>
            <span><a onclick="return confirm('Are you sure you want to delete this thing into the database?')"
                href="{{ URL('/admin/menudelete?id=' . $value->group) }}">
                <i class="fa fa-trash btn btn-danger"></i></a></span>

          </td>
        </tr> --}}

        @endif
        @endforeach
      </table>
    </div>

  </div>
</div>

@endsection

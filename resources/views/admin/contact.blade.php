@extends("admin.layouts.admin-layout")

@section("content")

<div class="col-md-12" style="background-color: white;padding: 25px;" id="app">
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
      <form action="{{ route('contact.delete') }}">
        <input type="hidden" :value="checkedIds" name="checkedIds">
        <button type="submit" class="btn ink-reaction btn-floating-action btn-lg btn-danger">
          <i class="fa fa-trash"></i>
        </button>
      </form>
      <br />
      <br />
      <form action="{{URL('admin/contact/search')}}" method="post">
        {{csrf_field()}}
        <div class="input-group">
          <div class="input-group-content">
            <input type="text" name="search" class="form-control" placeholder="SEARCH" id="groupbutton9">
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
          <td width="10px"><input type="checkbox" id="mainCheckbox" v-model="mainCheckbox" @click="checkAll">
          </td>
          <td width="10px">№</td>
          <td width="80px">Fio</td>
          <td width="80px">Email</td>
          <td>Comment</td>
          <td width="10px">Action</td>
        </tr>
      </thead>
      <tbody>
        @foreach($contacts as $key => $contact)
        <tr>
          <td width="10px"><input type="checkbox" v-model="checkedIds" :value="{{ $contact->id }}"></td>
          <td width="10px">{{ $key+1 }}</td>
          <td width="80px">{{$contact->fio}}</td>
          <td width="80px">{{$contact->email}}</td>
          <td>{{$contact->comment}}</td>
          <td width="10px">
            <form style="display: flex; justify-content: flex-end" action="{{ route('contact.destroy', $contact->id) }}"
              method="GET">
              @csrf
              <button class="" type="submit" onclick="return confirm('Вы уверены?');">
                <i class="fa fa-remove"></i>
              </button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{ $contacts->links() }}
  </div>
</div>
<script>
  var app = new Vue({
		el: '#app',
		data: {
			checkedIds: [],
			contactIds: []
		},
		computed: {
			mainCheckbox: {
				get() {
					return this.checkedIds.length != 0 && this.contactIds != 0 ? this.checkedIds.length == this.contactIds.length : false;
				},
				set(value) {
					if (value) this.checkedIds = this.contactIds;
				}
			},
		},
		methods: {
			checkAll () {
				this.mainCheckbox != true ? this.checkedIds = this.contactIds : this.checkedIds = [];
			}
		},
		mounted () {
			this.contactIds = @json($contacts->pluck('id'));
		}
})
</script>

@endsection

@extends("admin.layouts.admin-layout")

@section("content")

<div class="container">
  <div class="row">
    <div class="col-auto ml-auto">
      @include('partials.alerts')
    </div>
  </div>
</div>

<div id="doc-create" class="card-body" style="background-color: white">
  <div v-if="errors" class="alert alert-danger small">
    <p>Ошибки:</p>
    <p v-for="err in errors">@{{ [...err] }}</p>
  </div>
  <div class="col-md-12">
    <div class="card-head">
      <ul class="nav nav-tabs" data-toggle="tabs">
        <li v-for="lang, index in languages" :class="{active: index === 0}">
          <a :href="'#' + lang.id">@{{ lang.language_name }}</a>
        </li>
      </ul>
    </div>
    <form class="form" method="POST" id="submit-form" @submit.prevent="(event) => {
      tinymce.triggerSave();
      submit(event);
    }">
      @csrf
      <div class="card-body tab-content">
        <div class="form-group floating-label">
          <select class="form-control" name="category_id">
            <option v-for="cat, index in categories" :value="cat.group">@{{ cat.category_name }}</option>
          </select>
          <label for="post_category_id">Category</label>
        </div>
        <template v-for="lang, index in languages">
          <input type="hidden" name="language_ids[]" :value="lang.id">
          <div class="tab-pane" :class="{active: index === 0}" :id="lang.id">
            <div class="">
              <div class="form-group floating-label">
                <input type="text" name="titles[]" class="form-control" id="titles">
                <label for="titles">Title</label>
              </div>
              <div class="form-group floating-label">
                <textarea :id="'description_' + index" name="descriptions[]" class="form-control"></textarea>
              </div>
              <div class="form-group floating-label">
                <input type="file" name="files[]" class="form-control">
              </div>
            </div>
          </div>
        </template>
        <div class="form-group floating-label">
          <input type="text" name="links" class="form-control" id="links">
          <label for="links">External link</label>
        </div>
        <div class="form-group floating-label">
          <input type="text" name="register_numbers" class="form-control" id="register_numbers">
          <label for="register_numbers">Reference number</label>
        </div>
        <div class="form-group floating-label">
          <input type="date" name="register_dates" class="form-control" id="register_dates" value="{{ date('Y-m-d') }}">
          <label for="register_dates">Register date</label>
        </div>

        <div class="card-actionbar-row">
          <a href="{{ route('documents.index') }}" class="btn btn-secondary">Back</a>
          <button type="submit" class="btn btn-primary ink-reaction">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!--end .table-responsive -->

@endsection

@push('custom-scripts')
<script>
  const docCreateInstance = new Vue({
    el:'#doc-create',
    data() {
      return {
        languages: [],
        categories: [],
        errors: null,
      }
    },
    async created() {
      this.languages = @json($languages->get(), JSON_UNESCAPED_UNICODE);
      this.categories = @json($categories, JSON_UNESCAPED_UNICODE);
    },
    methods: {
      async submit(event) {
        this.errors = null;
        const formData = new FormData(event.target);

        try {
          const response = await axios.post("{{ route('documents.store') }}", formData);
          window.location = `/admin/documents/${response.data.group_id}/edit`;
        } catch (error) {
          this.errors = error.response.data;
          console.log('error while creating document: ', error.response.data);
        }
      }

    }
  });
</script>
@endpush

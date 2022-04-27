@extends("admin.layouts.admin-layout")

@section("content")

<div class="container">
  <div class="row">
    <div class="col-auto ml-auto">
      @include('partials.alerts')
    </div>
  </div>
</div>

<div id="doc-edit" class="card-body" style="background-color: white">
  <div v-if="errors" class="alert alert-danger small">
    <p>Ошибки:</p>
    <p v-for="err in errors">@{{ [...err] }}</p>
  </div>
  <div v-if="successMessage" class="alert small alert-success text-center mb-0">
    @{{ successMessage }}
  </div>
  <div class="col-md-12">
    <div class="card-head">
      <ul class="nav nav-tabs" data-toggle="tabs">
        <li v-for="lang, index in languages" :class="{active: index === 0}">
          <a :href="'#' + lang.id">@{{ lang.language_name }}</a>
        </li>
      </ul>
    </div>
    <form class="form" id="submit-form" @submit.prevent="(event) => {
      tinymce.triggerSave();
      submit(event);
    }">
      @method('PUT')
      <div class="card-body tab-content">
        <template v-for="lang, index in languages">
          <div class="tab-pane" :class="{active: index === 0}" :id="lang.id">
            <input type="hidden" name="language_ids[]" :value="lang.id">
            <div class="form-group floating-label">
              <select class="form-control" name="category_id">
                <option v-for="cat, index in categories" :selected="lang.documents[0].doc_category_id === cat.group"
                  :value="cat.group">@{{ cat.category_name }}</option>
              </select>
              <label for="post_category_id">Category</label>
            </div>
            <div class="">
              <div class="form-group floating-label">
                <input type="text" name="titles[]" :value="lang.documents[0].title" class="form-control" id="titles">
                <label for="titles">Title</label>
              </div>
              <div class="form-group floating-label">
                <textarea :id="'description_' + index" name="descriptions[]" :value="lang.documents[0].description"
                  class="form-control"></textarea>
              </div>
              <div class="form-group floating-label">
                <input type="file" name="files[]" class="form-control">
                <span>
                  @{{ lang.documents[0].files }}
                </span>
              </div>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="links[]" :value="lang.documents[0].link" class="form-control" id="links">
              <label for="links">External link</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="register_numbers[]" :value="lang.documents[0].r_number" class="form-control"
                id="register_numbers">
              <label for="register_numbers">Reference number</label>
            </div>
            <div class="form-group floating-label">
              <input type="date" name="register_dates[]" :value="lang.documents[0].r_date" class="form-control"
                id="register_dates" value="{{ date('Y-m-d') }}">
              <label for="register_dates">Register date</label>
            </div>
          </div>
        </template>

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
  const docEditInstance = new Vue({
    el:'#doc-edit',
    data() {
      return {
        languages: [],
        categories: [],
        documentModels:[],
        errors: null,
        successMessage: '',
        group_id: '',
      }
    },
    async created() {
      this.languages = @json($langs, JSON_UNESCAPED_UNICODE);
      this.categories = @json($categories, JSON_UNESCAPED_UNICODE);
      this.group_id = @json($grp_id, JSON_UNESCAPED_UNICODE);
    },
    methods: {
      async submit(event) {
        this.errors = null;
        this.successMessage = '';
        const formData = new FormData(event.target);

        try {
          const response = await axios.post("{{ route('documents.update', $grp_id) }}", formData)
          this.successMessage = 'Updated!';
        } catch (error) {
          this.errors = error.response.data;
          console.log('error while creating document: ', error.response.data);
        }
      }

    }
  });
</script>
@endpush

<!doctype html>
<html>

<head>
  <title>GCA Admin Portal</title>

  <!-- BEGIN META -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="keywords" content="your,keywords">
  <meta name="description" content="Short explanation about this website">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- END META -->

  <!-- BEGIN STYLESHEETS -->
  <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/theme-default/bootstrap.css?1422792965') }}" />
  <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/theme-default/materialadmin.css?1425466319') }}" />
  <link type="text/css" rel="stylesheet"
    href="{{ asset('assets/css/theme-default/font-awesome.min.css?1422529194') }}" />
  <link type="text/css" rel="stylesheet"
    href="{{ asset('assets/css/theme-default/material-design-iconic-font.min.css?1421434286') }}" />
  <!-- END STYLESHEETS -->

</head>

<body class="menubar-hoverable header-fixed menubar-pin ">

  <!-- BEGIN HEADER-->

  @include("admin.layouts.header")
  <!-- END HEADER-->

  <!-- BEGIN BASE-->
  <div id="base">

    <!-- BEGIN OFFCANVAS LEFT -->
    <div class="offcanvas">
    </div>
    <!--end .offcanvas-->
    <!-- END OFFCANVAS LEFT -->

    <!-- BEGIN CONTENT-->
    <div id="content">

      <!-- BEGIN BLANK SECTION -->
      <section>
        <div class="section-header">

        </div>
        <!--end .section-header -->
        <div class="section-body">
          @yield('content')
        </div>
        <!--end .section-body -->
      </section>

      <!-- BEGIN BLANK SECTION -->
    </div>
    <!--end #content-->
    <!-- END CONTENT -->

    <!-- BEGIN MENUBAR-->
    <div id="menubar" class="menubar-inverse ">
      <div class="menubar-fixed-panel">
        <div>
          <a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
            <i class="fa fa-bars"></i>
          </a>
        </div>
        <div class="expanded">
          <a href="{{ URL('/admin') }}">
            <span class="text-lg text-bold text-primary ">ADMIN-PANEL</span>
          </a>
        </div>
      </div>
      <div class="menubar-scroll-panel">

        <!-- BEGIN MAIN MENU -->
        <ul id="main-menu" class="gui-controls">
          @if(auth()->user()->status == 1)
          <li class="{{ starts_with(Route::current()->uri, 'admin/dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard.index') }}">
              <div class="gui-icon"><i class="md md-web"></i></div>
              <span class="title">Дашборд</span>
            </a>
          </li>

          <li class="{{ starts_with(Route::current()->uri, 'admin/languages') ? 'active' : '' }}">
            <a href="{{ route('languages.index') }}">
              <div class="gui-icon"><i class="md md-web"></i></div>
              <span class="title">Языки</span>
            </a>
          </li>
          @endif

          <li class="gui-folder" id="pager">
            <a class="{{ starts_with(Route::current()->uri, 'admin/post') ? 'active' : '' }}">
              <div class="gui-icon"><i class="md md-computer"></i></div>
              <span class="title">Посты</span>
            </a>

            <ul>
              <li class="{{ starts_with(Route::current()->uri, 'admin/post-categories') ? 'active' : '' }}">
                <a href="{{ route('post-categories.index') }}">
                  <span class="title">Категории постов</span>
                </a>
              </li>
              <li class="{{ starts_with(Route::current()->uri, 'admin/posts') ? 'active' : '' }}">
                <a href="{{ route('posts.index') }}">
                  <span class="title">Посты</span>
                </a>
              </li>
            </ul>
          </li>

          <li class="gui-folder" id="pager">
            <ul>
              @if( Route::current()->getName() == 'tendercategory' ||
              Route::current()->getName() == 'tendercategory' ||
              Route::current()->getName() == 'tendercategory_edit' ||
              Route::current()->getName() == 'tendercategory_delete' ||
              Route::current()->getName() == 'tendercategory_create'
              )
              <li class="active">
                <a href="{{URL('/admin/tendercategory/')}}">
                  <span class="title">Категория тендера</span>
                </a>
              </li>
              @else
              <li>
                <a href="{{URL('/admin/tendercategory/')}}">
                  <span class="title">Категория тендера</span>
                </a>
              </li>
              @endif
              @if( Route::current()->getName() == 'tender' ||
              Route::current()->getName() == 'tender_edit' ||
              Route::current()->getName() == 'tender_delete' ||
              Route::current()->getName() == 'tender_create')
              <li class="active">
                <a href="{{URL('/admin/tender/')}}">
                  <span class="title">Тендер</span>
                </a>
              </li>
              @else
              <li>
                <a href="{{URL('/admin/tender/')}}">
                  <span class="title">Тендер</span>
                </a>
              </li>
              @endif

            </ul>
          </li>

          <li class="gui-folder" id="pager">
            <a class="{{ starts_with(Route::current()->uri, 'admin/event') ? 'active' : '' }}">
              <div class="gui-icon"><i class="md md-computer"></i></div>
              <span class="title">Мероприятия</span>
            </a>

            <ul>
              <li class="{{ starts_with(Route::current()->uri, 'admin/event-categories') ? 'active' : '' }}">
                <a href="{{ route('event-categories.index') }}">
                  <span class="title">Категория мероприятия</span>
                </a>
              </li>

              <li class="{{ starts_with(Route::current()->uri, 'admin/events') ? 'active' : '' }}">
                <a href="{{ route('events.index') }}">
                  <span class="title">Мероприятие</span>
                </a>
              </li>
            </ul>
          </li>

          <li class="gui-folder" id="pager">
            <a class="{{ starts_with(Route::current()->uri, 'admin/document') ? 'active' : '' }}">
              <div class="gui-icon"><i class="md md-computer"></i></div>
              <span class="title">Документы</span>
            </a>

            <ul>
              <li class="{{ starts_with(Route::current()->uri, 'admin/document-categories') ? 'active' : '' }}">
                <a href="{{ route('document-categories.index') }}">
                  <span class="title">Категории Документов</span>
                </a>
              </li>
              <li class="{{ starts_with(Route::current()->uri, 'admin/documents') ? 'active' : '' }}">
                <a href="{{ route('documents.index') }}">
                  <span class="title">Документы</span>
                </a>
              </li>
            </ul>
          </li>

          <li class="gui-folder" id="pager">
            <a class="{{ starts_with(Route::current()->uri, 'admin/photo') ? 'active' : '' }}">
              <div class="gui-icon"><i class="md md-computer"></i></div>
              <span class="title">Фотогалерея</span>
            </a>

            <ul>
              <li class="{{ starts_with(Route::current()->uri, 'admin/photo-categories') ? 'active' : '' }}">
                <a href="{{ route('photo-categories.index') }}">
                  <span class="title">Фото альбом</span>
                </a>
              </li>
              <li class="{{ starts_with(Route::current()->uri, 'admin/photos') ? 'active' : '' }}">
                <a href="{{ route('photos.index') }}">
                  <span class="title">Фотографии</span>
                </a>
              </li>

            </ul>
          </li>

          <li class="gui-folder" id="pager">
            <a class="{{ starts_with(Route::current()->uri, 'admin/video') ? 'active' : '' }}">
              <div class="gui-icon"><i class="md md-computer"></i></div>
              <span class="title">Видеогалерея</span>
            </a>

            <ul>
              <li class="{{ starts_with(Route::current()->uri, 'admin/videoalbum') ? 'active' : '' }}">
                <a href="{{ route('videoalbum.index') }}">
                  <span class="title">Видео альбом</span>
                </a>
              </li>
              <li
                class="{{ Route::current()->getName() == 'video.index' || Route::current()->getName() == 'video.create' || Route::current()->getName() == 'video.edit' ? 'active' : '' }}">
                <a href="{{ route('video.index') }}">
                  <span class="title">Видео ролики</span>
                </a>
              </li>
            </ul>
          </li>

          <!-- BEGIN PAGES -->
          <li class="gui-folder" id="pager">
            <a class="{{ starts_with(Route::current()->uri, 'admin/page') ? 'active' : '' }}">
              <div class="gui-icon"><i class="md md-computer"></i></div>
              <span class="title">Страницы</span>
            </a>

            <ul>
              <li class="{{ starts_with(Route::current()->uri, 'admin/page-categories') ? 'active' : '' }}">
                <a href="{{ route('page-categories.index') }}">
                  <span class="title">Рубрики страниц</span>
                </a>
              </li>

              <li class="{{ starts_with(Route::current()->uri, 'admin/pages') ? 'active' : '' }}">
                <a href="{{ route('pages.index') }}">
                  <span class="title">Страницы</span>
                </a>
              </li>
            </ul>
          </li>

          <li class="gui-folder" id="pager">
            @if(
            'contact' == Route::current()->getName() ||
            'cv' == Route::current()->getName() ||
            'cv_search' == Route::current()->getName() ||
            'cv_edit' == Route::current()->getName() ||
            'murojat' == Route::current()->getName() ||
            'murojat_edit' == Route::current()->getName() ||
            'murojat_id' == Route::current()->getName()
            )
            <a class="active">
              <div class="gui-icon"><i class="md md-computer"></i></div>
              <span class="title">Обращения</span>
            </a>
            @else
            <a>
              <div class="gui-icon"><i class="md md-computer"></i></div>
              <span class="title">Обращения</span>
            </a>
            @endif
            <ul>
              @if(
              'contact' == Route::current()->getName()
              )
              <li class="active">
                <a href="{{URL('/admin/contact')}}">
                  <span class="title">Контакты</span>
                </a>
              </li>
              @else
              <li>
                <a href="{{URL('/admin/contact')}}">
                  <span class="title">Контакты</span>
                </a>
              </li>
              @endif

            </ul>
          </li>

          <li class="gui-folder" id="pager">
            <ul>
              @if(
              'links_categories' == Route::current()->getName()
              )
              <li class="active">
                <a href="{{URL('/admin/links/categories/')}}">
                  <span class="title">Категория Ссылки</span>
                </a>
              </li>
              @else
              <li>
                <a href="{{URL('/admin/links/categories/')}}">
                  <span class="title">Категория Ссылки</span>
                </a>
              </li>
              @endif

            </ul>
          </li>

          <li class="{{ starts_with(Route::current()->uri, 'admin/statistics') ? 'active' : '' }}">
            <a href="{{ route('statistics.index') }}">
              <span class="title">{{ __('Статистика') }}</span>
            </a>
          </li>

          @if('gca.info.index' == Route::current()->getName())
          <li class="active">
            <a href="{{route('gca.info.index')}}">
              <span class="title">GCA INFO</span>
            </a>
          </li>
          @else
          <li>
            <a href="{{route('gca.info.index')}}">
              <span class="title">GCA INFO</span>
            </a>
          </li>

          @endif
          @if(auth()->user()->status == 1)
          @if(
          'menu' == Route::current()->getName()
          )
          <li class="active">
            <a href="{{URL('/admin/menu/')}}">
              <span class="title">Конструктор Меню</span>
            </a>
          </li>
          <!--end /menu-li -->
          @else
          <li>
            <a href="{{URL('/admin/menu/')}}">
              <span class="title">Конструктор Меню</span>
            </a>
          </li>
          @endif



          <!-- END FORMS -->
          @if(
          'menu_edit' == Route::current()->getName() ||
          'menu_edits' == Route::current()->getName() ||
          'menu_id' == Route::current()->getName()
          )
          <li class="active">
            <a href="{{URL('/admin/menu/edit')}}">
              <span class="title">Изменение меню</span>
            </a>
          </li>
          @else
          <li>
            <a href="{{URL('/admin/menu/edit')}}">
              <span class="title">Изменение меню</span>
            </a>
          </li>

          @endif

          @if(
          'users' == Route::current()->getName() ||
          'users_create' == Route::current()->getName() ||
          'users_edit' == Route::current()->getName()

          )
          <li class="active">
            <a href="{{URL('/admin/users/')}}">
              <span class="title">Пользователи</span>
            </a>
          </li>
          @else
          <li>
            <a href="{{URL('/admin/users/')}}">
              <span class="title">Пользователи</span>
            </a>
          </li>

          @endif
          @endif

        </ul>
        <!--end .main-menu -->
        <!-- END MAIN MENU -->

        <div class="menubar-foot-panel">
          <small class="no-linebreak hidden-folded">
            <span class="opacity-75">Developed by </span> <strong><a href="http://kibera.uz/">Kibera
                Technology</a></strong>
          </small>
        </div>
      </div>
      <!--end .menubar-scroll-panel-->
    </div>
    <!--end #menubar-->
    <!-- END MENUBAR -->

  </div>
  <!--end #base-->
  <!-- END BASE -->

  <!-- BEGIN JAVASCRIPT -->
  <script src="{{ asset('assets/js/vue.js')}}"></script>
  <script src="{{ asset('assets/js/libs/utils/html5shiv.js?1403934957') }}"></script>
  <script src="{{ asset('assets/js/libs/utils/respond.min.js?1403934956') }}"></script>

  <script src="{{ asset('assets/js/libs/jquery/jquery-1.11.2.min.js') }}"></script>
  <script src="{{ asset('assets/js/libs/jquery/jquery-migrate-1.2.1.min.js') }}"></script>
  <script src="{{ asset('assets/js/libs/bootstrap/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/libs/spin.js/spin.min.js') }}"></script>
  <script src="{{ asset('assets/js/libs/moment/moment.min.js') }}"></script>
  <script src="{{ asset('assets/js/libs/flot/jquery.flot.min.js') }}"></script>
  <script src="{{ asset('assets/js/libs/flot/jquery.flot.time.min.js') }}"></script>
  <script src="{{ asset('assets/js/libs/flot/jquery.flot.resize.min.js') }}"></script>
  <script src="{{ asset('assets/js/libs/flot/jquery.flot.orderBars.js') }}"></script>
  <script src="{{ asset('assets/js/libs/flot/jquery.flot.pie.js') }}"></script>
  <script src="{{ asset('assets/js/libs/flot/curvedLines.js') }}"></script>
  <script src="{{ asset('assets/js/libs/jquery-knob/jquery.knob.min.js') }}"></script>
  <script src="{{ asset('assets/js/libs/sparkline/jquery.sparkline.min.js') }}"></script>
  <script src="{{ asset('assets/js/libs/nanoscroller/jquery.nanoscroller.min.js') }}"></script>
  <script src="{{ asset('assets/js/libs/d3/d3.min.js') }}"></script>
  <script src="{{ asset('assets/js/libs/d3/d3.v3.js') }}"></script>
  <script src="{{ asset('assets/js/libs/rickshaw/rickshaw.min.js') }}"></script>

  <script src="{{ asset('assets/js/libs/autosize/jquery.autosize.min.js') }}"></script>
  <script src="{{ asset('assets/js/libs/nanoscroller/jquery.nanoscroller.min.js') }}"></script>

  <script src="{{ asset('assets/js/core/source/App.js') }}"></script>
  <script src="{{ asset('assets/js/core/source/AppNavigation.js') }}"></script>
  <script src="{{ asset('assets/js/core/source/AppOffcanvas.js') }}"></script>
  <script src="{{ asset('assets/js/core/source/AppCard.js') }}"></script>
  <script src="{{ asset('assets/js/core/source/AppForm.js') }}"></script>
  <script src="{{ asset('assets/js/core/source/AppNavSearch.js') }}"></script>
  <script src="{{ asset('assets/js/core/source/AppVendor.js') }}"></script>
  <script src="{{ asset('assets/js/core/demo/Demo.js') }}"></script>

  <script src="{{ asset('assets/js/tinymce/tinymce.min.js') }}"></script>

  <script>
    let editor_config = {
      path_absolute: "/",
      selector: "textarea",
      theme: "silver",
      height: 300,
      plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak image code",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
      ],
      toolbar1: "responsivefilemanager undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect | sizeselect | fontselect | fontsizeselect",
      toolbar2: "link image media |link unlink anchor | forecolor backcolor  | print preview code  fullscreen insertdatetime ",

      fontsize_formats: "8px 10px 12px 14px 18px 24px 36px",
      relative_urls: false,
      image_title: true,
      automatic_uploads: true,
      file_picker_types: 'image',
      file_picker_callback: function (cb, value, meta) {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');
        input.onchange = function () {
          var file = this.files[0];
          var reader = new FileReader();
          reader.onload = function () {
            var id = 'blobid' + (new Date()).getTime();
            var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
            var base64 = reader.result.split(',')[1];
            var blobInfo = blobCache.create(id, file, base64);
            blobCache.add(blobInfo);
            cb(blobInfo.blobUri(), { title: file.name });
          };
          reader.readAsDataURL(file);
        };

        input.click();
      },
      content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
      /* file_picker_callback : function(callback, value, meta) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
        if (meta.filetype == 'image') {
          cmsURL = cmsURL + "&type=Images";
        } else {
          cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.openUrl({
          url : cmsURL,
          title : 'Filemanager',
          width : x * 0.8,
          height : y * 0.8,
          resizable : "yes",
          close_previous : "no",
          onMessage: (api, message) => {
            callback(message.content);
          }
        });
      } */
    };
    // tinymce.init(editor_config);
  </script>

  @stack('custom-scripts')
</body>

</html>

<section class="about_us">
  <div class="container">
    <div class="about_us_main">
      <div class="about_us_main_left">
        <div class="mini_img">
          <img src="{{ asset('project_gca/images/mountain.jpg') }}" alt="">
        </div>
        <div class="big_img">
          <img src="{{ asset('project_gca/images/mountain2.jpg') }}" alt="">
        </div>
      </div>
      <div class="about_us_main_right">
        <span class="template_span">{{ __('blog.about_us') }}</span>
        <h2 class="title">{{ __('blog.activity_head') }}</h2>
        <p class="title">{{ __('blog.activity') }}</p>

        <a href="{{ url(app()->getLocale().'/page/15/87') }}" class="link_template">{{ __('blog.discover_more') }}</a>
      </div>
    </div>
  </div>
</section>

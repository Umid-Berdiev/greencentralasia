<section class="report">
  <div class="container">
    <span class="template_span">@lang('blog.statistica')</span>
    <h2 class="title">@lang('blog.gca')</h2>
  </div>
  <div class="swiper-container swiper_docs">
    <div class="swiper-wrapper mb-5">
      @foreach($statisticas as $item)
      <div class="swiper-slide mx-3" data-fancybox=":gallery"
        data-src="{{ asset('storage/statistics/' . $item->photo_url) }}">
        <a href="#" class="report_main_item">
          <div >
            <img src="{{URL('\storage/statistics/'.$item->photo_url)}}" alt="stat1 image"
             width="400" height="300">
          </div>
          <p style="width:400px;"  >{{ $item->name }}</p>
        </a>
      </div>
      @endforeach
    </div>
    
    <div class="swiper-pagination "></div>
  </div>
</section>
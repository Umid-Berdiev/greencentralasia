<section class="media_section">
  <div class="media-swiper-container swiper-container for_med">
    <div class="swiper-wrapper">
      @foreach($media_gallery as $key => $item)
      @if (isset($item->youtube_link))
      <div class="swiper-slide">
        <a data-fancybox="" class="videos_fancy over"
          href="https://www.youtube.com/watch?v={{ $item->youtube_link}}&amp;feature=emb_logo"
          data-caption="{{ $item->description}}">
          <img src="{{ asset('storage/videos/' . $item->cover) }}" alt="youtube_link_cover" height="250">
          {{-- <img src="https://img.youtube.com/vi/{{ $item->youtube_link}}/sddefault.jpg" alt="youtube_link_cover"
          height="250"> --}}
          <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M29 15C29 7.27083 22.7292 1 15 1C7.27083 1 1 7.27083 1 15C1 22.7292 7.27083 29 15 29C22.7292 29 29 22.7292 29 15Z"
              stroke="#fff" stroke-width="2" stroke-miterlimit="10"></path>
            <path
              d="M12.107 20.7196L20.4523 15.6782C20.5686 15.6073 20.6648 15.5077 20.7315 15.3889C20.7982 15.2702 20.8332 15.1362 20.8332 15C20.8332 14.8638 20.7982 14.7299 20.7315 14.6111C20.6648 14.4924 20.5686 14.3928 20.4523 14.3219L12.107 9.28045C11.9874 9.20879 11.8509 9.17023 11.7114 9.16875C11.572 9.16726 11.4347 9.20289 11.3135 9.27198C11.1924 9.34108 11.0919 9.44115 11.0222 9.56194C10.9525 9.68272 10.9162 9.81986 10.917 9.95931V20.0408C10.9162 20.1802 10.9525 20.3174 11.0222 20.4381C11.0919 20.5589 11.1924 20.659 11.3135 20.7281C11.4347 20.7972 11.572 20.8328 11.7114 20.8313C11.8509 20.8298 11.9874 20.7913 12.107 20.7196Z"
              fill="#fff"></path>
          </svg>
        </a>
      </div>
      @else
      <div class="swiper-slide">
        <div class="over" data-fancybox=":gallery" data-src="{{ asset('storage/photos/' . $item->cover) }}">
          <img src="{{ asset('storage/photos/' . $item->cover) }}" height="250">
          <svg width="40" height="36" viewBox="0 0 40 36" fill="#000" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M24.24 4L27.9 8H36V32H4V8H12.1L15.76 4H24.24ZM26 0H14L10.34 4H4C1.8 4 0 5.8 0 8V32C0 34.2 1.8 36 4 36H36C38.2 36 40 34.2 40 32V8C40 5.8 38.2 4 36 4H29.66L26 0ZM20 14C23.3 14 26 16.7 26 20C26 23.3 23.3 26 20 26C16.7 26 14 23.3 14 20C14 16.7 16.7 14 20 14ZM20 10C14.48 10 10 14.48 10 20C10 25.52 14.48 30 20 30C25.52 30 30 25.52 30 20C30 14.48 25.52 10 20 10Z"
              fill="white" />
          </svg>
        </div>
      </div>
      @endif
      @endforeach
    </div>
  </div>
</section>
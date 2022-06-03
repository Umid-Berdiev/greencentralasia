<footer>
  <div class="ftr_top">
    <div class="container">
      <div class="ftr_top_main">
        <div class="ft1">
          <a href="{{ url(app()->getLocale() . '/') }}" class="logo">
            <img src="{{asset('project_gca/images/logo.png')}}" alt="">
          </a>
          <p>@lang('blog.address_placeholder')</p>
          <div class="abouts">
            <a href="tel:+998 93 501 07 40">
              <svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M3.38433 4.61486C4.17608 5.40595 5.09337 6.16304 5.45599 5.8005C5.97465 5.28194 6.29475 4.82989 7.43911 5.74949C8.58298 6.6686 7.7042 7.28167 7.20154 7.78372C6.62136 8.36379 4.45867 7.81473 2.321 5.67798C0.183822 3.54074 -0.363852 1.37849 0.216832 0.798424C0.719491 0.295367 1.32968 -0.582733 2.24897 0.560897C3.16876 1.70453 2.71712 2.02456 2.19746 2.54362C1.83634 2.90617 2.59308 3.82327 3.38433 4.61486Z"
                  fill="#2DA37D" />
              </svg>
              +998 93 501 07 40
            </a>
            <a href="mailto:info@greencentralasia.org">
              <svg width="10" height="8" viewBox="0 0 10 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M9 0H1C0.45 0 0.005 0.45 0.005 1L0 7C0 7.55 0.45 8 1 8H9C9.55 8 10 7.55 10 7V1C10 0.45 9.55 0 9 0ZM9 2L5 4.5L1 2V1L5 3.5L9 1V2Z"
                  fill="#2DA37D" />
              </svg>
              info@greencentralasia.org
            </a>
            <a href="javascript:;">
              <svg width="7" height="10" viewBox="0 0 7 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M3.12695 0C1.39962 0 0 1.394 0 3.1207C0 6.10632 3.12695 10 3.12695 10C3.12695 10 6.25391 6.10569 6.25391 3.1207C6.25391 1.39462 4.85428 0 3.12695 0ZM3.12695 4.8474C2.67912 4.8474 2.24963 4.6695 1.93297 4.35284C1.6163 4.03617 1.4384 3.60668 1.4384 3.15885C1.4384 2.71102 1.6163 2.28153 1.93297 1.96486C2.24963 1.64819 2.67912 1.47029 3.12695 1.47029C3.57479 1.47029 4.00428 1.64819 4.32094 1.96486C4.63761 2.28153 4.81551 2.71102 4.81551 3.15885C4.81551 3.60668 4.63761 4.03617 4.32094 4.35284C4.00428 4.6695 3.57479 4.8474 3.12695 4.8474Z"
                  fill="#2DA37D" />
              </svg>
              @lang('blog.address')
            </a>
          </div>
          <br />
          <div class="abouts">
            <a href="{{ url(app()->getLocale() . '/registration-information') }}" style="
                font-weight: normal;
                font-size: 14px;
                line-height: 16px;
                color: #ffffff;
                margin-bottom: 15px;
                display: inline-flex;
                margin-bottom: 15px;
                transition: all 0.3s;
                text-decoration: none;
              ">
              {{-- <i class="fa fa-info-circle fa-fw" aria-hidden="true" style="width: 14px"></i> --}}
              @lang('blog.registration_info')
            </a>
          </div>
        </div>
        <div class="ft2">
          <h5>@lang('blog.map')</h5>
          <x-partials.footer-menu-map />
        </div>
        <div class="ft3">
          {{-- <h5>Events</h5>--}}
          {{-- <a href="#" class="news_item">--}}
            {{-- <img src="{{asset('project_gca/images/ne.jpg')}}" alt="">--}}
            {{-- <div>--}}
              {{-- <span>02 Aug 2020</span>--}}
              {{-- <p>There are many variations of passages.</p>--}}
              {{-- </div>--}}
            {{-- </a>--}}
          {{-- <a href="#" class="news_item">--}}
            {{-- <img src="{{asset('project_gca/images/ne.jpg')}}" alt="">--}}
            {{-- <div>--}}
              {{-- <span>02 Aug 2020</span>--}}
              {{-- <p>There are many variations of passages.</p>--}}
              {{-- </div>--}}
            {{-- </a>--}}
        </div>
        <div class="ft5">
          <h5>@lang('blog.additional_message')</h5>
          <p>@lang('blog.additional_message_placeholder')</p>
          <form action="{{ route('new-obuna', ['locale' => app()->getLocale()]) }}" class="form_template" method="post">
            @csrf
            <div class="form-group">
              <input type="email" placeholder="@lang('blog.email_placeholder')" name="email">
              <button type="submit" class=" text-black">
                <img src="{{ asset('GCAlogos/right.png') }}" alt="logo" style="width:31px; height:31px">
              </button>
            </div>
          </form>
          <br>
          <p class="text-capitalize mb-1">{{ __('blog.online_users') . ': ' . $online_visitors }}</p>
          <p class="text-capitalize mb-1">{{ __('blog.today_users') . ': ' . $today_visitors }}</p>
        </div>
      </div>
    </div>
  </div>
  <div class="ftr_bottom">
    <div class="container">
      <div class="ftr_bottom_main">
        <p>© Copyright 2020 - {{ date('Y') }}. Green Central Asia</p>
        <div class="socials">
          <a href="https://twitter.com/GreenCentralAs1">
            <svg width="15" height="13" viewBox="0 0 15 13" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M13.4589 3.03633C13.4689 3.16991 13.4689 3.30272 13.4689 3.43553C13.4689 7.5 10.3753 12.1835 4.72166 12.1835C2.97985 12.1835 1.36169 11.679 0 10.8027C0.247303 10.831 0.485447 10.8409 0.742673 10.8409C2.1265 10.8442 3.47113 10.3815 4.55984 9.52727C3.91824 9.51566 3.29629 9.30398 2.78081 8.92179C2.26534 8.5396 1.88209 8.00598 1.68456 7.39543C1.87462 7.42367 2.06544 7.44275 2.26542 7.44275C2.54096 7.44275 2.81803 7.40459 3.07526 7.33818C2.37896 7.1976 1.75285 6.82018 1.30339 6.27011C0.853931 5.72004 0.608864 5.03128 0.609862 4.32093V4.28277C1.01974 4.51099 1.49527 4.65372 1.99903 4.67281C1.57701 4.39237 1.23096 4.01182 0.991761 3.56513C0.752564 3.11843 0.627656 2.61947 0.62818 2.11276C0.62818 1.54183 0.780073 1.01822 1.04646 0.561775C1.819 1.51208 2.78254 2.28951 3.87467 2.84372C4.9668 3.39794 6.16316 3.71658 7.38627 3.77901C7.33895 3.55002 7.30994 3.31264 7.30994 3.0745C7.30974 2.67069 7.38913 2.27081 7.54357 1.8977C7.698 1.52459 7.92446 1.18559 8.20999 0.900052C8.49553 0.614519 8.83454 0.388061 9.20764 0.233624C9.58075 0.0791871 9.98063 -0.000200269 10.3844 3.79399e-07C11.2698 3.79399e-07 12.069 0.370955 12.6308 0.970894C13.3191 0.837791 13.9791 0.586522 14.5817 0.228221C14.3523 0.938695 13.8717 1.54114 13.23 1.92271C13.8404 1.85308 14.437 1.69254 15 1.44642C14.5795 2.05941 14.0585 2.59695 13.4589 3.03633Z" />
            </svg>
          </a>
          <a href="https://www.facebook.com/GreenCentralAsia/">
            <svg width="13" height="13" viewBox="0 0 13 13" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M0.723125 0H12.285C12.6831 0 13 0.316875 13 0.715V12.285C13 12.675 12.6831 13 12.285 13H8.97V7.9625H10.66L10.9119 6.00438H8.97V4.75312C8.97 4.18437 9.1325 3.79437 9.945 3.79437H10.985V2.03938C10.8063 2.015 10.1888 1.96625 9.47375 1.96625C7.97062 1.96625 6.94688 2.87625 6.94688 4.55813V6.00438H5.24875V7.9625H6.94688V13H0.723125C0.53274 13 0.350031 12.9249 0.21465 12.7911C0.0792686 12.6572 0.00213916 12.4754 0 12.285V0.715C0 0.316875 0.325 0 0.723125 0Z" />
            </svg>
          </a>
        </div>
      </div>
    </div>
  </div>
  <div id="menu">
    <a href="header" class="template_bord">
      <svg width="9" height="5" viewBox="0 0 9 5" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M0.129118 4.42349C0.129118 4.26408 0.18491 4.13656 0.296493 4.04091L4.17003 0.167375C4.28162 0.0557915 4.40914 -2.00673e-07 4.5526 -1.94402e-07C4.69607 -1.88131e-07 4.83156 0.0557915 4.95909 0.167375L8.83262 4.04091C8.94421 4.1525 9 4.28799 9 4.4474C9 4.6068 8.94421 4.73432 8.83262 4.82997C8.72104 4.92561 8.59352 4.9814 8.45005 4.99734C8.30659 5.01328 8.17109 4.95749 8.04357 4.82997L4.5526 1.339L1.06164 4.82997C0.950053 4.94155 0.82253 4.99734 0.679065 4.99734C0.5356 4.99734 0.408076 4.94155 0.296493 4.82997C0.18491 4.71838 0.129118 4.58289 0.129118 4.42349Z"
          fill="white"></path>
      </svg>
    </a>
  </div>
</footer>

@include('gca.blocks.cookie-banner')

@push('scripts')
<script>
  let acc = document.getElementsByClassName("accordion");
  let i;

  for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
      this.classList.toggle("active");
      let panel = this.nextElementSibling;
      if (panel.style.maxHeight) {
        panel.style.maxHeight = null;
      } else {
        panel.style.maxHeight = panel.scrollHeight + "px";
      }
    });
  }
</script>
@endpush

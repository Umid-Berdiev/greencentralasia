<header id="header" style="z-index: 9999">
  <div class="headerbar">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="headerbar-left">
      <ul class="header-nav header-nav-options">
        <li class="header-nav-brand">
          <div class="brand-holder">
            <a href="{{ URL('/admin') }}">
              <span class="text-lg text-bold text-primary">Green CA</span>
            </a>
          </div>
        </li>
        <li>
          <a class="btn btn-icon-toggle menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
            <i class="fa fa-bars"></i>
          </a>
        </li>
      </ul>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="headerbar-right">
      <ul class="header-nav header-nav-profile">
        @foreach($languages->get() as $key => $language)
        <li>
          <a class="text-uppercase {{ app()->getLocale() == $language->language_prefix ? 'text-danger' : '' }}"
            href="{{ url('/locale/' . $language->language_prefix) }}">
            {{ $language->language_prefix }}
          </a>
        </li>
        @break
        @endforeach
      </ul>
      <ul class="header-nav header-nav-profile">
        <li class="dropdown">
          <a href="javascript:void(0);" class="dropdown-toggle ink-reaction" data-toggle="dropdown">
            <img src="{{asset('assets/img/avatar1.jpg?1403934956')}}" alt="" />
            <span class="profile-info">
              {{ auth()->user()->name }}
              @switch(auth()->user()->status)
              @case(1)
              <small>Administrator</small>
              @break
              @case(2)
              @break
              <small>Author</small>

              @endswitch

            </span>
          </a>
          <ul class="dropdown-menu animation-dock">
            <li><a href="{{ url('/admin/users/profile') }}" style="padding: 8px;"><i
                  class="fa fa-fw fa-user text-danger"></i> Profile</a>
            </li>
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf

                {{-- <a href="{{ route('logout') }}"><i class="fa fa-fw fa-power-off text-danger"></i> Logout</a> --}}
                <button type="submit" class="btn-link">
                  <i class="fa fa-fw fa-power-off text-danger"></i>
                  {{ __('Log Out') }}
                </button>
              </form>
            </li>
          </ul>
          <!--end .dropdown-menu -->
        </li>

      </ul>
      <!--end .header-nav-profile -->
    </div>
    <!--end #header-navbar-collapse -->
  </div>
</header>

<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-fixed navbar-shadow navbar-brand-center">
    <div class="navbar-header d-xl-block d-none">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item">
              <a class="navbar-brand" href="/">
                <div class="brand-logo"></div>
                <h2>Pap!Kos</h2>
              </a>
            </li>
        </ul>
    </div>
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav">
                        <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon feather icon-menu"></i></a></li>
                        <li class="mr-2">
                          <i class="feather icon-airplay"></i> <a href="" style="color: black">App</a>
                        </li>
                        <li>
                          <i class="feather icon-calendar"></i> <a href="{{url('show-all-room')}}" style="color: black">Booking</a>
                        </li>
                    </ul>
                </div>
                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon feather icon-bell"></i><span class="badge badge-pill badge-primary badge-up">0</span></a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <div class="dropdown-header m-0 p-2">
                                    <h3 class="white">0</h3><span class="notification-title">Notifications</span>
                                </div>
                            </li>

                            <li class="dropdown-menu-footer"><a class="dropdown-item p-1 text-center" href="javascript:void(0)">Read all notifications</a></li>
                        </ul>
                    </li>
                    @auth
                      <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                          <div class="user-nav d-sm-flex d-none">
                            <span class="user-name text-bold-600">{{Auth::user()->name}}</span>
                            <span class="user-status">{{Auth::user()->role}}</span>
                          </div>
                          <span>
                            @if (Auth::user()->photo == NULL)
                              <img class="round" src="{{asset('assets/images/profile/profile.jpg')}}" alt="avatar" height="40" width="40">
                            @else
                              <img class="round" src="{{ url('/photo_profile_admin/'. Auth::user()->photo) }}" alt="avatar" height="40" width="40">
                            @endif
                          </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item" href="{{url('profile')}}"><i class="feather icon-user"></i>Profile</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                            <i class="feather icon-power"></i> Logout
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                          </a>
                        </div>
                      </li>
                    @else
                      <li class="nav-item">
                        <a class="nav-link nav-link-label" href="{{route('login')}}">
                         <i class="feather icon-log-in"></i> <span class=" mr-2">Masuk</span></a>
                      </li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</nav>
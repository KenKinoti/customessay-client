<header class="topbar" data-navbarbg="skin6">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <div class="" style="display: inline-block !important;" >
            <span class="nav-toggler waves-effect waves-light " href="javascript:void(0)" style="margin-top: 20px">
                <i class="ti ti-align-justify " style="color: #416339" ></i>
            </span>
            <a href="{{ route('dashboard') }}">
                    <b class="logo-icon">
                        <img src="{{ asset('images/logo-app.png') }}" alt="dashboard" class="img-fluid mx-5" > 
                    </b>

                </a>
            <span class="topbartoggler float-right d-block d-md-none waves-effect waves-light " href="javascript:void(0)"
               data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
               aria-expanded="false" aria-label="Toggle navigation" style="margin-top: -20px">
                <i class="ti ti-more " style="color: #416339"></i>
            </span>
        </div>
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-md-auto pr-md-3">
                <li class="nav-item d-flex justify-content-center align-items-center">
                    <a href="{{ route('orders.create') }}" class="nav-link btn btn-warning btn-link btn-rounded">
                        <i class="fa fa-shopping-cart"></i>
                        Make Order
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('wallet') }}" class="nav-link">
                        <i class="fa fa-google-wallet"></i>
                        <span>Wallet</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('notifications') }}" class="nav-link position-relative">
                        <i class="fa fa-bell"></i>
                        @if($notificationsCount)
                            <span id="notification-counter"
                                  class="badge badge-danger notify-no rounded-circle">{{ $notificationsCount }}</span>
                        @endif
                        <span>Notifications</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('messages.index') }}" class="nav-link position-relative">
                        <i class="fa fa-envelope"></i>
                        @if($messagesCount)
                            <span id="message-counter"
                                  class="badge badge-danger notify-no rounded-circle">{{ $messagesCount }}</span>
                        @endif
                        <span>Messages</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown">
                        {{ Auth::user()->name }}
                        @if(Auth::user()->hasMedia('avatars'))
                            <img class="rounded-circle img-fluid profile-photo ml-2" style="width: 45px"
                                 src="{{ asset(Auth::user()->getFirstMediaUrl('avatars')) }}" alt="{{ Auth::user()->name }}">
                        @else
                            <img class="rounded-circle img-fluid profile-photo ml-2" style="width: 45px"
                                 src="{{ asset('images/default-avatar.png') }}" alt="{{ Auth::user()->name }}">
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('profile') }}">
                            <i class="fa fa-user"></i> Profile
                        </a>
                        <a class="dropdown-item" href="{{ route('settings') }}">
                            <i class="fa fa-cogs"></i> Settings
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout').submit();">
                            <i class="fa fa-power-off"></i> Log out
                        </a>
                        <form id="logout" method="post" action="{{ route('logout') }}" style="display: none">
                            @csrf()
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>

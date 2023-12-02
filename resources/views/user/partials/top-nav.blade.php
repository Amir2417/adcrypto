<nav class="navbar-wrapper">
    <div class="dashboard-title-part">
        <div class="left">
            <div class="icon">
                <button class="sidebar-menu-bar">
                    <i class="fas fa-exchange-alt"></i>
                </button>
            </div>
            <div class="dashboard-path">
                @yield('breadcrumb')
            </div>
        </div>
        <div class="right">
            <form class="header-search-wrapper">
                <div class="position-relative">
                    <input class="form-control" type="text" placeholder="Ex: Buy Crypto, Sell Crypto" aria-label="Search">
                    <span class="las la-search"></span>
                </div>
            </form>
            <div class="header-notification-wrapper">
                <button class="notification-icon">
                    <i class="las la-bell"></i>
                </button>
                <div class="notification-wrapper">
                    <div class="notification-header">
                        <h5 class="title">{{ __("Notification") }}</h5>
                    </div>
                    <ul class="notification-list">
                        @foreach (get_user_notifications() ?? [] as $item)
                            <li>
                                <div class="thumb">
                                    <img src="{{ auth()->user()->userImage }}" alt="user">
                                </div>
                                <div class="content">
                                    <div class="title-area">
                                        <h6 class="title">{{ __("Buy Crypto") }}</h6>
                                        <span class="time">Thu 3.30PM</span>
                                    </div>
                                    <span class="sub-title">Hi, How are you? What about our next meeting</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="header-user-wrapper">
                <div class="header-user-thumb">
                    <a href="{{ setRoute('user.profile.index')}}"><img src="{{ auth()->user()->userImage ?? asset('public/frontend/images/user/user-3.png') }}"  alt="user"></a>
                </div>
            </div>
        </div>
    </div>
</nav>
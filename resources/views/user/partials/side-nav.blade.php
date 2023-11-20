<div class="sidebar">
    <div class="sidebar-inner">
        <div class="sidebar-area">
            <div class="sidebar-logo">
                <a href="{{ setRoute('index') }}" class="sidebar-main-logo">
                    <img src="{{ get_logo($basic_settings) }}" data-white_img="{{ get_logo($basic_settings) }}"
                    data-dark_img="{{ get_logo($basic_settings,"dark") }}" alt="logo">
                </a>
                <button class="sidebar-menu-bar">
                    <i class="fas fa-exchange-alt"></i>
                </button>
            </div>
            <div class="sidebar-menu-wrapper">
                <ul class="sidebar-menu">
                    <li class="sidebar-menu-item">
                        <a href="{{ setRoute('user.dashboard') }}">
                            <i class="menu-icon las la-palette"></i>
                            <span class="menu-title">{{ __("Dashboard") }}</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="{{ setRoute('user.buy.crypto.index') }}">
                            <i class="menu-icon las la-sign"></i>
                            <span class="menu-title">{{ __("Buy Crypto") }}</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="{{ setRoute('user.sell.crypto.index') }}">
                            <i class="menu-icon las la-receipt"></i>
                            <span class="menu-title">{{ __("Sell Crypto") }}</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="withdraw-crypto.html">
                            <i class="menu-icon las la-fill-drip"></i>
                            <span class="menu-title">Withdraw Crypto</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="exchange-crypto.html">
                            <i class="menu-icon lab la-stack-exchange"></i>
                            <span class="menu-title">Exchange Crypto</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item sidebar-dropdown">
                        <a href="javascript:void(0)">
                            <i class="menu-icon las la-wallet"></i>
                            <span class="menu-title">Transactions</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li class="sidebar-menu-item">
                                <a href="buy-log.html" class="nav-link">
                                    <i class="menu-icon las la-ellipsis-h"></i>
                                    <span class="menu-title">Buy Log</span>
                                </a>
                                <a href="sell-log.html" class="nav-link">
                                    <i class="menu-icon las la-ellipsis-h"></i>
                                    <span class="menu-title">Sell Log</span>
                                </a>
                                <a href="withdraw-log.html" class="nav-link">
                                    <i class="menu-icon las la-ellipsis-h"></i>
                                    <span class="menu-title">Withdraw Log</span>
                                </a>
                                <a href="exchange-log.html" class="nav-link">
                                    <i class="menu-icon las la-ellipsis-h"></i>
                                    <span class="menu-title">Exchange Log</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="2fa.html">
                            <i class="menu-icon las la-qrcode"></i>
                            <span class="menu-title">2FA Security</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="javascript:void(0)" class="logout-btn">
                            <i class="menu-icon las la-sign-out-alt"></i>
                            <span class="menu-title">{{ __("Logout") }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="sidebar-doc-box bg_img" data-background="{{ asset('public/frontend') }}/images/element/side-bg.png">
            <div class="sidebar-doc-icon">
                <i class="las la-headset"></i>
            </div>
            <div class="sidebar-doc-content">
                <h5 class="title">{{ __("Help Center") }}</h5>
                <p>{{ __("How can we help you?") }}</p>
                <div class="sidebar-doc-btn">
                    <a href="{{ setRoute('user.support.ticket.index') }}" class="btn--base w-100"><span class="w-100 text-center">{{ __("Get Support") }}</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
<script>
    $(".logout-btn").click(function(){
      
        var actionRoute =  "{{ setRoute('user.logout') }}";
        var target      = 1;
        var message     = `Are you sure to <strong>Logout</strong>?`;
  
        openAlertModal(actionRoute,target,message,"Logout","POST");
    });
  </script>
@endpush
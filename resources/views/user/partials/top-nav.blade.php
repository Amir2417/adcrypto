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
            @php
                $current_url   = URL::current();
            @endphp
            @if ($current_url == setRoute('user.transaction.buy.log') || $current_url == setRoute('user.transaction.sell.log') || $current_url == setRoute('user.transaction.withdraw.log') || $current_url == setRoute('user.transaction.exchange.log'))
                <form class="header-search-wrapper">
                    <div class="position-relative">
                        <input class="form-control" name="search_text" type="text" placeholder="{{ __("Ex: Buy Crypto, Sell Crypto") }}" aria-label="Search">
                        <span class="las la-search"></span>
                    </div>
                </form>
            @endif
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
                                        <h6 class="title">{{ $item->message->title ?? '' }} 
                                        @if (@$item->message->status == global_const()::STATUS_PENDING)
                                            ({{ __("Pending") }})
                                        @elseif (@$item->message->status == global_const()::STATUS_CONFIRM_PAYMENT)
                                            ({{ __("Confirm") }})
                                        @elseif (@$item->message->status == global_const()::STATUS_CANCEL)
                                            ({{ __("Cancel") }})
                                        @elseif (@$item->message->status == global_const()::STATUS_REJECT)
                                            ({{ __("Rejected") }})
                                        @endif
                                        </h6>
                                    </div>
                                    <span class="sub-title">
                                        {{ $item->message->payment ?? auth()->user()->full_name }}, 
                                        {{ __("Amount:") }} {{ $item->message->amount ?? ''}} {{ $item->message->code ?? ''}},
                                        {{ __("Wallet:") }} {{ $item->message->wallet ?? ''}} 
                                        {{ $item->message->success ?? ''}}
                                    </span>
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
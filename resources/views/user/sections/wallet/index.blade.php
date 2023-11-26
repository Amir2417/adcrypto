@extends('user.layouts.master')

@push('css')
    
@endpush

@section('breadcrumb')
    @include('user.components.breadcrumb',['breadcrumbs' => [
        [
            'name'  => __("Dashboard"),
            'url'   => setRoute("user.dashboard"),
        ]
    ], 'active' => __("All Wallets")])
@endsection

@section('content')
<div class="body-wrapper">
    <div class="dashboard-area mt-20">
        <div class="dashboard-header-wrapper">
            <h4 class="title">My Wallets</h4>
        </div>
        <div class="dashboard-item-area">
            <div class="row mb-20-none">
                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-20">
                    <a href="dashboard-item-details.html" class="dashbord-item">
                        <div class="dashboard-content">
                            <span class="sub-title">Bitcoin</span>
                            <h4 class="title">1000.00 <span class="text--danger">BTC</span></h4>
                        </div>
                        <div class="dashboard-icon">
                            <img src="{{ asset('public/frontend') }}/images/flag/btc.jpg" alt="flag">
                        </div>
                    </a>
                </div>
                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-20">
                    <a href="dashboard-item-details.html" class="dashbord-item">
                        <div class="dashboard-content">
                            <span class="sub-title">Ethereum</span>
                            <h4 class="title">500.00 <span class="text--danger">ETH</span></h4>
                        </div>
                        <div class="dashboard-icon">
                            <img src="{{ asset('public/frontend') }}/images/flag/eth.webp" alt="flag">
                        </div>
                    </a>
                </div>
                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-20">
                    <a href="dashboard-item-details.html" class="dashbord-item">
                        <div class="dashboard-content">
                            <span class="sub-title">Tether</span>
                            <h4 class="title">270.00 <span class="text--danger">USDT</span></h4>
                        </div>
                        <div class="dashboard-icon">
                            <img src="{{ asset('public/frontend') }}/images/flag/usdt.webp" alt="flag">
                        </div>
                    </a>
                </div>
                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-20">
                    <a href="dashboard-item-details.html" class="dashbord-item">
                        <div class="dashboard-content">
                            <span class="sub-title">Dogecoin</span>
                            <h4 class="title">100.00 <span class="text--danger">DOGE</span></h4>
                        </div>
                        <div class="dashboard-icon">
                            <img src="{{ asset('public/frontend') }}/images/flag/doge.webp" alt="flag">
                        </div>
                    </a>
                </div>
                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-20">
                    <a href="dashboard-item-details.html" class="dashbord-item">
                        <div class="dashboard-content">
                            <span class="sub-title">Bitcoin</span>
                            <h4 class="title">1000.00 <span class="text--danger">BTC</span></h4>
                        </div>
                        <div class="dashboard-icon">
                            <img src="{{ asset('public/frontend') }}/images/flag/btc.jpg" alt="flag">
                        </div>
                    </a>
                </div>
                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-20">
                    <a href="dashboard-item-details.html" class="dashbord-item">
                        <div class="dashboard-content">
                            <span class="sub-title">Ethereum</span>
                            <h4 class="title">500.00 <span class="text--danger">ETH</span></h4>
                        </div>
                        <div class="dashboard-icon">
                            <img src="{{ asset('public/frontend') }}/images/flag/eth.webp" alt="flag">
                        </div>
                    </a>
                </div>
                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-20">
                    <a href="dashboard-item-details.html" class="dashbord-item">
                        <div class="dashboard-content">
                            <span class="sub-title">Tether</span>
                            <h4 class="title">270.00 <span class="text--danger">USDT</span></h4>
                        </div>
                        <div class="dashboard-icon">
                            <img src="{{ asset('public/frontend') }}/images/flag/usdt.webp" alt="flag">
                        </div>
                    </a>
                </div>
                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-20">
                    <a href="dashboard-item-details.html" class="dashbord-item">
                        <div class="dashboard-content">
                            <span class="sub-title">Dogecoin</span>
                            <h4 class="title">100.00 <span class="text--danger">DOGE</span></h4>
                        </div>
                        <div class="dashboard-icon">
                            <img src="{{ asset('public/frontend') }}/images/flag/doge.webp" alt="flag">
                        </div>
                    </a>
                </div>
                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-20">
                    <a href="dashboard-item-details.html" class="dashbord-item">
                        <div class="dashboard-content">
                            <span class="sub-title">Bitcoin</span>
                            <h4 class="title">1000.00 <span class="text--danger">BTC</span></h4>
                        </div>
                        <div class="dashboard-icon">
                            <img src="{{ asset('public/frontend') }}/images/flag/btc.jpg" alt="flag">
                        </div>
                    </a>
                </div>
                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-20">
                    <a href="dashboard-item-details.html" class="dashbord-item">
                        <div class="dashboard-content">
                            <span class="sub-title">Ethereum</span>
                            <h4 class="title">500.00 <span class="text--danger">ETH</span></h4>
                        </div>
                        <div class="dashboard-icon">
                            <img src="{{ asset('public/frontend') }}/images/flag/eth.webp" alt="flag">
                        </div>
                    </a>
                </div>
                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-20">
                    <a href="dashboard-item-details.html" class="dashbord-item">
                        <div class="dashboard-content">
                            <span class="sub-title">Tether</span>
                            <h4 class="title">270.00 <span class="text--danger">USDT</span></h4>
                        </div>
                        <div class="dashboard-icon">
                            <img src="{{ asset('public/frontend') }}/images/flag/usdt.webp" alt="flag">
                        </div>
                    </a>
                </div>
                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-20">
                    <a href="dashboard-item-details.html" class="dashbord-item">
                        <div class="dashboard-content">
                            <span class="sub-title">Dogecoin</span>
                            <h4 class="title">100.00 <span class="text--danger">DOGE</span></h4>
                        </div>
                        <div class="dashboard-icon">
                            <img src="{{ asset('public/frontend') }}/images/flag/doge.webp" alt="flag">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection

@push('script')

@endpush
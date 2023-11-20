@extends('user.layouts.master')

@push('css')
    
@endpush

@section('breadcrumb')
    @include('user.components.breadcrumb',['breadcrumbs' => [
        [
            'name'  => __("Dashboard"),
            'url'   => setRoute("user.dashboard"),
        ]
    ], 'active' => __("Sell Crypto")])
@endsection

@section('content')
<div class="body-wrapper">
    <div class="row justify-content-center mt-30">
        <div class="col-xxl-6 col-xl-8 col-lg-8">
            <div class="custom-card">
                <div class="dashboard-header-wrapper">
                    <h5 class="title">Sell Crypto</h5>
                </div>
                <div class="card-body">
                    <form action="sell-payment.html" class="card-form">
                        <div class="row justify-content-center">
                            <div class="col-xxl-5 col-xl-7 col-lg-8 form-group">
                                <div class="toggle-container">
                                    <div class="switch-toggles active" data-deactive="deactive">
                                        <input type="hidden" value="1">
                                        <span class="switch" data-value="1">Inside Wallet</span>
                                        <span class="switch" data-value="0">Outside Wallet</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 form-group">
                                <label>Select Coin<span>*</span></label>
                                <div class="custom-select-area">
                                    <div class="custom-select">
                                        <div class="custom-select-inner">
                                            <input type="hidden">
                                            <img src="assets/images/flag/usdt.webp" alt="flag" class="custom-flag">
                                            <span class="custom-currency">USDT</span>
                                        </div>
                                    </div>
                                    <div class="custom-select-wrapper">
                                        <div class="custom-select-search-box">
                                            <div class="custom-select-search-wrapper">
                                                <button type="submit" class="search-btn"><i class="las la-search"></i></button>
                                                <input type="text" class="form--control" placeholder="Search Here...">
                                            </div>
                                        </div>
                                        <div class="custom-select-list-wrapper">
                                            <ul class="custom-select-list">
                                                <li class="custom-option">
                                                    <img src="assets/images/flag/usdt.webp" alt="flag" class="custom-flag">
                                                    <span class="custom-country">Tether</span>
                                                    <span class="custom-currency">USDT</span>
                                                </li>
                                                <li class="custom-option">
                                                    <img src="assets/images/flag/eth.webp" alt="flag" class="custom-flag">
                                                    <span class="custom-country">Ethereum</span>
                                                    <span class="custom-currency">ETH</span>
                                                </li>
                                                <li class="custom-option">
                                                    <img src="assets/images/flag/btc.jpg" alt="flag" class="custom-flag">
                                                    <span class="custom-country">Bitcoin</span>
                                                    <span class="custom-currency">BTC</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 form-group">
                                <label>Select Network<span>*</span></label>
                                <div class="custom-select-area">
                                    <div class="custom-select">
                                        <div class="custom-select-inner">
                                            <input type="hidden">
                                            <span class="custom-currency">BSC</span>
                                        </div>
                                    </div>
                                    <div class="custom-select-wrapper">
                                        <div class="custom-select-search-box">
                                            <div class="custom-select-search-wrapper">
                                                <button type="submit" class="search-btn"><i class="las la-search"></i></button>
                                                <input type="text" class="form--control" placeholder="Search Here...">
                                            </div>
                                        </div>
                                        <div class="custom-select-list-wrapper">
                                            <ul class="custom-select-list">
                                                <li class="custom-option">
                                                    <span class="custom-country">BNB Smart Chain (BEP20)</span>
                                                    <span class="custom-currency">BSC</span>
                                                </li>
                                                <li class="custom-option">
                                                    <span class="custom-country">EOS</span>
                                                    <span class="custom-currency">EOS</span>
                                                </li>
                                                <li class="custom-option">
                                                    <span class="custom-country">NEAR Protocol</span>
                                                    <span class="custom-currency">NEAR</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 form-group">
                                <label>Amount<span>*</span></label>
                                <div class="input-group max">
                                    <input type="text" class="form--control" placeholder="Enter Amount...">
                                    <div class="input-group-text two">Max</div>
                                    <div class="input-group-text">USDT</div>
                                </div>
                                <code class="d-block mt-2">Min Amount : 0.00001 USDT</code>
                            </div>
                            <div class="col-xl-6 col-lg-6 form-group">
                                <label>Receiving Method<span>*</span></label>
                                <select class="form--control nice-select">
                                    <option value="">Select Method</option>
                                    <option value="1">Paypal</option>
                                    <option value="2">Stripe</option>
                                    <option value="3">BTC</option>
                                </select>
                                <code class="d-block mt-2">Rate : 1 USD = 0.00001 USDT</code>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12">
                            <button type="submit" class="btn--base w-100"><span class="w-100">Continue</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
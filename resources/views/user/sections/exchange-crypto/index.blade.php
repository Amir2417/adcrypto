@extends('user.layouts.master')

@push('css')
    
@endpush

@section('breadcrumb')
    @include('user.components.breadcrumb',['breadcrumbs' => [
        [
            'name'  => __("Dashboard"),
            'url'   => setRoute("user.dashboard"),
        ]
    ], 'active' => __("Exchange Crypto")])
@endsection

@section('content')
<div class="body-wrapper">
    <div class="row justify-content-center mt-30">
        <div class="col-xxl-6 col-xl-8 col-lg-8">
            <div class="custom-card">
                <div class="dashboard-header-wrapper">
                    <h5 class="title">Exchange Crypto</h5>
                </div>
                <div class="card-body">
                    <form action="exchange-crypto-preview.html" class="card-form">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 form-group text-center">
                                <div class="exchange-area">
                                    <code class="d-block text-center"><span>Exchange Rate</span> 1 USD = 1.00000000 ETH</code>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 form-group">
                                <label>Exchange From<span>*</span></label>
                                <div class="input-group max">
                                    <input type="text" class="form--control" placeholder="Enter Amount...">
                                    <div class="input-group-text two">Max</div>
                                    <select class="form--control nice-select">
                                        <option value="1">ETH</option>
                                        <option value="2">BTC</option>
                                        <option value="3">USDT</option>
                                    </select>
                                </div>
                                <code class="d-block mt-10">Available Balance 70 USDT</code>
                            </div>
                            <div class="col-xl-6 col-lg-6 form-group">
                                <label>Exchange To<span>*</span></label>
                                <div class="input-group max">
                                    <input type="text" class="form--control" placeholder="Enter Amount...">
                                    <div class="input-group-text two">Max</div>
                                    <select class="form--control nice-select">
                                        <option value="1">BTC</option>
                                        <option value="2">USDT</option>
                                        <option value="3">ETH</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 form-group">
                                <div class="note-area">
                                    <code class="d-block">Limit : 1.00 - 100000 USDT</code>
                                    <code class="d-block">Network Charge : 2.00 USDT = 1%</code>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12">
                            <button type="submit" class="btn--base w-100"><span class="w-100">Exchange Crypto</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('user.layouts.master')

@push('css')
    
@endpush

@section('breadcrumb')
    @include('user.components.breadcrumb',['breadcrumbs' => [
        [
            'name'  => __("Dashboard"),
            'url'   => setRoute("user.dashboard"),
        ]
    ], 'active' => __("Sell Crypto Preview")])
@endsection

@section('content')

<div class="body-wrapper">
    <div class="row justify-content-center mt-30 mb-30-none">
        <div class="col-xl-6 col-lg-6 mb-30">
            <div class="custom-card">
                <div class="dashboard-header-wrapper">
                    <h4 class="title">{{ __("Transactions Summary") }}</h4>
                </div>
                <div class="card-body">
                    <div class="preview-list-wrapper">
                        <div class="preview-list-item">
                            <div class="preview-list-left">
                                <div class="preview-list-user-wrapper">
                                    <div class="preview-list-user-icon">
                                        <i class="las la-keyboard"></i>
                                    </div>
                                    <div class="preview-list-user-content">
                                        <span>{{ __("Wallet Type") }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-list-right">
                                <span>{{ @$data->data->sender_wallet->type }}</span>
                            </div>
                        </div>
                        <div class="preview-list-item">
                            <div class="preview-list-left">
                                <div class="preview-list-user-wrapper">
                                    <div class="preview-list-user-icon">
                                        <i class="las la-coins"></i>
                                    </div>
                                    <div class="preview-list-user-content">
                                        <span>{{ __("Coin") }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-list-right">
                                <span>USDT</span>
                            </div>
                        </div>
                        <div class="preview-list-item">
                            <div class="preview-list-left">
                                <div class="preview-list-user-wrapper">
                                    <div class="preview-list-user-icon">
                                        <i class="las la-network-wired"></i>
                                    </div>
                                    <div class="preview-list-user-content">
                                        <span>{{ __("Network") }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-list-right">
                                <span>BSC</span>
                            </div>
                        </div>
                        <div class="preview-list-item">
                            <div class="preview-list-left">
                                <div class="preview-list-user-wrapper">
                                    <div class="preview-list-user-icon">
                                        <i class="las la-money-check"></i>
                                    </div>
                                    <div class="preview-list-user-content">
                                        <span>{{ __("Receiving Method") }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-list-right">
                                <span>Bank</span>
                            </div>
                        </div>
                        <div class="preview-list-item">
                            <div class="preview-list-left">
                                <div class="preview-list-user-wrapper">
                                    <div class="preview-list-user-icon">
                                        <i class="las la-wallet"></i>
                                    </div>
                                    <div class="preview-list-user-content">
                                        <span>{{ __("Enter Amount") }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-list-right">
                                <span class="text--success">0.05 USDT</span>
                            </div>
                        </div>
                        <div class="preview-list-item">
                            <div class="preview-list-left">
                                <div class="preview-list-user-wrapper">
                                    <div class="preview-list-user-icon">
                                        <i class="las la-exchange-alt"></i>
                                    </div>
                                    <div class="preview-list-user-content">
                                        <span>{{ __("Exchange Rate") }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-list-right">
                                <span class="text--warning">1 USD = 1.00000000 USDT</span>
                            </div>
                        </div>
                        <div class="preview-list-item">
                            <div class="preview-list-left">
                                <div class="preview-list-user-wrapper">
                                    <div class="preview-list-user-icon">
                                        <i class="las la-battery-half"></i>
                                    </div>
                                    <div class="preview-list-user-content">
                                        <span>{{ __("Network Charge") }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-list-right">
                                <span class="text--danger">0.57 USDT</span>
                            </div>
                        </div>
                        <div class="preview-list-item">
                            <div class="preview-list-left">
                                <div class="preview-list-user-wrapper">
                                    <div class="preview-list-user-icon">
                                        <i class="las la-money-check-alt"></i>
                                    </div>
                                    <div class="preview-list-user-content">
                                        <span class="last">{{ __("Total Payable Amount") }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-list-right">
                                <span class="last">0.00005 USDT</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 mb-30">
            <div class="custom-card mb-10">
                <div class="dashboard-header-wrapper">
                    <h4 class="title">{{ __("Payment Proof Summary") }}</h4>
                </div>
                <div class="card-body">
                    <div class="preview-list-wrapper">
                        <div class="preview-list-item">
                            <div class="preview-list-left">
                                <div class="preview-list-user-wrapper">
                                    <div class="preview-list-user-icon">
                                        <i class="las la-compact-disc"></i>
                                    </div>
                                    <div class="preview-list-user-content">
                                        <span>TRX</span>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-list-right">
                                <span>#0194FC</span>
                            </div>
                        </div>
                        <div class="preview-list-item">
                            <div class="preview-list-left">
                                <div class="preview-list-user-wrapper">
                                    <div class="preview-list-user-icon">
                                        <i class="las la-map-marked-alt"></i>
                                    </div>
                                    <div class="preview-list-user-content">
                                        <span>{{ __("From Crypto Address") }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-list-right">
                                <span>TLiHJYVyWt9Ff3aYywuxkD95BAmycmeBug</span>
                            </div>
                        </div>
                        <div class="preview-list-item">
                            <div class="preview-list-left">
                                <div class="preview-list-user-wrapper">
                                    <div class="preview-list-user-icon">
                                        <i class="las la-map-marked-alt"></i>
                                    </div>
                                    <div class="preview-list-user-content">
                                        <span>{{ __("Screenshot") }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-list-right">
                                <span>new-screen.webp</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="custom-card">
                <div class="dashboard-header-wrapper">
                    <h4 class="title">{{ __("Receiving Method Summary") }}</h4>
                </div>
                <div class="card-body">
                    <div class="preview-list-wrapper">
                        <div class="preview-list-item">
                            <div class="preview-list-left">
                                <div class="preview-list-user-wrapper">
                                    <div class="preview-list-user-icon">
                                        <i class="las la-university"></i>
                                    </div>
                                    <div class="preview-list-user-content">
                                        <span>{{ __("Bank Name") }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-list-right">
                                <span>Brac</span>
                            </div>
                        </div>
                        <div class="preview-list-item">
                            <div class="preview-list-left">
                                <div class="preview-list-user-wrapper">
                                    <div class="preview-list-user-icon">
                                        <i class="las la-digital-tachograph"></i>
                                    </div>
                                    <div class="preview-list-user-content">
                                        <span>{{ __("Bank Account Number") }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-list-right">
                                <span>0000 888 0000</span>
                            </div>
                        </div>
                        <div class="preview-list-item">
                            <div class="preview-list-left">
                                <div class="preview-list-user-wrapper">
                                    <div class="preview-list-user-icon">
                                        <i class="las la-city"></i>
                                    </div>
                                    <div class="preview-list-user-content">
                                        <span>{{ __("Bank Branch") }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-list-right">
                                <span>Uttara, Dhaka</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="submit-btn-wrapper">
        <button type="submit" class="btn--base w-100"><span class="w-100">{{ __("Confirm") }}</span></button>
    </div>
</div>
@endsection
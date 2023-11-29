@extends('user.layouts.master')

@push('css')
    
@endpush

@section('breadcrumb')
    @include('user.components.breadcrumb',['breadcrumbs' => [
        [
            'name'  => __("Dashboard"),
            'url'   => setRoute("user.dashboard"),
        ]
    ], 'active' => __("Sell Log")])
@endsection

@section('content')
<div class="body-wrapper">
    <div class="dashboard-list-area mt-20">
        <div class="dashboard-header-wrapper">
            <h4 class="title">Sell Log</h4>
        </div>
        <div class="dashboard-list-wrapper">
            <div class="dashboard-list-item-wrapper">
                <div class="dashboard-list-item sent">
                    <div class="dashboard-list-left">
                        <div class="dashboard-list-user-wrapper">
                            <div class="dashboard-list-user-icon">
                                <i class="las la-arrow-up"></i>
                            </div>
                            <div class="dashboard-list-user-content">
                                <h4 class="title">Sell <span>USDT</span></h4>
                                <span class="sub-title text--danger">Sent <span class="badge badge--warning ms-2">Pending</span></span>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-list-right">
                        <h4 class="main-money text--base mb-0">78.61 USDT</h4>
                    </div>
                </div>
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
                                    <span>From Crypto Address</span>
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
                                    <span>Screenshot</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span>new-screen.webp</span>
                        </div>
                    </div>
                    <div class="preview-list-item">
                        <div class="preview-list-left">
                            <div class="preview-list-user-wrapper">
                                <div class="preview-list-user-icon">
                                    <i class="las la-university"></i>
                                </div>
                                <div class="preview-list-user-content">
                                    <span>Bank Name</span>
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
                                    <span>Bank Account Number</span>
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
                                    <span>Bank Branch</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span>Uttara, Dhaka</span>
                        </div>
                    </div>
                    <div class="preview-list-item">
                        <div class="preview-list-left">
                            <div class="preview-list-user-wrapper">
                                <div class="preview-list-user-icon">
                                    <i class="las la-keyboard"></i>
                                </div>
                                <div class="preview-list-user-content">
                                    <span>Wallet Type</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span>Inside Wallet</span>
                        </div>
                    </div>
                    <div class="preview-list-item">
                        <div class="preview-list-left">
                            <div class="preview-list-user-wrapper">
                                <div class="preview-list-user-icon">
                                    <i class="las la-coins"></i>
                                </div>
                                <div class="preview-list-user-content">
                                    <span>Coin</span>
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
                                    <span>Network</span>
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
                                    <span>Receiving Method</span>
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
                                    <span>Enter Amount</span>
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
                                    <span>Exchange Rate</span>
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
                                    <span>Network Charge</span>
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
                                    <span class="last">Total Payable Amount</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span class="last">0.00005 USDT</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dashboard-list-item-wrapper">
                <div class="dashboard-list-item sent">
                    <div class="dashboard-list-left">
                        <div class="dashboard-list-user-wrapper">
                            <div class="dashboard-list-user-icon">
                                <i class="las la-arrow-up"></i>
                            </div>
                            <div class="dashboard-list-user-content">
                                <h4 class="title">Sell <span>USDT</span></h4>
                                <span class="sub-title text--danger">Sent <span class="badge badge--warning ms-2">Pending</span></span>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-list-right">
                        <h4 class="main-money text--base mb-0">78.61 USDT</h4>
                    </div>
                </div>
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
                                    <span>From Crypto Address</span>
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
                                    <span>Screenshot</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span>new-screen.webp</span>
                        </div>
                    </div>
                    <div class="preview-list-item">
                        <div class="preview-list-left">
                            <div class="preview-list-user-wrapper">
                                <div class="preview-list-user-icon">
                                    <i class="las la-university"></i>
                                </div>
                                <div class="preview-list-user-content">
                                    <span>Bank Name</span>
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
                                    <span>Bank Account Number</span>
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
                                    <span>Bank Branch</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span>Uttara, Dhaka</span>
                        </div>
                    </div>
                    <div class="preview-list-item">
                        <div class="preview-list-left">
                            <div class="preview-list-user-wrapper">
                                <div class="preview-list-user-icon">
                                    <i class="las la-keyboard"></i>
                                </div>
                                <div class="preview-list-user-content">
                                    <span>Wallet Type</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span>Inside Wallet</span>
                        </div>
                    </div>
                    <div class="preview-list-item">
                        <div class="preview-list-left">
                            <div class="preview-list-user-wrapper">
                                <div class="preview-list-user-icon">
                                    <i class="las la-coins"></i>
                                </div>
                                <div class="preview-list-user-content">
                                    <span>Coin</span>
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
                                    <span>Network</span>
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
                                    <span>Receiving Method</span>
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
                                    <span>Enter Amount</span>
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
                                    <span>Exchange Rate</span>
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
                                    <span>Network Charge</span>
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
                                    <span class="last">Total Payable Amount</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span class="last">0.00005 USDT</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dashboard-list-item-wrapper">
                <div class="dashboard-list-item sent">
                    <div class="dashboard-list-left">
                        <div class="dashboard-list-user-wrapper">
                            <div class="dashboard-list-user-icon">
                                <i class="las la-arrow-up"></i>
                            </div>
                            <div class="dashboard-list-user-content">
                                <h4 class="title">Sell <span>USDT</span></h4>
                                <span class="sub-title text--danger">Sent <span class="badge badge--warning ms-2">Pending</span></span>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-list-right">
                        <h4 class="main-money text--base mb-0">78.61 USDT</h4>
                    </div>
                </div>
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
                                    <span>From Crypto Address</span>
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
                                    <span>Screenshot</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span>new-screen.webp</span>
                        </div>
                    </div>
                    <div class="preview-list-item">
                        <div class="preview-list-left">
                            <div class="preview-list-user-wrapper">
                                <div class="preview-list-user-icon">
                                    <i class="las la-university"></i>
                                </div>
                                <div class="preview-list-user-content">
                                    <span>Bank Name</span>
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
                                    <span>Bank Account Number</span>
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
                                    <span>Bank Branch</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span>Uttara, Dhaka</span>
                        </div>
                    </div>
                    <div class="preview-list-item">
                        <div class="preview-list-left">
                            <div class="preview-list-user-wrapper">
                                <div class="preview-list-user-icon">
                                    <i class="las la-keyboard"></i>
                                </div>
                                <div class="preview-list-user-content">
                                    <span>Wallet Type</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span>Inside Wallet</span>
                        </div>
                    </div>
                    <div class="preview-list-item">
                        <div class="preview-list-left">
                            <div class="preview-list-user-wrapper">
                                <div class="preview-list-user-icon">
                                    <i class="las la-coins"></i>
                                </div>
                                <div class="preview-list-user-content">
                                    <span>Coin</span>
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
                                    <span>Network</span>
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
                                    <span>Receiving Method</span>
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
                                    <span>Enter Amount</span>
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
                                    <span>Exchange Rate</span>
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
                                    <span>Network Charge</span>
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
                                    <span class="last">Total Payable Amount</span>
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
</div>
@endsection
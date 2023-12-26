@extends('user.layouts.master')

@push('css')
    
@endpush

@section('breadcrumb')
    @include('user.components.breadcrumb',['breadcrumbs' => [
        [
            'name'  => __("Dashboard"),
            'url'   => setRoute("user.dashboard"),
        ]
    ], 'active' => __("Withdraw Log")])
@endsection

@section('content')

<div class="body-wrapper">
    <div class="dashboard-list-area mt-20">
        <div class="dashboard-header-wrapper">
            <h4 class="title">{{ __("Withdraw Log") }}</h4>
        </div>
        <div class="dashboard-list-wrapper">
            @foreach ($transactions ?? [] as $item)
                <div class="dashboard-list-item-wrapper">
                    <div class="dashboard-list-item sent">
                        <div class="dashboard-list-left">
                            <div class="dashboard-list-user-wrapper">
                                <div class="dashboard-list-user-icon">
                                    <i class="las la-arrow-up"></i>
                                </div>
                                <div class="dashboard-list-user-content">
                                    <h4 class="title">{{ $item->type ?? '' }} <span>{{ $item->details->data->sender_wallet->code ?? '' }}</span></h4>
                                    <span class="sub-title text--danger">{{ __("Sent") }} 
                                        <span class="badge badge--warning ms-2">
                                            @if ($item->status == global_const()::STATUS_REVIEW_PAYMENT)
                                                <span>{{ __("Review Payment") }}</span> 
                                            @elseif ($item->status == global_const()::STATUS_PENDING)
                                                <span>{{ __("Pending") }}</span>
                                            @elseif ($item->status == global_const()::STATUS_CONFIRM_PAYMENT)
                                                <span>{{ __("Confirm Payment") }}</span>
                                            @elseif ($item->status == global_const()::STATUS_HOLD)
                                                <span>{{ __("On Hold") }}</span>
                                            @elseif ($item->status == global_const()::STATUS_SETTLED)
                                                <span>{{ __("Settled") }}</span>
                                            @elseif ($item->status == global_const()::STATUS_COMPLETE)
                                                <span>{{ __("Completed") }}</span>
                                            @elseif ($item->status == global_const()::STATUS_CANCEL)
                                                <span>{{ __("Canceled") }}</span>
                                            @elseif ($item->status == global_const()::STATUS_FAILED)
                                                <span>{{ __("Failed") }}</span>
                                            @elseif ($item->status == global_const()::STATUS_REFUND)
                                                <span>{{ __("Refunded") }}</span>
                                            @else
                                                <span>{{ __("Delayed") }}</span>
                                            @endif
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard-list-right">
                            <h4 class="main-money text--base mb-0">{{ get_amount($item->details->data->will_get,$item->details->data->sender_wallet->code) ?? '' }} </h4>
                        </div>
                    </div>
                    <div class="preview-list-wrapper">
                        <div class="preview-list-item">
                            <div class="preview-list-left">
                                <div class="preview-list-user-wrapper">
                                    <div class="preview-list-user-icon">
                                        <i class="las la-map-marked-alt"></i>
                                    </div>
                                    <div class="preview-list-user-content">
                                        <span>{{ __("Wallet Address") }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-list-right">
                                <span>{{ $item->details->data->receiver_wallet->address ?? '' }}</span>
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
                                <span class="text--success">{{ get_amount($item->amount,$item->details->data->sender_wallet->code) ?? '' }}</span>
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
                                <span class="text--warning">{{ get_amount($item->details->data->sender_ex_rate,$item->details->data->sender_wallet->code) ?? '' }} = {{ get_amount($item->details->data->exchange_rate,$item->details->data->receiver_wallet->code) ?? '' }}</span>
                            </div>
                        </div>
                        <div class="preview-list-item">
                            <div class="preview-list-left">
                                <div class="preview-list-user-wrapper">
                                    <div class="preview-list-user-icon">
                                        <i class="las la-battery-half"></i>
                                    </div>
                                    <div class="preview-list-user-content">
                                        <span>{{ __("Network Fees") }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-list-right">
                                <span class="text--danger">{{ get_amount($item->details->data->total_charge,$item->details->data->sender_wallet->code) ?? '' }}</span>
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
                                <span class="last">{{ get_amount($item->details->data->payable_amount,$item->details->data->sender_wallet->code) ?? '' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
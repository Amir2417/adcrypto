@extends('admin.layouts.master')

@push('css')

    <style>
        .fileholder {
            min-height: 374px !important;
        }

        .fileholder-files-view-wrp.accept-single-file .fileholder-single-file-view,.fileholder-files-view-wrp.fileholder-perview-single .fileholder-single-file-view{
            height: 330px !important;
        }
    </style>
@endpush

@section('page-title')
    @include('admin.components.page-title',['title' => __($page_title)])
@endsection

@section('breadcrumb')
    @include('admin.components.breadcrumb',['breadcrumbs' => [
        [
            'name'  => __("Dashboard"),
            'url'   => setRoute("admin.dashboard"),
        ],
        
    ], 'active' => __("Buy Crypto Log Details")])
@endsection

@section('content')
<div class="row mb-30-none">
    
    <div class="col-lg-6 mb-30">
        <div class="transaction-area">
            <h4 class="title mb-0"><i class="fas fa-user text--base me-2"></i>{{ __("Sender Information") }}</h4>
            <div class="content pt-0">
                <div class="list-wrapper">
                    <ul class="list">
                        <li>{{ __("Name") }}<span>{{ $transaction->user->full_name ?? '' }}</span></li>
                        <li>{{ __("Email") }}<span class="text-lowercase">{{ $transaction->user->email ?? '' }}</span></li>
                        <li>{{ __("Wallet Type") }}<span>{{ $transaction->details->data->wallet->type ?? '' }}</span></li>
                        <li>{{ __("Wallet Name") }}<span>{{ $transaction->details->data->wallet->name ?? "" }} ({{ $transaction->details->data->wallet->code ?? "" }})</span></li>
                        <li>{{ __("Network Name") }}<span>{{ $transaction->details->data->network->name ?? "" }}</span></li>
                        <li>{{ __("Arrival Time") }}<span>{{ $transaction->details->data->network->arrival_time ?? "" }} min</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-30">
        <div class="transaction-area">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="title mb-0"><i class="fas fa-user text--base me-2"></i>{{ __("Transaction Device Information") }}</h4>
            </div>
            <div class="content pt-0">
                <div class="list-wrapper">
                    <ul class="list">
                        <li>{{ __("IP") }}<span>{{ $transaction_device->ip ?? '' }}</span></li>
                        <li>{{ __("Country") }}<span>{{ $transaction_device->country ?? '' }}</span></li>
                        <li>{{ __("City") }}<span>{{ $transaction_device->city ?? '' }}</span></li>
                        <li>{{ __("Browser") }}<span>{{ $transaction_device->browser ?? '' }}</span></li>
                        <li>{{ __("OS") }}<span>{{ $transaction_device->os ?? '' }}</span></li>
                        <li>{{ __("TimeZone") }}<span>{{ $transaction_device->timezone ?? '' }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 mb-30">
        <div class="transaction-area">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="title"><i class="fas fa-user text--base me-2"></i>{{ __("Payment Summary") }}</h4>
            </div>
            <div class="content pt-0">
                <div class="list-wrapper">
                    <ul class="list">
                        <li>{{ __("Transaction Number") }} <span>{{ $transaction->trx_id ?? ''  }}</span> </li>
                        <li>{{ __("Transaction Type") }} <span>{{ $transaction->type ?? ''  }}</span> </li>
                        <li>{{ __("Payment Gateway") }} <span>{{ $transaction->currency->name ?? ''  }}</span> </li>
                        <li>{{ __("Send Amount") }} <span>{{ get_amount($transaction->amount,$transaction->details->data->wallet->code)  }}</span> </li>
                        <li>{{ __("Total Charge") }} <span>{{ get_amount($transaction->total_charge,$transaction->details->data->wallet->code)  }}</span> </li>
                        <li>{{ __("Payable Amount") }} <span>{{ get_amount($transaction->total_payable,$transaction->currency_code)  }}</span> </li>
                        <li>{{ __("Payment Status") }}
                            @if ($transaction->status == global_const()::STATUS_PENDING)
                                <span>{{ __("Pending") }}</span>
                            @elseif ($transaction->status == global_const()::STATUS_CONFIRM_PAYMENT)
                                <span>{{ __("Confirm Payment") }}</span>
                            @elseif ($transaction->status == global_const()::STATUS_COMPLETE)
                                <span>{{ __("Completed") }}</span>
                            @elseif ($transaction->status == global_const()::STATUS_CANCEL)
                                <span>{{ __("Canceled") }}</span>
                            @else
                                <span>{{ __("Delayed") }}</span>
                            @endif
                        </li>
                        <li>{{ __("Remark") }} <span>{{ $transaction->remark ?? 'N/A' }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ setRoute('admin.buy.crypto.status.update',$transaction->trx_id) }}" method="post">
        @csrf
        <div class="col-lg-12 mb-30">
            <div class="transaction-area">
                <h4 class="title"><i class="fas fa-user text--base me-2"></i>{{ __("Progress of Buy Crypto Transactions") }}</h4>
                <div class="content pt-0">
                    <div class="radio-area d-flex justify-content-between mb-2">
                        <div class="radio-wrapper">
                            <div class="radio-item">
                                <input type="radio" id="level-1" value="1" @if($transaction->status == global_const()::STATUS_PENDING) checked @endif name="status">
                                <label for="level-1">{{ __("Pending") }}</label>
                            </div>
                        </div>
                        <div class="radio-wrapper">
                            <div class="radio-item">
                                <input type="radio" id="level-2" value="2" @if($transaction->status == global_const()::STATUS_CONFIRM_PAYMENT) checked @endif name="status">
                                <label for="level-2">{{ __("Confirm Payment") }}</label>
                            </div>
                        </div>
                        
                        <div class="radio-wrapper">
                            <div class="radio-item">
                                <input type="radio" id="level-3" value="3" @if($transaction->status == global_const()::STATUS_COMPLETE) checked @endif name="status">
                                <label for="level-3">{{ __("Completed") }}</label>
                            </div>
                        </div>
                        <div class="radio-wrapper">
                            <div class="radio-item">
                                <input type="radio" id="level-4" value="4" @if($transaction->status == global_const()::STATUS_CANCEL) checked @endif name="status">
                                <label for="level-4">{{ __("Canceled") }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 form-group">
                        @include('admin.components.button.form-btn',[
                            'class'         => "w-100 btn-loading",
                            'text'          => "Update",
                        ])
                    </div>
                </div>
            </div>
        </div>
    </form>
    
</div>
@endsection
@push('script')
    <script>
        $('.copy').on('click',function(){
            
            let input = $('.box').val();
            navigator.clipboard.writeText(input)
            .then(function() {
                
                $('.copy').text("Copied");
            })
            .catch(function(err) {
                console.error('Copy failed:', err);
            });
        });
    </script>
@endpush
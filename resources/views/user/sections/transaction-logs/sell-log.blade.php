@extends('user.layouts.master')

@push('css')
<style>
    .image-resize{
        width: 20px;
        height: 25px;
    }
</style>
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
            <h4 class="title">{{ __("Sell Log") }}</h4>
        </div>
        <div class="dashboard-list-wrapper" id="transaction-results">
            @forelse ($transactions ?? [] as $item)
                <div class="dashboard-list-item-wrapper">
                    <div class="dashboard-list-item sent">
                        <div class="dashboard-list-left">
                            <div class="dashboard-list-user-wrapper">
                                <div class="dashboard-list-user-icon">
                                    <i class="las la-arrow-up"></i>
                                </div>
                                <div class="dashboard-list-user-content">
                                    <h4 class="title">{{ __("Sell") }} <span>{{ $item->details->data->sender_wallet->name ?? '' }}</span></h4>
                                    <span class="sub-title text--danger">{{ $item->details->data->sender_wallet->type ?? '' }} <span class="badge badge--warning ms-2">
                                        @if ($item->status == global_const()::STATUS_PENDING)
                                            <span>{{ __("Pending") }}</span>
                                        @elseif ($item->status == global_const()::STATUS_CONFIRM_PAYMENT)
                                            <span>{{ __("Confirm Payment") }}</span>
                                        @elseif ($item->status == global_const()::STATUS_CANCEL)
                                            <span>{{ __("Canceled") }}</span>
                                        @elseif ($item->status == global_const()::STATUS_REJECT)
                                            <span>{{ __("Reject") }}</span>
                                        @else
                                            <span>{{ __("Delayed") }}</span>
                                        @endif
                                    </span></span>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard-list-right">
                            <h4 class="main-money text--base mb-0">{{ get_amount($item->amount,$item->details->data->sender_wallet->code) }}</h4>
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
                                        <span>{{ __("TRX ID") }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-list-right">
                                <span>{{ $item->trx_id ?? '' }}</span>
                            </div>
                        </div>
                        @if ($item->details->data->sender_wallet->type == global_const()::OUTSIDE_WALLET)
                            @php
                                $details   = json_decode($item->details->data->details);
                            @endphp
                            @foreach ($details->outside_address_input_values ?? [] as $data)
                            <div class="preview-list-item">
                                <div class="preview-list-left">
                                    <div class="preview-list-user-wrapper">
                                        <div class="preview-list-user-icon">
                                            <i class="las la-map-marked-alt"></i>
                                        </div>
                                        <div class="preview-list-user-content">
                                            <span>{{ @$data->label }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="preview-list-right">
                                    @if (@$data->type == "text" || @$data->type == "textarea")
                                        <span>{{ @$data->value }}</span>
                                    @elseif (@$data->type == "file")
                                        <img class="image-resize" src="{{ get_image(@$data->value , 'kyc-files') }}" alt="" srcset="">
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        @endif
                        
                        @php
                            $details   = json_decode($item->details->data->details);
                        @endphp
                        @foreach ($details->gateway_input_values ?? [] as $data)
                            <div class="preview-list-item">
                                <div class="preview-list-left">
                                    <div class="preview-list-user-wrapper">
                                        <div class="preview-list-user-icon">
                                            <i class="las la-university"></i>
                                        </div>
                                        <div class="preview-list-user-content">
                                            <span>{{ @$data->label }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="preview-list-right">
                                    @if (@$data->type == "text" || @$data->type == "textarea")
                                        <span>{{ @$data->value }}</span>
                                    @elseif (@$data->type == "file")
                                        <img class="image-resize" src="{{ get_image(@$data->value , 'kyc-files') }}" alt="" srcset="">
                                    @endif
                                </div>
                            </div>
                        @endforeach
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
                                <span>{{ @$item->details->data->sender_wallet->type }}</span>
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
                                <span>{{ @$item->details->data->sender_wallet->name }} ({{ @$item->details->data->sender_wallet->code }})</span>
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
                                <span>{{ @$item->details->data->network->name }}</span>
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
                                <span>{{ @$item->details->data->payment_method->name }}</span>
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
                                <span class="text--success">{{ get_amount(@$item->amount,@$item->details->data->sender_wallet->code) }}</span>
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
                                <span class="text--warning">1 {{ @$item->details->data->sender_wallet->code }} = {{ get_amount(@$item->details->data->exchange_rate,@$item->details->data->payment_method->code) }}</span>
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
                                <span class="text--danger">{{ get_amount(@$item->total_charges,@$item->details->data->sender_wallet->code) }}</span>
                            </div>
                        </div>
                        <div class="preview-list-item">
                            <div class="preview-list-left">
                                <div class="preview-list-user-wrapper">
                                    <div class="preview-list-user-icon">
                                        <i class="las la-money-check-alt"></i>
                                    </div>
                                    <div class="preview-list-user-content">
                                        <span class="last">{{ ("Total Payable Amount") }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-list-right">
                                <span class="last">{{ get_amount(@$item->total_payable,@$item->details->data->sender_wallet->code) }}</span>
                            </div>
                        </div>
                        @if ($item->status == global_const()::STATUS_REJECT)
                            <div class="preview-list-item">
                                <div class="preview-list-left">
                                    <div class="preview-list-user-wrapper">
                                        <div class="preview-list-user-icon">
                                            <i class="las la-money-check-alt"></i>
                                        </div>
                                        <div class="preview-list-user-content">
                                            <span class="last">{{ __("Reject Reason") }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="preview-list-right">
                                    <span class="last">{{ $item->reject_reason ?? '' }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="alert alert-primary text-center">
                    {{ __("Transaction data not found!") }}
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
@push('script')
    <script>
        $("#transaction-search").keyup(function(){
            var url = '{{ route('user.transaction.search.sell.log') }}';
            var value = $(this).val();
            var token = '{{ csrf_token() }}';
            $.post(url,{search_text:value,_token:token},function(response){
                updateTransactionsOnPage(response);
            });
        });
        function updateTransactionsOnPage(response) {
            var transactionResults = $("#transaction-results");
            transactionResults.empty();
            var transactions = response.transactions;
            
            if(transactions.length > 0){
                transactions.forEach(function(transaction) {
                    var transactionHtml = createTransactionHtml(transaction);
                    transactionResults.append(transactionHtml);
                });
            }else{
                var transactionHtml = createNoData();
                transactionResults.append(transactionHtml);
            } 
        }
        function createTransactionHtml(transaction, senderCurrency, receiverCurrency) {
            var data        = JSON.parse(transaction.details.data.details);
            var asset       = "{{ files_asset_path('kyc-files') }}";
            console.log(data.outside_address_input_values);
            var transactionHtml = `<div class="dashboard-list-item-wrapper">
                    <div class="dashboard-list-item sent">
                        <div class="dashboard-list-left">
                            <div class="dashboard-list-user-wrapper">
                                <div class="dashboard-list-user-icon">
                                    <i class="las la-arrow-up"></i>
                                </div>
                                <div class="dashboard-list-user-content">
                                    <h4 class="title">{{ __("Buy") }} <span>${transaction.details.data.sender_wallet.name} (${transaction.details.data.sender_wallet.code})</span></h4>
                                    <span class="sub-title text--danger">${transaction.type} 
                                        <span class="badge badge--warning ms-2">
                                            ${getStatusBadge(transaction.status)}
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard-list-right">
                            <h4 class="main-money text--base mb-0">${parseFloat(transaction.amount).toFixed(2)} ${transaction.details.data.sender_wallet.code}</h4>
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
                                        <span>{{ __("TRX ID") }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-list-right">
                                <span>${transaction.trx_id}</span>
                            </div>
                        </div>
                        ${data.outside_address_input_values.map(function(item){
                            return `<div class="preview-list-item">
                                <div class="preview-list-left">
                                    <div class="preview-list-user-wrapper">
                                        <div class="preview-list-user-icon">
                                            <i class="las la-map-marked-alt"></i>
                                        </div>
                                        <div class="preview-list-user-content">
                                            <span>${item.label}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="preview-list-right">
                                    ${(item.type == "text" || item.type == "textarea") ? `<span>${item.value}</span>` : ``}
                                    ${(item.type == "file") ? `<img class="image-resize" src="${asset}/${item.value}" alt="" srcset="">` : ``}
                                </div>
                            </div>`;
                        }).join('')}
                        ${data.gateway_input_values.map(function(item){
                            return `<div class="preview-list-item">
                                <div class="preview-list-left">
                                    <div class="preview-list-user-wrapper">
                                        <div class="preview-list-user-icon">
                                            <i class="las la-university"></i>
                                        </div>
                                        <div class="preview-list-user-content">
                                            <span>${item.label}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="preview-list-right">
                                    ${(item.type == "text" || item.type == "textarea") ? `<span>${item.value}</span>` : ``}
                                    ${(item.type == "file") ? `<img class="image-resize" src="${asset}/${item.value}" alt="" srcset="">` : ``}
                                </div>
                            </div>`;
                        }).join('')}
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
                                <span>${transaction.details.data.sender_wallet.type}</span>
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
                                <span>${transaction.details.data.sender_wallet.name} (${transaction.details.data.sender_wallet.code})</span>
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
                                <span>${transaction.details.data.network.name}</span>
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
                                <span>${transaction.details.data.payment_method.name}</span>
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
                                <span class="text--success">${parseFloat(transaction.amount).toFixed(4)}${transaction.details.data.sender_wallet.code}</span>
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
                                <span class="text--warning">1 ${transaction.details.data.sender_wallet.code} = ${transaction.details.data.exchange_rate} ${transaction.details.data.payment_method.code}</span>
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
                                <span class="text--danger">${parseFloat(transaction.total_charge).toFixed(4)}${transaction.details.data.sender_wallet.code}</span>
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
                                <span class="last">${parseFloat(transaction.total_payable).toFixed(4)}${transaction.details.data.payment_method.code}</span>
                            </div>
                        </div>
                        ${(transaction.status == 4) ? 
                            `<div class="preview-list-item">
                                <div class="preview-list-left">
                                    <div class="preview-list-user-wrapper">
                                        <div class="preview-list-user-icon">
                                            <i class="las la-stop-circle"></i>
                                        </div>
                                        <div class="preview-list-user-content">
                                            <span class="last">{{ __("Reject Reason") }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="preview-list-right">
                                    <span class="last">${transaction.reject_reason}</span>
                                </div>
                            </div>` : ``}
                    </div>
                </div>`;
               
            return transactionHtml;
                
        }
        function createNoData(){
            var transactionHtml = `<div class="alert alert-primary text-center">
            Transaction Log Not Found!
            </div>`;
            
            return transactionHtml;
            
        }
        function getStatusBadge(status) {
            if (status === {{ global_const()::STATUS_PENDING }}) {
                return "{{ __("Pending") }}";
            } else if (status === {{ global_const()::STATUS_CONFIRM_PAYMENT }}) {
                return "{{ __("Confirm Payment") }}";
            } else if (status === {{ global_const()::STATUS_CANCEL }}) {
                return "{{ __("Cancel") }}";
            } else {
                return "{{ __("Reject") }}";
            }
        }
    </script>
@endpush
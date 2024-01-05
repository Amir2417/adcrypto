@extends('user.layouts.master')

@push('css')
    
@endpush

@section('breadcrumb')
    @include('user.components.breadcrumb',['breadcrumbs' => [
        [
            'name'  => __("Dashboard"),
            'url'   => setRoute("user.dashboard"),
        ]
    ], 'active' => __("Buy Log")])
@endsection

@section('content')
<div class="body-wrapper">
    <div class="dashboard-list-area mt-20">
        <div class="dashboard-header-wrapper">
            <h4 class="title">{{ __("Buy Log") }}</h4>
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
                                    <h4 class="title">{{ __("Buy") }} <span>{{ $item->details->data->wallet->name ?? '' }} ({{ $item->details->data->wallet->code ?? '' }})</span></h4>
                                    <span class="sub-title text--danger">{{ $item->type ?? '' }} 
                                        <span class="badge badge--warning ms-2">
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
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard-list-right">
                            <h4 class="main-money text--base mb-0">{{ get_amount($item->amount,$item->details->data->wallet->code,8) ?? '' }}</h4>
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
                                <span>{{ $item->details->data->wallet->type ?? '' }}</span>
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
                                <span>{{ $item->details->data->wallet->name ?? '' }} ({{ $item->details->data->wallet->code }})</span>
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
                                <span>{{ $item->details->data->network->name ?? '' }}</span>
                            </div>
                        </div>
                        @if ($item->details->data->wallet->type == global_const()::OUTSIDE_WALLET)
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
                                    <span>{{ $item->details->data->wallet->address ?? '' }}</span>
                                </div>
                            </div>
                        @endif
                        <div class="preview-list-item">
                            <div class="preview-list-left">
                                <div class="preview-list-user-wrapper">
                                    <div class="preview-list-user-icon">
                                        <i class="las la-money-check"></i>
                                    </div>
                                    <div class="preview-list-user-content">
                                        <span>{{ __("Payment Gateway") }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-list-right">
                                <span>{{ $item->details->data->payment_method->name ?? '' }}</span>
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
                                <span class="text--success">{{ get_amount($item->amount) }} {{ $item->details->data->wallet->code ?? '' }}</span>
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
                                <span class="text--warning">1 {{ $item->details->data->wallet->code ?? '' }} = {{ $item->details->data->exchange_rate ?? '' }} {{ $item->details->data->payment_method->code ?? '' }}</span>
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
                                <span class="text--danger">{{ get_amount($item->total_charge,$item->details->data->wallet->code,4) ?? '' }}</span>
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
                                <span class="last">{{ get_amount($item->total_payable,$item->details->data->wallet->code,8) ?? '' }}</span>
                            </div>
                        </div>
                        @if ($item->currency->gateway->isTatum($item->currency->gateway) && $item->status == global_const()::STATUS_PENDING)
                            <div class="col-12">
                                <form action="{{ setRoute('user.buy.crypto.payment.crypto.confirm', $item->trx_id) }}" method="POST">
                                    @csrf
                                    @php
                                        $input_fields = $item->details->payment_info->requirements ?? [];
                                    @endphp

                                    @foreach ($input_fields as $input)
                                        <div class="">
                                            <h4 class="mb-0">{{ $input->label }}</h4>
                                            <input type="text" class="form-control" name="{{ $input->name }}" placeholder="{{ $input->placeholder ?? "" }}">
                                        </div>
                                    @endforeach

                                    <div class="text-end">
                                        <button type="submit" class="btn--base my-2">{{ __("Process") }}</button>
                                    </div>

                                </form>
                            </div>
                        @endif
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
            var url = '{{ route('user.transaction.search.buy.log') }}';
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
            var transactionHtml = `<div class="dashboard-list-item-wrapper">
                    <div class="dashboard-list-item sent">
                        <div class="dashboard-list-left">
                            <div class="dashboard-list-user-wrapper">
                                <div class="dashboard-list-user-icon">
                                    <i class="las la-arrow-up"></i>
                                </div>
                                <div class="dashboard-list-user-content">
                                    <h4 class="title">{{ __("Buy") }} <span>${transaction.details.data.wallet.name} (${transaction.details.data.wallet.code})</span></h4>
                                    <span class="sub-title text--danger">${transaction.type} 
                                        <span class="badge badge--warning ms-2">
                                            ${getStatusBadge(transaction.status)}
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard-list-right">
                            <h4 class="main-money text--base mb-0">${parseFloat(transaction.amount).toFixed(2)} ${transaction.details.data.wallet.code}</h4>
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
                                <span>${transaction.details.data.wallet.type}</span>
                            </div>
                        </div>
                        ${(transaction.details.data.wallet.type == "Outside Wallet") ? `<div class="preview-list-item">
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
                                <span>${transaction.details.data.wallet.address}</span>
                            </div>
                        </div>` : ``}
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
                                <span>${transaction.details.data.wallet.name} (${transaction.details.data.wallet.code})</span>
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
                                        <span>{{ __("Payment Gateway") }}</span>
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
                                <span class="text--success">${transaction.amount}${transaction.details.data.wallet.code}</span>
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
                                <span class="text--warning">1 ${transaction.details.data.wallet.code} = ${transaction.details.data.exchange_rate} ${transaction.details.data.payment_method.code}</span>
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
                                <span class="text--danger">${transaction.total_charge}${transaction.details.data.wallet.code}</span>
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
                                <span class="last">${transaction.total_payable}${transaction.details.data.payment_method.code}</span>
                            </div>
                        </div>
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
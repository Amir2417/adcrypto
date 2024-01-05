@extends('user.layouts.master')

@push('css')
    
@endpush

@section('breadcrumb')
    @include('user.components.breadcrumb',['breadcrumbs' => [
        [
            'name'  => __("Dashboard"),
            'url'   => setRoute("user.dashboard"),
        ]
    ], 'active' => __("Exchange Log")])
@endsection

@section('content')

<div class="body-wrapper">
    <div class="dashboard-list-area mt-20">
        <div class="dashboard-header-wrapper">
            <h4 class="title">{{ __("Exchange Log") }}</h4>
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
                                    <h4 class="title">{{ $item->type ?? '' }} <span>{{ $item->details->data->sender_wallet->name ?? '' }} ({{ $item->details->data->sender_wallet->code ?? '' }})</span></h4>
                                    <span class="sub-title text--danger">{{ __("Sent") }} 
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
                            <h4 class="main-money text--base">{{ $item->details->data->sending_amount ?? '' }} {{ $item->details->data->sender_wallet->code ?? '' }}</h4>
                            <h6 class="exchange-money">{{ $item->details->data->get_amount ?? '' }} {{ $item->details->data->receiver_wallet->code ?? '' }}</h6>
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
                                        <span>{{ __("From Wallet") }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-list-right">
                                <span>{{ $item->details->data->sender_wallet->name ?? '' }} ({{ $item->details->data->sender_wallet->code ?? '' }})</span>
                            </div>
                        </div>
                        <div class="preview-list-item">
                            <div class="preview-list-left">
                                <div class="preview-list-user-wrapper">
                                    <div class="preview-list-user-icon">
                                        <i class="las la-hockey-puck"></i>
                                    </div>
                                    <div class="preview-list-user-content">
                                        <span>{{ __("To Wallet") }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-list-right">
                                <span>{{ $item->details->data->receiver_wallet->name ?? '' }} ({{ $item->details->data->receiver_wallet->code ?? '' }})</span>
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
                                <span class="text--success">{{ $item->details->data->sending_amount ?? '' }} {{ $item->details->data->sender_wallet->code ?? '' }}</span>
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
                                <span class="text--warning">1 {{ $item->details->data->sender_wallet->code ?? '' }} = {{ get_amount($item->details->data->exchange_rate,$item->details->data->receiver_wallet->code) }}</span>
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
                                <span class="text--danger">{{ $item->details->data->total_charge ?? '' }} {{ $item->details->data->sender_wallet->code ?? '' }}</span>
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
                                <span class="last">{{ $item->details->data->payable_amount ?? '' }} {{ $item->details->data->sender_wallet->code ?? '' }}</span>
                            </div>
                        </div>
                        @if ($item->status == global_const()::STATUS_REJECT)
                            <div class="preview-list-item">
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
            var url = '{{ route('user.transaction.search.exchange.log') }}';
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
                                    <h4 class="title">${transaction.type} <span>${ transaction.details.data.sender_wallet.name} (${transaction.details.data.sender_wallet.code})</span></h4>
                                    <span class="sub-title text--danger">{{ __("Sent") }} 
                                        <span class="badge badge--warning ms-2">
                                            ${getStatusBadge(transaction.status)}
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard-list-right">
                            <h4 class="main-money text--base">${transaction.amount} ${transaction.details.data.sender_wallet.code}</h4>
                            <h6 class="exchange-money">${transaction.details.data.get_amount} ${transaction.details.data.receiver_wallet.code}</h6>
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
                                        <span>{{ __("From Wallet") }}</span>
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
                                        <i class="las la-hockey-puck"></i>
                                    </div>
                                    <div class="preview-list-user-content">
                                        <span>{{ __("To Wallet") }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-list-right">
                                <span>${transaction.details.data.receiver_wallet.name} (${transaction.details.data.receiver_wallet.code})</span>
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
                                <span class="text--success">${transaction.amount} ${transaction.details.data.sender_wallet.code}</span>
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
                                <span class="text--warning">1 ${transaction.details.data.sender_wallet.code} = ${transaction.details.data.exchange_rate} ${transaction.details.data.receiver_wallet.code}</span>
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
                                <span class="text--danger">${transaction.details.data.total_charge} ${transaction.details.data.sender_wallet.code}</span>
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
                                <span class="last">${transaction.details.data.payable_amount} ${transaction.details.data.sender_wallet.code}</span>
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
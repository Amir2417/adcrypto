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
        <div class="col-xxl-12 col-xl-12 col-lg-12">
            <div class="custom-card">
                <div class="dashboard-header-wrapper">
                    <h5 class="title">{{ __("Exchange Crypto") }}</h5>
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
                                <label>{{ __("Exchange From") }}<span>*</span></label>
                                <div class="input-group max">
                                    <input type="text" class="form--control" name="send_amount" placeholder="Enter Amount...">
                                    <div class="input-group-text two max-amount">{{ __("Max") }}</div>
                                    <select class="form--control nice-select" name="sender_wallet">
                                        @foreach ($currencies as $item)
                                            <option 
                                            value="{{ $item->currency->id }}"
                                                data-balance="{{ $item->balance }}"
                                                data-rate="{{ $item->currency->rate }}"
                                                data-code="{{ $item->currency->code }}"
                                                >{{ $item->currency->code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <code class="d-block mt-10 available-balance">Available Balance 70 USDT</code>
                            </div>
                            <div class="col-xl-6 col-lg-6 form-group">
                                <label>{{ __("Exchange To") }}<span>*</span></label>
                                <div class="input-group max">
                                    <input type="text" class="form--control" name="receive-money" placeholder="Enter Amount...">
                                    <select class="form--control nice-select" name="receiver_currency">
                                        @foreach ($currencies as $item)
                                            <option 
                                            value="{{ $item->currency->id }}"
                                            data-code="{{ $item->currency->code }}"
                                            data-rate="{{ $item->currency->rate }}"
                                            data-balance="{{ $item->balance }}"
                                            >{{ $item->currency->code }}</option>
                                        @endforeach
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

@push('script')
    <script>
        $("select[name=sender_wallet]").change(function(){
            getExchangeRate();
        });
        $(document).on('click','.max-amount',function(){
            var walletMaxBalance = selectedVariable().senderWalletBalance;
            console.log("wallet max balance",walletMaxBalance);
        });
        function selectedVariable(){
            var senderCurrency   = $("select[name=sender_wallet] :selected").data('code');
            var senderRate      = $("select[name=sender_wallet] :selected").data('rate');
            var senderWalletBalance   = $("select[name=sender_wallet] :selected").data('balance');
            var receiverCurrency        = $("select[name=receiver_currency] :selected").data("code");
            var receiverRate            = $("select[name=receiver_currency] :selected").data("rate");
            var receiverBalance            = $("select[name=receiver_currency] :selected").data("balance");


            
            return {
                senderCurrency:senderCurrency,
                senderRate:senderRate,
                senderWalletBalance:senderWalletBalance,
                receiverCurrency:receiverCurrency,
                receiverRate:receiverRate,
                receiverBalance:receiverBalance
            };
        }
    </script>
@endpush
@extends('user.layouts.master')

@push('css')
    
@endpush

@section('breadcrumb')
    @include('user.components.breadcrumb',['breadcrumbs' => [
        [
            'name'  => __("Dashboard"),
            'url'   => setRoute("user.dashboard"),
        ]
    ], 'active' => __("Withdraw Crypto")])
@endsection

@section('content')
<div class="body-wrapper">
    <div class="row justify-content-center mt-30">
        <div class="col-xxl-6 col-xl-8 col-lg-8">
            <div class="custom-card">
                <div class="dashboard-header-wrapper">
                    <h5 class="title">{{ __("Withdraw Crypto") }}</h5>
                </div>
                <div class="card-body">
                    <form action="withdraw-crypto-preview.html" class="card-form">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 form-group text-center">
                                <div class="exchange-area">
                                    <code class="d-block text-center"><span>Exchange Rate</span> 1 USD = 1.00000000 USDT</code>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 form-group">
                                <label>{{ __("Amount") }}<span>*</span></label>
                                <div class="input-group max">
                                    <input type="text" class="form--control amount number-input" name="amount" placeholder="Enter Amount...">
                                    <div class="input-group-text two max-amount">{{ __("Max") }}</div>
                                    <select class="form--control nice-select" name="sender_wallet">
                                        @foreach ($currencies as $item)
                                            <option value="{{ $item->currency->id }}"
                                                data-balance="{{ $item->balance }}"
                                                data-rate="{{ $item->currency->rate }}"
                                                data-code="{{ $item->currency->code }}"
                                                >{{ $item->currency->code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <code class="d-block mt-10 available-balance"></code>
                            </div>
                            <div class="col-xl-6 col-lg-6 form-group">
                                <label>{{ __("Wallet Address") }}<span>*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form--control checkAddress" name="wallet_address" placeholder="Enter or Paste Address...">
                                    <div class="input-group-text"><i class="las la-paste"></i></div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 form-group">
                                <div class="note-area">
                                    <code class="d-block limit"></code>
                                    <code class="d-block network-charge"></code>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12">
                            <button type="submit" class="btn--base w-100"><span class="w-100">{{ __("Continue") }}</span></button>
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
        $('.checkAddress').on('keyup',function(e){
            var url = '{{ route('user.withdraw.crypto.check.address.exist') }}';
            var value = $(this).val();
            var token = '{{ csrf_token() }}';
            if ($(this).attr('name') == 'wallet_address') {
                var data = {wallet_address:value,_token:token}

            }
            $.post(url,data,function(response) {
                

            });
        });
        $(document).ready(function () {
            getExchangePreview();
        });
        $('select[name=sender_wallet]').change(function(){
            var amount      = $('input[name=amount]').val();
            getExchangePreview();
            chargeCalculation(amount);
        });
        $('.amount').keyup(function(){
            var amount      = $('input[name=amount]').val();
            chargeCalculation(amount);
        });

        // max amount get
        $(document).on('click','.max-amount',function(){
            var walletBalance       = selectedValue().senderBalance;
            var senderRate          = selectedValue().senderRate;
            var fixedCharge         = '{{ $transaction_fees->fixed_charge }}';
            var percentCharge       = '{{ $transaction_fees->percent_charge }}';
            var fixedChargeCalc     = fixedCharge * senderRate;
            var percentChargeCalc   = (walletBalance / 100) * percentCharge;
            var totalCharge         = fixedChargeCalc + percentChargeCalc;
            var amount              = parseFloat(walletBalance) - parseFloat(totalCharge);
            
            $(".amount").val(amount);
            chargeCalculation(amount);

        });

        // function for preview
        function getExchangePreview(){
            var walletBalance       = selectedValue().senderBalance;
            var currency            = selectedValue().senderCurrency;
            var rate                = selectedValue().senderRate;
            var minLimit            = '{{ $transaction_fees->min_limit }}';
            var maxLimit            = '{{ $transaction_fees->max_limit }}';
            var totalMinLimit       = minLimit * rate;
            var totalMaxLimit       = maxLimit * rate;

            $('.available-balance').text("Available Balance "+ " " + parseFloat(walletBalance).toFixed(2) + " " + currency);
            $('.limit').text("Limit "+ ":" + " " + parseFloat(totalMinLimit).toFixed(2) + " " + currency + " " + "-" + " " + parseFloat(totalMaxLimit).toFixed(2) + " " + currency);
        }

        // function charge calculation
        function chargeCalculation(amount){
            var senderCurrency      = selectedValue().senderCurrency;
            var senderRate          = selectedValue().senderRate;
            var fixedCharge         = '{{ $transaction_fees->fixed_charge }}';
            var percentCharge       = '{{ $transaction_fees->percent_charge }}';
            var fixedChargeCalc     = fixedCharge * senderRate;
            var percentChargeCalc   = (amount / 100) * percentCharge;
            var totalCharge         = fixedChargeCalc + percentChargeCalc;

            $('.network-charge').text("Network Fees " + ":" + " " +  parseFloat(totalCharge).toFixed(2) + " " + senderCurrency);
        }

        //selected value
        function selectedValue(){
            var senderCurrency      = $("select[name=sender_wallet] :selected").data("code");
            var senderRate          = $("select[name=sender_wallet] :selected").data("rate");
            var senderBalance       = $("select[name=sender_wallet] :selected").data("balance");

            return {
                senderCurrency:senderCurrency,
                senderRate:senderRate,
                senderBalance:senderBalance
            };
        }
    </script>
@endpush
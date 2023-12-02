@extends('user.layouts.master')

@push('css')
    
@endpush

@section('breadcrumb')
    @include('user.components.breadcrumb',['breadcrumbs' => [
        [
            'name'  => __("Dashboard"),
            'url'   => setRoute("user.dashboard"),
        ]
    ], 'active' => __("Buy Crypto")])
@endsection

@section('content')
<div class="body-wrapper">
    <div class="row justify-content-center mt-30">
        <div class="col-xxl-6 col-xl-8 col-lg-8">
            <div class="custom-card">
                <div class="dashboard-header-wrapper">
                    <h5 class="title">{{ __("Buy Crypto") }}</h5>
                </div>
                <div class="card-body">
                    <form action="buy-crypto-preview.html" class="card-form">
                        <div class="row justify-content-center">
                            <div class="col-xxl-5 col-xl-7 col-lg-8 form-group">
                                <div class="toggle-container">
                                    <div class="switch-toggles active" data-deactive="deactive">
                                        <input type="hidden" value="1">
                                        <span class="switch" data-value="1">Inside Wallet</span>
                                        <span class="switch" data-value="0">Outside Wallet</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 form-group">
                                <label>{{ __("Select Coin") }}<span>*</span></label>
                                <div class="custom-select-area">
                                    <div class="custom-select">
                                        <div class="custom-select-inner first-currency" data-item='{{ json_encode(@$first_currency) }}'>
                                            <input type="hidden" name="sender_currency" class="sender_currency">
                                            <img src="{{ get_image(@$first_currency->flag , 'currency-flag') }}" alt="flag" class="custom-flag">
                                            <span class="custom-currency">{{ @$first_currency->code }}</span>
                                        </div>
                                    </div>
                                    <div class="custom-select-wrapper">
                                        <div class="custom-select-search-box">
                                            <div class="custom-select-search-wrapper">
                                                <button type="submit" class="search-btn"><i class="las la-search"></i></button>
                                                <input type="text" class="form--control custom-select-search" placeholder="Search Here...">
                                            </div>
                                        </div>
                                        <div class="custom-select-list-wrapper">
                                            <ul class="custom-select-list">
                                                @foreach ($currencies ?? [] as $item)
                                                    <li class="custom-option" id="custom-option" data-item='{{ json_encode($item) }}'>
                                                        <img src="{{ get_image(@$item->flag , 'currency-flag') }}" alt="flag" class="custom-flag">
                                                        <span class="custom-country">{{ @$item->name }}</span>
                                                        <span class="custom-currency">{{ @$item->code }}</span>
                                                    </li>  
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 form-group network-field">
                                <label>{{ __("Select Network") }}<span>*</span></label>
                                <select class="select2-basic" name="network">
                                    
                                </select>
                            </div>
                            <div class="col-xl-12 form-group" style="display: none;" data-switcher="deactive">
                                <label>Crypto Address<span>*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form--control" placeholder="Enter or Paste Address...">
                                    <div class="input-group-text"><i class="las la-paste"></i></div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 form-group">
                                <label>Amount<span>*</span></label>
                                <div class="input-group max">
                                    <input type="text" class="form--control" placeholder="Enter Amount...">
                                    <div class="input-group-text">USDT</div>
                                </div>
                                <code class="d-block mt-2">Min Amount : 0.00001 USDT</code>
                            </div>
                            <div class="col-xl-6 col-lg-6 form-group">
                                <label>{{ __("Payment Method") }}<span>*</span></label>
                                <select class="form--control nice-select">
                                    <option selected disabled>{{ __("Select Method") }}</option>
                                    @foreach ($payment_gateway ?? [] as $item)
                                        
                                    <option 
                                            value="{{ $item->id  }}"
                                            data-currency="{{ $item->currency_code }}"
                                            data-min_amount="{{ $item->min_limit }}"
                                            data-max_amount="{{ $item->max_limit }}"
                                            data-percent_charge="{{ $item->percent_charge }}"
                                            data-fixed_charge="{{ $item->fixed_charge }}"
                                            data-rate="{{ $item->rate }}"
                                    >{{ $item->name ?? '' }} @if ($item->gateway->isManual())
                                        (Manual)
                                    @endif</option>
                                    @endforeach
                                </select>
                                <code class="d-block mt-2">Rate : 1 USD = 0.00001 USDT</code>
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
    $(".custom-select-search").keyup(function(){
        var searchText = $(this).val().toLowerCase();
        var itemList =  $(this).parents(".custom-select-area").find(".custom-option");
        $.each(itemList,function(index,item){
            var text = $(item).find(".custom-currency").text().toLowerCase();
            var country = $(item).find(".custom-country").text().toLowerCase();
            var match = text.match(searchText);
            var countryMatch = country.match(searchText);
            if(match == null && countryMatch == null) {
                $(item).addClass("d-none");
            }else {
                $(item).removeClass("d-none");
            }
        });
    });
</script>

<script>

    var getNetworkURL   = "{{ setRoute('user.buy.crypto.get.currency.networks') }}";
    $(document).on('click','#custom-option',function(){
        var selectedCurrency = JSON.parse(currencySelectActiveItem("input[name=sender_currency]"))
        var currency         = selectedCurrency.id;
        if(currency == '' || currency == null){
            return false;
        }
        getNetwork(getNetworkURL,currency);
        
    });

    function getNetwork(getNetworkURL,currency){
        $.post(getNetworkURL,{currency:currency,_token:"{{ csrf_token() }}"},function(response){
                
                var networkOption = '';
                if(response.data.currency.networks.length > 0){
                    $.each(response.data.currency.networks,function(index,item){
                        networkOption += `<option value="${item.network_id}">
                            ${item.network.name}</option>
                        `;
                    });
                    $('select[name=network]').html(networkOption);
                    $('select[name=network]').select2();
                }
        })
    }

    function currencySelectActiveItem(input){
        var customSelect        = $(input).parents(".custom-select-area");
        var selectedItem        = customSelect.find(".custom-option.active");
        
        if(selectedItem.length > 0) {
            return selectedItem.attr("data-item");
        }
        return false;
    }

    //ready function 
    $(document).ready(function(){
        var getNetworkURL       = "{{ setRoute('user.buy.crypto.get.currency.networks') }}";
        var selectedCurrency    = $('.first-currency');
        var data                = JSON.parse(selectedCurrency.attr("data-item"));
        var currency            = data.id;
        if(currency == '' || currency == null){
            return false;
        }
        getNetwork(getNetworkURL,currency);
        
    });
</script>
@endpush
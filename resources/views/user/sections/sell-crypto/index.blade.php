@extends('user.layouts.master')

@push('css')
    
@endpush

@section('breadcrumb')
    @include('user.components.breadcrumb',['breadcrumbs' => [
        [
            'name'  => __("Dashboard"),
            'url'   => setRoute("user.dashboard"),
        ]
    ], 'active' => __("Sell Crypto")])
@endsection

@section('content')
<div class="body-wrapper">
    <div class="row justify-content-center mt-30">
        <div class="col-xxl-6 col-xl-8 col-lg-8">
            <div class="custom-card">
                <div class="dashboard-header-wrapper">
                    <h5 class="title">{{ __("Sell Crypto") }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ setRoute('user.sell.crypto.store') }}" class="card-form" method="POST">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-xxl-5 col-xl-7 col-lg-8 form-group">
                                <div class="toggle-container">
                                    <div class="switch-toggles active" data-deactive="deactive">
                                        <input type="hidden" name="wallet_type" >
                                        <span class="switch" data-value="{{ global_const()::INSIDE_WALLET }}">{{ __("Inside Wallet") }}</span>
                                        <span class="switch" data-value="{{ global_const()::OUTSIDE_WALLET }}">{{ __("Outside Wallet") }}</span>
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
                                            <input type="hidden" class="currency-rate">
                                            <img src="{{ get_image(@$first_currency->flag , 'currency-flag') }}" alt="flag" class="custom-flag">
                                            <span class="custom-currency">{{ @$first_currency->code }}</span>
                                        </div>
                                    </div>
                                    <div class="custom-select-wrapper">
                                        <div class="custom-select-search-box">
                                            <div class="custom-select-search-wrapper">
                                                <button type="submit" class="search-btn"><i class="las la-search"></i></button>
                                                <input type="text" class="form--control custom-select-search" placeholder="{{ __("Search Here") }}...">
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
                            <div class="col-xl-12 col-lg-12 form-group">
                                <label>{{ __("Amount") }}<span>*</span></label>
                                <div class="input-group max">
                                    <input type="text" class="form--control number-input" name="amount" placeholder="{{ __("Enter Amount") }}...">
                                    <div class="input-group-text currency-code"></div>
                                </div>
                                <code class="d-block mt-2 min-amount"></code>
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
    function pasteClipboard() {
        

        navigator.clipboard.readText()
        .then(function(textFromClipboard) {
          console.log(textFromClipboard);
          $("#myInput").val(textFromClipboard);
        })
        .catch(function(err) {
            console.log('Failed to read clipboard contents: ');
            console.error('Failed to read clipboard contents: ', err);
        });
    }

    $("#pasteButton").click(pasteClipboard);

</script>

<script>
    $(document).on('click','#custom-option',function(){
        var selectedCurrency = JSON.parse(currencySelectActiveItem("input[name=sender_currency]"))
        var currency         = selectedCurrency.id;
        var currencyCode     = selectedCurrency.code;
        if(currency == '' || currency == null){
            return false;
        }
        
        //pass the currency as parameter to get network
        getNetwork(currency,currencyCode);
        $('.sender_currency').val(currency);
        $('.currency-code').text(currencyCode);
        var currencyRate           = selectedCurrency.rate;

        calculation(currencyRate,currencyCode);

    });

    function currencySelectActiveItem(input){
        var customSelect        = $(input).parents(".custom-select-area");
        var selectedItem        = customSelect.find(".custom-option.active");
        
        if(selectedItem.length > 0) {
            return selectedItem.attr("data-item");
        }
        return false;
    }

    //get network function
    function getNetwork(currency,currencyCode){
        var getNetworkURL   = "{{ setRoute('user.sell.crypto.get.currency.networks') }}";
        $.post(getNetworkURL,{currency:currency,_token:"{{ csrf_token() }}"},function(response){
            var networkOption = '';
            if(response.data.currency.networks.length > 0){
                $.each(response.data.currency.networks,function(index,item){
                    networkOption += `<option value="${item.network_id}">
                        ${item.network.name} (Arrival Time: ${item.network.arrival_time} min)</option>
                    `;
                });
                $('select[name=network]').html(networkOption);
                $('select[name=network]').select2();
            }
        })
    }

    

    function calculation(currencyRate,currencyCode){
        var min_limit       = '{{ $transaction_fees->min_limit }}';
        var max_limit       = '{{ $transaction_fees->max_limit }}';
        var min_limit_calc  = currencyRate * min_limit;
        var max_limit_calc  = currencyRate * max_limit;

        $(".min-amount").text("Limit: " + parseFloat(min_limit_calc).toFixed(2) + " " + currencyCode + " " + "-" + " " + parseFloat(max_limit_calc).toFixed(2) + " " + currencyCode);
    }

    //ready function 
    $(document).ready(function(){
        var data                = JSON.parse($('.first-currency').attr("data-item"));
        var currency            = data.id;
        var currencyCode        = data.code;
        if(currency == '' || currency == null){
            return false;
        }
        
        //pass the currency as parameter to get network
        getNetwork(currency,currencyCode);
        $('.sender_currency').val(currency);
        $('.currency-code').text(currencyCode);
        var currencyRate    = data.rate;
        

        calculation(currencyRate,currencyCode);
    });


</script>
@endpush
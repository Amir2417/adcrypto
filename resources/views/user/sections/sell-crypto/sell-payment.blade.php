@extends('user.layouts.master')

@push('css')
    
@endpush

@section('breadcrumb')
    @include('user.components.breadcrumb',['breadcrumbs' => [
        [
            'name'  => __("Dashboard"),
            'url'   => setRoute("user.dashboard"),
        ]
    ], 'active' => __("Sell Crypto Payment")])
@endsection

@section('content')
<div class="body-wrapper">
    <div class="row justify-content-center mt-30">
        <div class="col-xxl-6 col-xl-8 col-lg-8">
            <div class="custom-card">
                <div class="dashboard-header-wrapper">
                    <h5 class="title">{{ __("Sell Crypto Payment") }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ setRoute('user.sell.crypto.sell.payment.store',$data->identifier) }}" class="card-form" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 form-group">
                                <div class="qr-code-thumb text-center">
                                    <img class="mx-auto" src="{{ $qr_code }}">
                                </div>
                            </div>
                            <input type="hidden" name="slug" value="{{ $outside_wallet_address->slug }}">
                            <div class="col-xl-12 col-lg-12 form-group paste-form text-center">
                                <label id="public-address">{{ $outside_wallet_address->public_address }}</label>
                                <div class="paste-text" id="copy-address"><i class="las la-paste"></i></div>
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
    $('#copy-address').on('click',function(){
        var copyText = document.getElementById("public-address").textContent;

        var tempTextarea = document.createElement('textarea');
        tempTextarea.value = copyText;
        document.body.appendChild(tempTextarea);

        tempTextarea.select();
        tempTextarea.setSelectionRange(0, 99999);
        document.execCommand('copy');
        document.body.removeChild(tempTextarea);

        throwMessage('success', ["Copied: " + copyText]);
    });
</script>
@endpush
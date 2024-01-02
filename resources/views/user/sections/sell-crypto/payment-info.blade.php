@extends('user.layouts.master')

@push('css')
    
@endpush

@section('breadcrumb')
    @include('user.components.breadcrumb',['breadcrumbs' => [
        [
            'name'  => __("Dashboard"),
            'url'   => setRoute("user.dashboard"),
        ]
    ], 'active' => __("Sell Crypto Payment Info")])
@endsection

@section('content')
<div class="body-wrapper">
    @if ($data->data->sender_wallet->type  == global_const()::INSIDE_WALLET)
    <form action="{{ setRoute('user.sell.crypto.payment.info.store',$data->identifier) }}" class="card-form-area" method="POST">
        @csrf
        <div class="row mt-30 mb-20-none">
            <div class="col-xl-6 col-lg-6 mb-20">
                <div class="custom-card">
                    <div class="dashboard-header-wrapper">
                        <h5 class="title">{{ __("Receiving Method Information") }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="card-form">
                            <div class="row">
                                <h3>{!! $gateway->desc !!}</h3>
                                @include('user.components.payment-gateway.generate-dy-input',['input_fields' => array_reverse($gateway->input_fields)])
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <button type="submit" class="btn--base mt-10 w-100"><span class="w-100">{{ __("Continue") }}</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @else
    <form action="{{ setRoute('user.sell.crypto.payment.info.store',$data->identifier) }}" class="card-form-area" method="POST">
        @csrf
        <div class="row justify-content-center mt-30 mb-20-none">
            <div class="col-xl-6 col-lg-6 mb-20">
                <div class="custom-card">
                    <div class="dashboard-header-wrapper">
                        <h5 class="title">Payment Proof</h5>
                    </div>
                    <div class="card-body">
                        <div class="card-form">
                            <div class="row mb-20-none">
                                <div class="col-xl-12 form-group">
                                    <label>From Crypto Address<span>*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form--control" placeholder="Enter or Paste Address...">
                                        <div class="input-group-text"><i class="las la-paste"></i></div>
                                    </div>
                                </div>
                                <div class="col-xl-12 form-group">
                                    <label>TRX<span>*</span></label>
                                    <input type="text" class="form--control" placeholder="Enter Here...">
                                </div>
                                <div class="col-xl-12 form-group">
                                    <label>Screenshot<span>*</span></label>
                                    <div class="file-holder-wrapper">
                                        <input type="file" class="file-holder" name="file" id="fileUpload" data-height="130" accept="image/*" data-max_size="20" data-file_limit="15" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 mb-20">
                <div class="custom-card">
                    <div class="dashboard-header-wrapper">
                        <h5 class="title">Receiving Method Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="card-form">
                            <div class="row">
                                <div class="col-xl-12 form-group">
                                    <label>Bank Name<span>*</span></label>
                                    <input type="text" class="form--control" placeholder="Enter Here...">
                                </div>
                                <div class="col-xl-12 form-group">
                                    <label>Bank Account Number<span>*</span></label>
                                    <input type="number" class="form--control" placeholder="Enter Here...">
                                </div>
                                <div class="col-xl-12 form-group">
                                    <label>Branch<span>*</span></label>
                                    <input type="text" class="form--control" placeholder="Enter Here...">
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <button type="submit" class="btn--base mt-10 w-100"><span class="w-100">Continue</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @endif
    
</div>
@endsection
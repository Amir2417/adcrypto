@extends('frontend.layouts.master')

@push("css")
    
@endpush

@section('content') 
@include('frontend.partials.header',[
    'class'     => "two",
])

<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Start Service
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<section class="service-section ptb-120 section--bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 text-center">
                <div class="section-header">
                    <span class="title-badge">$</span>
                    <h5 class="section-sub-title">Services</h5>
                    <h2 class="section-title">Our Upheld What We <span>Serve</span></h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mb-30-none">
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-30">
                <div class="service-item">
                    <div class="service-icon">
                        <i class="lab la-codepen"></i>
                    </div>
                    <div class="service-content">
                        <h3 class="title">Digital Payments</h3>
                        <p>Cryptocurrencies can be used for online and in-person payments, offering an alternative to traditional payment methods.</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-30">
                <div class="service-item">
                    <div class="service-icon">
                        <i class="las la-print"></i>
                    </div>
                    <div class="service-content">
                        <h3 class="title">Global Access</h3>
                        <p>Cryptocurrencies can be used for online and in-person payments, offering an alternative to traditional payment methods.</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-30">
                <div class="service-item">
                    <div class="service-icon">
                        <i class="las la-book-open"></i>
                    </div>
                    <div class="service-content">
                        <h3 class="title">Remittances</h3>
                        <p>Cryptocurrencies can be used for online and in-person payments, offering an alternative to traditional payment methods.</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-30">
                <div class="service-item">
                    <div class="service-icon">
                        <i class="las la-mobile"></i>
                    </div>
                    <div class="service-content">
                        <h3 class="title">Decentralization</h3>
                        <p>Cryptocurrencies can be used for online and in-person payments, offering an alternative to traditional payment methods.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    End Service
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

@endsection
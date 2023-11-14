@extends('frontend.layouts.master')

@push("css")
    
@endpush

@section('content') 
@include('frontend.partials.header',[
    'class'     => "two",
])
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Start About
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<section class="about-section ptb-120">
    <div class="container">
        <div class="row justify-content-center align-items-center mb-30-none">
            <div class="col-xl-6 col-lg-6 mb-30">
                <div class="about-thumb">
                    <img src="{{ asset('public/frontend') }}/images/element/about.png" alt="element">
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 mb-30">
                <div class="about-content">
                    <div class="section-header">
                        <span class="title-badge">$</span>
                        <h5 class="section-sub-title">About us</h5>
                        <h2 class="section-title">The Way of the <span>Wayfinding Mark</span></h2>
                    </div>
                    <p>Cryptocurrencies are not controlled by a central authority. Instead, they rely on distributed ledger technology (blockchain) to record and verify transactions. This decentralization eliminates the need for intermediaries like banks.</p>
                    <p>While transactions are recorded on a public ledger, users' identities are typically pseudonymous. This provides a level of privacy but has raised concerns about illegal activities.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    End About
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Start Faq
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<section class="faq-section section--bg ptb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 text-center">
                <div class="section-header">
                    <span class="title-badge">$</span>
                    <h5 class="section-sub-title">FAQs</h5>
                    <h2 class="section-title">Frequently Aksed <span>Questions</span></h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mb-30-none">
            <div class="col-xl-6 col-lg-6 mb-30">
                <div class="faq-wrapper">
                    <div class="faq-item">
                        <h6 class="faq-title"><span class="title">What is multi-currency account & how does it work?</span><span class="right-icon"></span></h6>
                        <div class="faq-content">
                            <p>Moreover general optional service in addition to the purchase of NFC Tags. We read all the Unique IDs (UID) of the Tags and send you via email.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <h6 class="faq-title"><span class="title">
                            What is the best features & services we deliver?</span><span
                                class="right-icon"></span></h6>
                        <div class="faq-content">
                            <p>Moreover general optional service in addition to the purchase of NFC Tags. We read all the Unique IDs (UID) of the Tags and send you via email.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <h6 class="faq-title"><span class="title">What Modes Of Payment Do You Accept?</span><span
                                class="right-icon"></span></h6>
                        <div class="faq-content">
                            <p>Moreover general optional service in addition to the purchase of NFC Tags. We read all the Unique IDs (UID) of the Tags and send you via email.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <h6 class="faq-title"><span class="title">
                            What happened to the borderless account?</span><span
                                class="right-icon"></span></h6>
                        <div class="faq-content">
                            <p>Moreover general optional service in addition to the purchase of NFC Tags. We read all the Unique IDs (UID) of the Tags and send you via email.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 mb-30">
                <div class="faq-wrapper">
                    <div class="faq-item">
                        <h6 class="faq-title"><span class="title">What is multi-currency account & how does it work?</span><span class="right-icon"></span></h6>
                        <div class="faq-content">
                            <p>Moreover general optional service in addition to the purchase of NFC Tags. We read all the Unique IDs (UID) of the Tags and send you via email.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <h6 class="faq-title"><span class="title">
                            What is the best features & services we deliver?</span><span
                                class="right-icon"></span></h6>
                        <div class="faq-content">
                            <p>Moreover general optional service in addition to the purchase of NFC Tags. We read all the Unique IDs (UID) of the Tags and send you via email.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <h6 class="faq-title"><span class="title">What Modes Of Payment Do You Accept?</span><span
                                class="right-icon"></span></h6>
                        <div class="faq-content">
                            <p>Moreover general optional service in addition to the purchase of NFC Tags. We read all the Unique IDs (UID) of the Tags and send you via email.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <h6 class="faq-title"><span class="title">
                            What happened to the borderless account?</span><span
                                class="right-icon"></span></h6>
                        <div class="faq-content">
                            <p>Moreover general optional service in addition to the purchase of NFC Tags. We read all the Unique IDs (UID) of the Tags and send you via email.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    End Faq
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
@endsection
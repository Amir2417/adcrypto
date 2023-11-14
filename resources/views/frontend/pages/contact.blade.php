@extends('frontend.layouts.master')

@push("css")
    
@endpush

@section('content') 
@include('frontend.partials.header',[
    'class'     => "two",
])

<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Start Contact
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<div class="contact-section section--bg ptb-120">
    <div class="container">
        <div class="contact-area">
            <div class="contact-wrapper">
                <div class="row justify-content-center align-items-center mb-30-none">
                    <div class="col-xl-6 col-lg-6 mb-30">
                        <div class="contact-thumb">
                            <img src="{{ asset('public/frontend') }}/images/element/contact.png" alt="element">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 mb-30">
                        <div class="contact-form-area">
                            <div class="section-header">
                                <span class="title-badge">$</span>
                                <h5 class="section-sub-title">Contact Us</h5>
                                <h2 class="section-title">Feel Free To Get In Touch <span>With Us</span></h2>
                            </div>
                            <form class="contact-form">
                                <div class="row justify-content-center mb-10-none">
                                    <div class="col-xl-6 col-lg-6 col-md-12 form-group">
                                        <label>Name<span>*</span></label>
                                        <input type="text" name="text" class="form--control" placeholder="Enter Name...">
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 form-group">
                                        <label>Email<span>*</span></label>
                                        <input type="email" name="email" class="form--control" placeholder="Enter Email...">
                                    </div>
                                    <div class="col-xl-12 col-lg-12 form-group">
                                        <label>Message<span>*</span></label>
                                        <textarea class="form--control" placeholder="Write Here..."></textarea>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <button type="submit" class="btn--base mt-10"><span>Send Message</span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    End Contact
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

@endsection
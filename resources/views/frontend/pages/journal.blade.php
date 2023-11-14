@extends('frontend.layouts.master')

@push("css")
    
@endpush

@section('content') 
@include('frontend.partials.header',[
    'class'     => "two",
])

<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Start Blog
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<section class="blog-section section--bg ptb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 text-center">
                <div class="section-header">
                    <span class="title-badge">$</span>
                    <h5 class="section-sub-title">Web Journal</h5>
                    <h2 class="section-title">Read Our Recent <span>Web Journal</span></h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mb-30-none">
            <div class="col-xl-4 col-lg-6 col-md-6 mb-30">
                <div class="blog-item">
                    <div class="blog-thumb">
                        <img src="{{ asset('public/frontend') }}/images/blog/blog-1.jpg" alt="blog">
                    </div>
                    <div class="blog-content">
                        <span class="date"><i class="las la-calendar"></i> February 18, 2023</span>
                        <h5 class="title"><a href="blog-details.html">We Care About Your Money And Safety far far away.</a></h5>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 mb-30">
                <div class="blog-item">
                    <div class="blog-thumb">
                        <img src="{{ asset('public/frontend') }}/images/blog/blog-2.jpg" alt="blog">
                    </div>
                    <div class="blog-content">
                        <span class="date"><i class="las la-calendar"></i> February 18, 2023</span>
                        <h5 class="title"><a href="blog-details.html">The Impact Of Online Payment Use Crypto Currency.</a></h5>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 mb-30">
                <div class="blog-item">
                    <div class="blog-thumb">
                        <img src="{{ asset('public/frontend') }}/images/blog/blog-3.jpg" alt="blog">
                    </div>
                    <div class="blog-content">
                        <span class="date"><i class="las la-calendar"></i> February 18, 2023</span>
                        <h5 class="title"><a href="blog-details.html">Is Now A Good Time To Worry More About Financial.</a></h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="view-more-btn text-center mt-60">
            <a href="blog.html" class="btn--base">View More</a>
        </div>
    </div>
</section>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    End Blog
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

@endsection
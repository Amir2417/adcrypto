@extends('frontend.layouts.master')

@push("css")
    
@endpush

@section('content') 
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Banner
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="banner-section bg_img" data-background="{{ asset('public/frontend/images/element/banner-bg.jpg') }}">
        <div class="container">
            <div class="row align-items-center mb-30-none">
                <div class="col-xl-6 col-lg-6 mb-30">
                    <div class="banner-content">
                        <h1 class="title">We Ensure Here NFC Payment Business Growing</h1>
                        <p>No coding expected to make customizations. The live customizer has all that you want which is trusted by 3M customers.</p>
                        <div class="banner-btn">
                            @if ($basic_settings->user_registration)  
                                <a href="{{ setRoute('user.register') }}" class="btn--base">{{ __("Get Started") }}</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 mb-30">
                    <div class="banner-thumb">
                        <img src="{{ asset('public/frontend/images/element/1.png') }}" alt="element">
                        <div class="banner-element-one">
                            <img src="{{ asset('public/frontend/images/element/2.png') }}" alt="element">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End Banner
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Brand
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="brand-section section--bg ptb-30">
        <div class="container">
            <div class="brand-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="brand-item">
                            <img src="{{ asset('public/frontend/images/brand/brand-1.png') }}" alt="brand">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-item">
                            <img src="{{ asset('public/frontend/images/brand/brand-2.png') }}" alt="brand">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-item">
                            <img src="{{ asset('public/frontend/images/brand/brand-3.png') }}" alt="brand">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-item">
                            <img src="{{ asset('public/frontend/images/brand/brand-4.png') }}" alt="brand">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand-item">
                            <img src="{{ asset('public/frontend/images/brand/brand-5.png') }}" alt="brand">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End Brand
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Service
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="service-section ptb-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5 col-lg-6 text-center">
                    <div class="section-header">
                        <span class="section-sub-title">Service Provide</span>
                        <h2 class="section-title">Our Upheld Administrations What We Serve to You</h2>
                    </div>
                </div>
            </div>
            <div class="row mb-30-none">
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-30">
                    <div class="service-item">
                        <div class="service-icon">
                            <svg class="bi bi-app-indicator" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M5.5 2A3.5 3.5 0 0 0 2 5.5v5A3.5 3.5 0 0 0 5.5 14h5a3.5 3.5 0 0 0 3.5-3.5V8a.5.5 0 0 1 1 0v2.5a4.5 4.5 0 0 1-4.5 4.5h-5A4.5 4.5 0 0 1 1 10.5v-5A4.5 4.5 0 0 1 5.5 1H8a.5.5 0 0 1 0 1H5.5z"></path>
                                <path d="M16 3a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"></path>
                            </svg>
                        </div>
                        <div class="service-content">
                            <h4 class="title">Complete Wallet</h4>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-30">
                    <div class="service-item active">
                        <div class="service-icon">
                            <svg class="bi bi-arrow-repeat" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M2.854 7.146a.5.5 0 0 0-.708 0l-2 2a.5.5 0 1 0 .708.708L2.5 8.207l1.646 1.647a.5.5 0 0 0 .708-.708l-2-2zm13-1a.5.5 0 0 0-.708 0L13.5 7.793l-1.646-1.647a.5.5 0 0 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0 0-.708z"></path>
                                <path fill-rule="evenodd" d="M8 3a4.995 4.995 0 0 0-4.192 2.273.5.5 0 0 1-.837-.546A6 6 0 0 1 14 8a.5.5 0 0 1-1.001 0 5 5 0 0 0-5-5zM2.5 7.5A.5.5 0 0 1 3 8a5 5 0 0 0 9.192 2.727.5.5 0 1 1 .837.546A6 6 0 0 1 2 8a.5.5 0 0 1 .501-.5z"></path>
                            </svg>
                        </div>
                        <div class="service-content">
                            <h4 class="title">Latest Transactions</h4>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-30">
                    <div class="service-item">
                        <div class="service-icon">
                            <svg class="bi bi-briefcase" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M0 12.5A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-6h-1v6a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-6H0v6z"></path>
                                <path fill-rule="evenodd" d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5v2.384l-7.614 2.03a1.5 1.5 0 0 1-.772 0L0 6.884V4.5zM1.5 4a.5.5 0 0 0-.5.5v1.616l6.871 1.832a.5.5 0 0 0 .258 0L15 6.116V4.5a.5.5 0 0 0-.5-.5h-13zM5 2.5A1.5 1.5 0 0 1 6.5 1h3A1.5 1.5 0 0 1 11 2.5V3h-1v-.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5V3H5v-.5z"></path>
                            </svg>
                        </div>
                        <div class="service-content">
                            <h4 class="title">Online Shopping</h4>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-30">
                    <div class="service-item">
                        <div class="service-icon">
                            <svg class="bi bi-collection" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M14.5 13.5h-13A.5.5 0 0 1 1 13V6a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5zm-13 1A1.5 1.5 0 0 1 0 13V6a1.5 1.5 0 0 1 1.5-1.5h13A1.5 1.5 0 0 1 16 6v7a1.5 1.5 0 0 1-1.5 1.5h-13zM2 3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11A.5.5 0 0 0 2 3zm2-2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7A.5.5 0 0 0 4 1z"></path>
                            </svg>
                        </div>
                        <div class="service-content">
                            <h4 class="title">Crypto Support</h4>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-30">
                    <div class="service-item">
                        <div class="service-icon">
                            <svg class="bi bi-app-indicator" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M5.5 2A3.5 3.5 0 0 0 2 5.5v5A3.5 3.5 0 0 0 5.5 14h5a3.5 3.5 0 0 0 3.5-3.5V8a.5.5 0 0 1 1 0v2.5a4.5 4.5 0 0 1-4.5 4.5h-5A4.5 4.5 0 0 1 1 10.5v-5A4.5 4.5 0 0 1 5.5 1H8a.5.5 0 0 1 0 1H5.5z"></path>
                                <path d="M16 3a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"></path>
                            </svg>
                        </div>
                        <div class="service-content">
                            <h4 class="title">Global Account</h4>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-30">
                    <div class="service-item">
                        <div class="service-icon">
                            <svg class="bi bi-arrow-repeat" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M2.854 7.146a.5.5 0 0 0-.708 0l-2 2a.5.5 0 1 0 .708.708L2.5 8.207l1.646 1.647a.5.5 0 0 0 .708-.708l-2-2zm13-1a.5.5 0 0 0-.708 0L13.5 7.793l-1.646-1.647a.5.5 0 0 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0 0-.708z"></path>
                                <path fill-rule="evenodd" d="M8 3a4.995 4.995 0 0 0-4.192 2.273.5.5 0 0 1-.837-.546A6 6 0 0 1 14 8a.5.5 0 0 1-1.001 0 5 5 0 0 0-5-5zM2.5 7.5A.5.5 0 0 1 3 8a5 5 0 0 0 9.192 2.727.5.5 0 1 1 .837.546A6 6 0 0 1 2 8a.5.5 0 0 1 .501-.5z"></path>
                            </svg>
                        </div>
                        <div class="service-content">
                            <h4 class="title">Revenue Based Payments</h4>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-30">
                    <div class="service-item">
                        <div class="service-icon">
                            <svg class="bi bi-briefcase" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M0 12.5A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-6h-1v6a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-6H0v6z"></path>
                                <path fill-rule="evenodd" d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5v2.384l-7.614 2.03a1.5 1.5 0 0 1-.772 0L0 6.884V4.5zM1.5 4a.5.5 0 0 0-.5.5v1.616l6.871 1.832a.5.5 0 0 0 .258 0L15 6.116V4.5a.5.5 0 0 0-.5-.5h-13zM5 2.5A1.5 1.5 0 0 1 6.5 1h3A1.5 1.5 0 0 1 11 2.5V3h-1v-.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5V3H5v-.5z"></path>
                            </svg>
                        </div>
                        <div class="service-content">
                            <h4 class="title">NFT Marketing</h4>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-30">
                    <div class="service-item">
                        <div class="service-icon">
                            <svg class="bi bi-collection" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M14.5 13.5h-13A.5.5 0 0 1 1 13V6a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5zm-13 1A1.5 1.5 0 0 1 0 13V6a1.5 1.5 0 0 1 1.5-1.5h13A1.5 1.5 0 0 1 16 6v7a1.5 1.5 0 0 1-1.5 1.5h-13zM2 3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11A.5.5 0 0 0 2 3zm2-2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7A.5.5 0 0 0 4 1z"></path>
                            </svg>
                        </div>
                        <div class="service-content">
                            <h4 class="title">Team Management</h4>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End Service
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start About
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="about-section section--bg pt-80">
        <img src="assets/images/element/element-4.png" alt="element" class="about-shape">
        <div class="container">
            <div class="row justify-content-center align-items-center mb-30-none">
                <div class="col-xl-6 col-lg-6 mb-30">
                    <div class="about-thumb">
                        <img src="{{ asset('public/frontend/images/element/element-3.png') }}" alt="element">
                        <div class="about-video">
                            <a href="https://www.youtube.com/embed/F8KLTUq8zFY" data-rel="lightcase:myCollection"><i class="fas fa-play video-btn"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 mb-30">
                    <div class="about-content-wrapper">
                        <div class="about-content-header">
                            <span class="sub-title">About Us</span>
                            <h2 class="title">Quick, Secure Cash Moves Installment Passage</h2>
                            <p>We trust this ADwallet layout is helpful for your work. You can involve this layout for any reason. You might contribute a little sum by means of PayPal to help TemplateMo in making new layouts consistently.</p>
                        </div>
                        <div class="about-item-area">
                            <div class="about-item">
                                <div class="about-icon">
                                    <svg class="bi bi-app-indicator" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M5.5 2A3.5 3.5 0 0 0 2 5.5v5A3.5 3.5 0 0 0 5.5 14h5a3.5 3.5 0 0 0 3.5-3.5V8a.5.5 0 0 1 1 0v2.5a4.5 4.5 0 0 1-4.5 4.5h-5A4.5 4.5 0 0 1 1 10.5v-5A4.5 4.5 0 0 1 5.5 1H8a.5.5 0 0 1 0 1H5.5z"></path>
                                        <path d="M16 3a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"></path>
                                    </svg>
                                </div>
                                <div class="about-content">
                                    <h3 class="title">Trusted Partner</h3>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
                                </div>
                            </div>
                            <div class="about-item active">
                                <div class="about-icon">
                                    <svg class="bi bi-arrow-repeat" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M2.854 7.146a.5.5 0 0 0-.708 0l-2 2a.5.5 0 1 0 .708.708L2.5 8.207l1.646 1.647a.5.5 0 0 0 .708-.708l-2-2zm13-1a.5.5 0 0 0-.708 0L13.5 7.793l-1.646-1.647a.5.5 0 0 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0 0-.708z"></path>
                                        <path fill-rule="evenodd" d="M8 3a4.995 4.995 0 0 0-4.192 2.273.5.5 0 0 1-.837-.546A6 6 0 0 1 14 8a.5.5 0 0 1-1.001 0 5 5 0 0 0-5-5zM2.5 7.5A.5.5 0 0 1 3 8a5 5 0 0 0 9.192 2.727.5.5 0 1 1 .837.546A6 6 0 0 1 2 8a.5.5 0 0 1 .501-.5z"></path>
                                    </svg>
                                </div>
                                <div class="about-content">
                                    <h3 class="title">Fastpace Platform</h3>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
                                </div>
                            </div>
                            <div class="about-item">
                                <div class="about-icon">
                                    <svg class="bi bi-briefcase" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M0 12.5A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-6h-1v6a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-6H0v6z"></path>
                                        <path fill-rule="evenodd" d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5v2.384l-7.614 2.03a1.5 1.5 0 0 1-.772 0L0 6.884V4.5zM1.5 4a.5.5 0 0 0-.5.5v1.616l6.871 1.832a.5.5 0 0 0 .258 0L15 6.116V4.5a.5.5 0 0 0-.5-.5h-13zM5 2.5A1.5 1.5 0 0 1 6.5 1h3A1.5 1.5 0 0 1 11 2.5V3h-1v-.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5V3H5v-.5z"></path>
                                    </svg>
                                </div>
                                <div class="about-content">
                                    <h3 class="title">Tested Reliability</h3>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End About
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start How it works
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="how-it-works-section section--bg ptb-80">
        <div class="container">
            <div class="row justify-content-center mb-30-none">
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-30">
                    <div class="how-it-works-item">
                        <div class="how-it-works-icon-wrapper">
                            <div class="how-it-works-icon">
                                <i class="las la-wallet"></i>
                            </div>
                        </div>
                        <div class="how-it-works-content">
                            <h4 class="title">1. Setup your wallet</h4>
                            <p>Once You've Set Up Your Wallet Of Choice, Connect It To OpenSeaby Clicking The NFT Marketplacein The Topright Corner.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-30">
                    <div class="how-it-works-item">
                        <div class="how-it-works-icon-wrapper">
                            <div class="how-it-works-icon">
                                <i class="las la-funnel-dollar"></i>
                            </div>
                        </div>
                        <div class="how-it-works-content">
                            <h4 class="title">2. Create Your Collection</h4>
                            <p>Once You've Set Up Your Wallet Of Choice, Connect It To OpenSeaby Clicking The NFT Marketplacein The Topright Corner.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-30">
                    <div class="how-it-works-item">
                        <div class="how-it-works-icon-wrapper">
                            <div class="how-it-works-icon">
                                <i class="las la-image"></i>
                            </div>
                        </div>
                        <div class="how-it-works-content">
                            <h4 class="title">3. Add Your NFTs</h4>
                            <p>Once You've Set Up Your Wallet Of Choice, Connect It To OpenSeaby Clicking The NFT Marketplacein The Topright Corner.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-30">
                    <div class="how-it-works-item">
                        <div class="how-it-works-icon-wrapper">
                            <div class="how-it-works-icon">
                                <i class="las la-tag"></i>
                            </div>
                        </div>
                        <div class="how-it-works-content">
                            <h4 class="title">4. List Theme For Sale</h4>
                            <p>Once You've Set Up Your Wallet Of Choice, Connect It To OpenSeaby Clicking The NFT Marketplacein The Topright Corner.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End How it works
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Feature
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="feature-section pt-80">
        <div class="container">
            <div class="row justify-content-center align-items-center mb-30-none">
                <div class="col-xl-6 col-lg-6 mb-30">
                    <div class="feature-content-wrapper">
                        <div class="feature-content-header">
                            <span class="sub-title">Top Features</span>
                            <h2 class="title">Quick, Secure Cash Moves Installment Passage</h2>
                            <p>We trust this ADwallet layout is helpful for your work. You can involve this layout for any reason. You might contribute a little sum by means of PayPal to help TemplateMo in making new layouts consistently.</p>
                        </div>
                        <ul class="feature-list">
                            <li>Online Payment</li>
                            <li>Platform Support</li>
                            <li>Secure Transaction</li>
                            <li>Responsive Web App</li>
                            <li>Divide Group Payments</li>
                            <li>Lock Protection</li>
                        </ul>
                        <div class="feature-statistics-wrapper">
                            <div class="row mb-30-none">
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                                    <div class="statistics-item">
                                        <div class="statistics-content">
                                            <div class="odo-area">
                                                <h3 class="odo-title odometer" data-odometer-final="25">0</h3>
                                                <h3 class="title">M</h3>
                                            </div>
                                            <p>Total Users</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                                    <div class="statistics-item">
                                        <div class="statistics-content">
                                            <div class="odo-area">
                                                <h3 class="odo-title odometer" data-odometer-final="40">0</h3>
                                                <h3 class="title">M</h3>
                                            </div>
                                            <p>Total Transactions</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                                    <div class="statistics-item">
                                        <div class="statistics-content">
                                            <div class="odo-area">
                                                <h3 class="odo-title odometer" data-odometer-final="500">0</h3>
                                                <h3 class="title">+</h3>
                                            </div>
                                            <p>Merchant Accounts</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 mb-30">
                    <div class="feature-thumb">
                        <img src="{{ asset('public/frontend/images/element/hero_consultant_main.jpg') }}" alt="element">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End Feature
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Testimonial
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="testimonial-section ptb-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-7 text-center">
                    <div class="section-header">
                        <span class="section-sub-title">Testimonial</span>
                        <h2 class="section-title">Our Satisfied Customers</h2>
                    </div>
                </div>
            </div>
            <div class="testimonial-area">
                <div class="testimonial-slider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="testimonial-wrapper">
                                <div class="testimonial-thumb">
                                    <img src="{{ asset('public/frontend/images/client/client-1.jpg') }}" alt="client">
                                    <div class="testimonial-quote">
                                        <svg width="22" height="19" fill="none" xmlns="http://www.w3.org/2000/svg" class="fill-white"><path d="M6.027 18.096c-.997 0-1.813-.204-2.448-.612a5.147 5.147 0 01-1.564-1.564 5.729 5.729 0 01-.952-2.38C.927 12.679.86 11.976.86 11.432c0-2.221.567-4.239 1.7-6.052C3.693 3.567 5.461 2.093 7.863.96l.612 1.224c-1.405.59-2.606 1.519-3.604 2.788-1.042 1.27-1.564 2.561-1.564 3.876 0 .544.068 1.02.204 1.428a3.874 3.874 0 012.516-.884c1.179 0 2.199.385 3.06 1.156.862.77 1.292 1.836 1.292 3.196 0 1.27-.43 2.312-1.292 3.128-.861.816-1.881 1.224-3.06 1.224zm11.56 0c-.997 0-1.813-.204-2.448-.612a5.148 5.148 0 01-1.564-1.564 5.73 5.73 0 01-.952-2.38c-.136-.861-.204-1.564-.204-2.108 0-2.221.567-4.239 1.7-6.052 1.134-1.813 2.902-3.287 5.304-4.42l.612 1.224c-1.405.59-2.606 1.519-3.604 2.788-1.042 1.27-1.564 2.561-1.564 3.876 0 .544.068 1.02.204 1.428a3.874 3.874 0 012.516-.884c1.179 0 2.199.385 3.06 1.156.862.77 1.292 1.836 1.292 3.196 0 1.27-.43 2.312-1.292 3.128-.861.816-1.881 1.224-3.06 1.224z"></path></svg>
                                    </div>
                                </div>
                                <div class="testimonial-content">
                                    <div class="testimonial-ratings">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p>“We encountered a problem with processing big data and after only 1
                                        week, Iteck’s Experts provided perfect IT solutions, fast process &amp;
                                        affordable price.”</p>
                                    <div class="testimonial-user-wrapper">
                                        <div class="testimonial-user-content">
                                            <h5 class="title">Willams <span>/ Senior Marketing At Amazon</span></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonial-wrapper">
                                <div class="testimonial-thumb">
                                    <img src="{{ asset('public/frontend/images/client/client-2.jpg') }}" alt="client">
                                    <div class="testimonial-quote">
                                        <svg width="22" height="19" fill="none" xmlns="http://www.w3.org/2000/svg" class="fill-white"><path d="M6.027 18.096c-.997 0-1.813-.204-2.448-.612a5.147 5.147 0 01-1.564-1.564 5.729 5.729 0 01-.952-2.38C.927 12.679.86 11.976.86 11.432c0-2.221.567-4.239 1.7-6.052C3.693 3.567 5.461 2.093 7.863.96l.612 1.224c-1.405.59-2.606 1.519-3.604 2.788-1.042 1.27-1.564 2.561-1.564 3.876 0 .544.068 1.02.204 1.428a3.874 3.874 0 012.516-.884c1.179 0 2.199.385 3.06 1.156.862.77 1.292 1.836 1.292 3.196 0 1.27-.43 2.312-1.292 3.128-.861.816-1.881 1.224-3.06 1.224zm11.56 0c-.997 0-1.813-.204-2.448-.612a5.148 5.148 0 01-1.564-1.564 5.73 5.73 0 01-.952-2.38c-.136-.861-.204-1.564-.204-2.108 0-2.221.567-4.239 1.7-6.052 1.134-1.813 2.902-3.287 5.304-4.42l.612 1.224c-1.405.59-2.606 1.519-3.604 2.788-1.042 1.27-1.564 2.561-1.564 3.876 0 .544.068 1.02.204 1.428a3.874 3.874 0 012.516-.884c1.179 0 2.199.385 3.06 1.156.862.77 1.292 1.836 1.292 3.196 0 1.27-.43 2.312-1.292 3.128-.861.816-1.881 1.224-3.06 1.224z"></path></svg>
                                    </div>
                                </div>
                                <div class="testimonial-content">
                                    <div class="testimonial-ratings">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p>“We encountered a problem with processing big data and after only 1
                                        week, Iteck’s Experts provided perfect IT solutions, fast process &amp;
                                        affordable price.”</p>
                                    <div class="testimonial-user-wrapper">
                                        <div class="testimonial-user-content">
                                            <h5 class="title">Willams <span>/ Senior Marketing At Amazon</span></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonial-wrapper">
                                <div class="testimonial-thumb">
                                    <img src="{{ asset('public/frontend/images/client/client-3.jpg') }}" alt="client">
                                    <div class="testimonial-quote">
                                        <svg width="22" height="19" fill="none" xmlns="http://www.w3.org/2000/svg" class="fill-white"><path d="M6.027 18.096c-.997 0-1.813-.204-2.448-.612a5.147 5.147 0 01-1.564-1.564 5.729 5.729 0 01-.952-2.38C.927 12.679.86 11.976.86 11.432c0-2.221.567-4.239 1.7-6.052C3.693 3.567 5.461 2.093 7.863.96l.612 1.224c-1.405.59-2.606 1.519-3.604 2.788-1.042 1.27-1.564 2.561-1.564 3.876 0 .544.068 1.02.204 1.428a3.874 3.874 0 012.516-.884c1.179 0 2.199.385 3.06 1.156.862.77 1.292 1.836 1.292 3.196 0 1.27-.43 2.312-1.292 3.128-.861.816-1.881 1.224-3.06 1.224zm11.56 0c-.997 0-1.813-.204-2.448-.612a5.148 5.148 0 01-1.564-1.564 5.73 5.73 0 01-.952-2.38c-.136-.861-.204-1.564-.204-2.108 0-2.221.567-4.239 1.7-6.052 1.134-1.813 2.902-3.287 5.304-4.42l.612 1.224c-1.405.59-2.606 1.519-3.604 2.788-1.042 1.27-1.564 2.561-1.564 3.876 0 .544.068 1.02.204 1.428a3.874 3.874 0 012.516-.884c1.179 0 2.199.385 3.06 1.156.862.77 1.292 1.836 1.292 3.196 0 1.27-.43 2.312-1.292 3.128-.861.816-1.881 1.224-3.06 1.224z"></path></svg>
                                    </div>
                                </div>
                                <div class="testimonial-content">
                                    <div class="testimonial-ratings">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <p>“We encountered a problem with processing big data and after only 1
                                        week, Iteck’s Experts provided perfect IT solutions, fast process &amp;
                                        affordable price.”</p>
                                    <div class="testimonial-user-wrapper">
                                        <div class="testimonial-user-content">
                                            <h5 class="title">Willams <span>/ Senior Marketing At Amazon</span></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End Testimonial
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Faq
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="faq-section section--bg ptb-80">
        <div class="container">
            <div class="row justify-content-center align-items-center mb-30-none">
                <div class="col-xl-6 col-lg-6 mb-30">
                    <div class="faq-thumb-wrapper">
                        <img src="{{ asset('public/frontend/images/element/faq.jpg') }}" alt="element" class="faq-thumb">
                        <div class="faq-top-thumb-wrapper">
                            <img src="{{ asset('public/frontend/images/element/element-6.png') }}" alt="element" class="faq-element-one">
                            <div class="faq-top-thumb-content">
                                <span class="sub-title">Individual Investors</span>
                                <h3 class="title">7,000+</h3>
                                <p>Sed do eiusmod tempor.</p>
                            </div>
                        </div>
                    </div>
                    <div class="faq-bottom-thumb-wrapper">
                        <img src="{{ asset('public/frontend/images/element/element-7.png') }}" alt="element" class="faq-element-two">
                        <div class="faq-bottom-content-wrapper">
                            <div class="faq-icon-wrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="fill-blue"><path fill="none" d="M0 0h24v24H0z"></path><path d="M4.406 14.523l3.402-3.402 2.828 2.829 3.157-3.157L12 9h5v5l-1.793-1.793-4.571 4.571-2.828-2.828-2.475 2.474a8 8 0 1 0-.927-1.9zm-1.538 1.558l-.01-.01.004-.004A9.965 9.965 0 0 1 2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10c-4.07 0-7.57-2.43-9.132-5.919z"></path></svg>
                            </div>
                            <div class="faq-bottom-content">
                                <span class="sub-title">Invested to date</span>
                                <h3 class="title">$3.7B</h3>
                                <p>Sed do eiusmod tempor.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 mb-30">
                    <div class="faq-wrapper">
                        <div class="faq-header">
                            <span class="sub-title">FAQ</span>
                            <h2 class="title">On the off chance that You Got Questions We Have Reply</h2>
                        </div>
                        <div class="faq-item active open">
                            <h3 class="faq-title"><span class="title">What is multi-currency account & how does it work?</span><span class="right-icon"></span></h3>
                            <div class="faq-content">
                                <p>Maecenas tempus tellus eget condimentu oncussam mperngsu libero sit amet adipiscing ue
                                    sed ipsum. Nam quam nunc, blandit
                                    veluctus pulvinar. Maecenas tempus.</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <h3 class="faq-title"><span class="title">
                                What is the best features & services we deliver?</span><span
                                    class="right-icon"></span></h3>
                            <div class="faq-content">
                                <p>Maecenas tempus tellus eget condimentu oncussam mperngsu libero sit amet adipiscing ue
                                    sed ipsum. Nam quam nunc, blandit
                                    veluctus pulvinar. Maecenas tempus.</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <h3 class="faq-title"><span class="title">What Modes Of Payment Do You Accept?</span><span
                                    class="right-icon"></span></h3>
                            <div class="faq-content">
                                <p>Maecenas tempus tellus eget condimentu oncussam mperngsu libero sit amet adipiscing ue
                                    sed ipsum. Nam quam nunc, blandit
                                    veluctus pulvinar. Maecenas tempus.</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <h3 class="faq-title"><span class="title">
                                What happened to the borderless account?</span><span
                                    class="right-icon"></span></h3>
                            <div class="faq-content">
                                <p>Maecenas tempus tellus eget condimentu oncussam mperngsu libero sit amet adipiscing ue
                                    sed ipsum. Nam quam nunc, blandit
                                    veluctus pulvinar. Maecenas tempus.</p>
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


    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Blog
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="blog-section pt-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-7 text-center">
                    <div class="section-header">
                        <span class="section-sub-title">Announcement</span>
                        <h2 class="section-title">Our Recent Announcement</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mb-30-none">
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                    <div class="blog-item">
                        <div class="blog-thumb">
                            <img src="{{ asset('public/frontend/images/blog/blog-1.jpg') }}" alt="blog">
                        </div>
                        <div class="blog-content">
                            <h3 class="title"><a href="blog-details.html">We Care About Your Money And Safety far far away, behind the word.</a></h3>
                            <div class="blog-btn">
                                <a href="blog-details.html" class="btn--base w-100">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                    <div class="blog-item">
                        <div class="blog-thumb">
                            <img src="{{ asset('public/frontend/images/blog/blog-2.jpg') }}" alt="blog">
                        </div>
                        <div class="blog-content">
                            <h3 class="title"><a href="blog-details.html">The Impact Of Online Payments Will Make All Banks Use ATMs</a></h3>
                            <div class="blog-btn">
                                <a href="blog-details.html" class="btn--base w-100">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                    <div class="blog-item">
                        <div class="blog-thumb">
                            <img src="{{ asset('public/frontend/images/blog/blog-3.jpg') }}" alt="blog">
                        </div>
                        <div class="blog-content">
                            <h3 class="title"><a href="blog-details.html">Is Now A Good Time To Worry More About Financial Inflation</a></h3>
                            <div class="blog-btn">
                                <a href="blog-details.html" class="btn--base w-100">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End Blog
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Call-to-action
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="call-to-action-section pt-80">
        <div class="container">
            <div class="call-to-action-wrapper bg_img" data-background="{{ asset('public/frontend/images/element/banner-bg.jpg') }}">
                <div class="call-to-action-content">
                    <h2 class="title">Procure up to $25 worth of wallet</h2>
                    <p>Find How Explicit Wallet Work — And Get A Touch Of Every Wallet To Go For Yourself.</p>
                    <div class="call-action-btn">
                        <a href="register.html" class="btn--base">Create Account</a>
                    </div>
                </div>
                <div class="call-action-thumb">
                    <img src="{{ asset('public/frontend/images/element/element-1.png') }}" alt="element">
                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        End Call-to-action
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
@endsection


@push("script")
    
@endpush
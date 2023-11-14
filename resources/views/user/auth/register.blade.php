@extends('layouts.master')

@push('css')
    
@endpush

@section('content')
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
Start Account
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<div class="account-section">
    <div class="account-inner">
        <div class="account-area change-form">
            <div class="account-thumb">
                <img src="{{ asset('public/frontend') }}/images/element/account.png" alt="element">
            </div>
            <div class="account-form-area">
                <div class="account-logo">
                    <a class="site-logo site-title" href="{{ setRoute('index') }}"><img src="{{ get_logo($basic_settings) }}" alt="site-logo"></a>
                </div>
                <h4 class="title">{{ __("Register for an Account Today") }}</h4>
                <p>{{ __("Become a part of our community by registering for an account today. Enjoy a range of benefits and features tailored to meet your needs. Our registration page makes it easy to create your account, providing a seamless and user-friendly experience.") }}</p>
                <form action="{{ setRoute('user.register.submit') }}" class="account-form" method="POST" autocomplete="on">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-12 form-group">
                            <input type="text" class="form-control form--control" name="firstname" placeholder="{{ __("First Name") }}" required>
                        </div>
                        <div class="col-lg-6 col-md-12 form-group">
                            <input type="text" class="form-control form--control" name="lastname" placeholder="{{ __("Last Name") }}" required>
                        </div>
                        <div class="col-lg-12 form-group">
                            <input type="email" class="form-control form--control" name="email" placeholder="{{ __("Email") }}" required>
                        </div>
                        <div class="col-lg-12 form-group show_hide_password">
                            <input type="password" class="form-control form--control" name="password" placeholder="{{ __("Password") }}" required>
                            <span class="show-pass"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
                        </div>
                        <div class="col-lg-12 form-group">
                            <div class="custom-check-group">
                                <input type="checkbox" name="agree" id="level-1">
                                <label for="level-1">{{ __("I have agreed with") }} <a href="#0">{{ __("Terms Of Use & Privacy Policy") }}</a></label>
                            </div>
                        </div>
                        <div class="col-lg-12 form-group text-center">
                            <button type="submit" class="btn--base w-100"><span class="w-100">{{ __("Register Now") }}</span></button>
                        </div>
                        <div class="col-lg-12 text-center">
                            <div class="account-item">
                                <label>{{ __("Already Have An Account?") }} <a href="{{ setRoute('user.login') }}" class="account-control-btn">{{ __("Login Now") }}</a></label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    End Account
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
@endsection

@push('script')

@endpush
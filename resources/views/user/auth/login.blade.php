
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
                <h4 class="title">{{ __("Log in and Stay Connected") }}</h4>
                <p>{{ __("Our secure login process ensures the confidentiality of your information. Log in today and stay connected to your finances, anytime and anywhere.") }}</p>
                <form action="{{ setRoute('user.login.submit') }}" class="account-form" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 form-group">
                            <input type="email" class="form-control form--control" name="credentials" placeholder="{{ __("Enter Email") }}..." required>
                        </div>
                        <div class="col-lg-12 form-group show_hide_password">
                            <input type="password" class="form-control form--control" name="password" placeholder="{{ __("Enter Password") }}..." required>
                            <span class="show-pass"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
                        </div>
                        <div class="col-lg-12 form-group">
                            <div class="forgot-item text-end">
                                <label><a href="{{ setRoute('user.password.forgot') }}">{{ __("Forgot Password?") }}</a></label>
                            </div>
                        </div>
                        <div class="col-lg-12 form-group text-center">
                            <button type="submit" class="btn--base w-100">{{ __("Login Now") }}</button>
                        </div>
                        <div class="col-lg-12 text-center">
                            <div class="account-item">
                                <label>{{ __("Don't Have An Account?") }} <a href="{{ setRoute('user.register') }}" class="account-control-btn">{{ __("Register Now") }}</a></label>
                            </div>
                        </div>
                        <div class="col-lg-12 text-center">
                            <div class="terms-item">
                                <label>{{ __("By clicking Login you are agreeing with our") }} <a href="#0">{{ __("Terms of feature") }}</a></label>
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
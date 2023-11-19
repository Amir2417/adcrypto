@php
    $app_local  = get_default_language_code();
    $slug = Illuminate\Support\Str::slug(App\Constants\SiteSectionConst::FOOTER_SECTION);
    $footer = App\Models\Admin\SiteSections::getData($slug)->first();
    $menues = DB::table('setup_pages')->where('status', 1)->get();
@endphp
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Start Footer
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<footer class="footer-section pt-80">
    <div class="footer-top-area">
        <div class="container">
            <div class="row justify-content-center mb-30-none">
                <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                    <div class="footer-widget">
                        <div class="footer-logo">
                            <a class="site-logo site-title" href="{{ setRoute('index') }}"><img src="{{ @$footer->value->footer->image ? get_image(@$footer->value->footer->image,'site-section') : get_logo($basic_settings) }}" alt="site-logo"></a>
                        </div>
                        <p>{{ @$footer->value->footer->language->$app_local->description ?? '' }}</p>
                        <ul class="footer-social">
                            @foreach (@$footer->value->social_links ?? [] as $item)
                                <li><a href="{{ $item->link ?? '' }}"><i class="{{ $item->icon ?? '' }}"></i></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                    <div class="footer-widget">
                        <h4 class="widget-title">{{ __("Menus") }}</h4>
                        
                        <ul class="footer-list">
                            @foreach ($menues as $item)
                                <li><a href="{{ url($item->url) }}">{{ $item->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                    <div class="footer-widget">
                        <h4 class="widget-title">Newsletter</h4>
                        <p>Check Our Newsletter And Subscribe Us.</p>
                        <form class="subscribe-form">
                            <div class="form-group">
                                <input type="email" class="form--control" placeholder="Email Address...">
                                <button type="submit" class="btn--base subscribe-btn">Subscribe</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom-area">
        <div class="container">
            <div class="footer-bottom-wrapper">
                <ul class="footer-list">
                    <li><a href="#0">Privacy policy</a></li>
                    <li><a href="#0">Refund Policy</a></li>
                    <li><a href="#0">Terms of service</a></li>
                </ul>
                <div class="copyright-area">
                    <p>© 2023 <a href="{{ setRoute('index') }}">{{ $basic_settings->site_name }}</a> {{ __("is Proudly Powered by AppDevs") }}</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    End Footer
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
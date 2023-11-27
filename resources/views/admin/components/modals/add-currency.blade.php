@if (admin_permission_by_name("admin.currency.store"))
    <div id="currency-add" class="mfp-hide large">
        <div class="modal-data">
            <div class="modal-header px-0">
                <h5 class="modal-title">{{ __("Add Currency") }}</h5>
            </div>
            <div class="modal-form-data">
                <form class="modal-form" method="POST" action="{{ setRoute('admin.currency.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-10-none">
                        <div class="col-xl-12 col-lg-12 form-group">
                            <label for="countryFlag">{{ __("Country Flag") }}</label>
                            <div class="col-12 col-sm-3 m-auto">
                                @include('admin.components.form.input-file',[
                                    'label'         => false,
                                    'class'         => "file-holder m-auto",
                                    'name'          => "flag",
                                ])
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 form-group">
                            <label>{{ __("Country*") }}</label>
                            <select name="country" class="form--control select2-auto-tokenize country-select" data-old="{{ old('country') }}">
                                <option selected disabled>Select Country</option>
                            </select>
                        </div>
                        <div class="col-xl-6 col-lg-6 form-group">
                            @include('admin.components.form.input',[
                                'label'         => 'Name*',
                                'name'          => 'name',
                                'value'         => old('name')
                            ])
                        </div>
                        <div class="col-xl-3 col-lg-3 form-group">
                            @include('admin.components.form.input',[
                                'label'         => 'Code*',
                                'name'          => 'code',
                                'value'         => old('code')
                            ])
                        </div>
                        <div class="col-xl-3 col-lg-3 form-group">
                            @include('admin.components.form.input',[
                                'label'         => 'Symbol*',
                                'name'          => 'symbol',
                                'value'         => old('symbol')
                            ])
                        </div>
                        {{-- <div class="col-xl-12 col-lg-12 form-group">
                            <label>{{ __("Rate*") }}</label>
                            <div class="input-group">
                                <span class="input-group-text append">1 {{ get_default_currency_code() }} = </span>
                                <input type="text" class="form--control number-input" value="{{ old('rate',0.00) }}" name="rate">
                                <span class="input-group-text selcted-currency">{{ old('code') }}</span>
                            </div>
                        </div> --}}
                        <div class="col-xl-12 col-lg-12 form-group">
                            <div class="custom-inner-card">
                                <div class="card-inner-header">
                                    <h6 class="title">{{ __("Network") }}</h6>
                                    <button type="button" class="btn--base add-schedule-btn"><i class="fas fa-plus"></i> {{ __("Add Network") }}</button>
                                </div>
                                <div class="card-inner-body">
                                    <div class="results">
                                        @include('admin.components.currency.network',compact('networks'))    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 form-group">
                            @include('admin.components.form.radio-button',[
                                'label'         => 'Role*',
                                'name'          => 'role',
                                'value'         => old('role','both'),
                                'options'       => ['Both' => 'both', 'Sender' => 'sender', 'Receiver' => 'receiver'],
                            ])
                        </div>
                        <div class="col-xl-12 col-lg-12 form-group">
                            @include('admin.components.form.switcher',[
                                'label'         => 'Option*',
                                'name'          => 'option',
                                'value'         => old('option','optional'),
                                'options'       => ['Optional' => 'optional','Default' => 'default'],
                            ])
                        </div>

                        <div class="col-xl-12 col-lg-12 form-group d-flex align-items-center justify-content-between mt-4">
                            <button type="button" class="btn btn--danger modal-close">{{ __("Cancel") }}</button>
                            <button type="submit" class="btn btn--base">{{ __("Add") }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push("script")
        <script>
            $(document).ready(function(){
                openModalWhenError("currency_add","#currency-add");
            });
            $(document).ready(function(){

            var getNetworkURL = "{{ setRoute('admin.currency.get.network') }}";
            $('.add-schedule-btn').click(function(){
                $.get(getNetworkURL,function(data){
                    $('.results').prepend(data);
                    $('.results').find('.row').first().find("select").select2();
                    var selectedCurrency    = localStorage.getItem("currencyCode");
                    $('.selcted-currency').text(selectedCurrency);
                });
            });
            });
        </script>
    @endpush
@endif
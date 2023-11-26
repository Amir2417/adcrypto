@if (admin_permission_by_name("admin.coin.store"))
    <div id="add-coin" class="mfp-hide large">
        <div class="modal-data">
            <div class="modal-header px-0">
                <h5 class="modal-title">{{ __("Add Coin") }}</h5>
            </div>
            <div class="modal-form-data">
                <form class="card-form" action="{{ setRoute('admin.coin.store') }}" method="POST">
                    @csrf
                    <div class="row mb-10-none">
                        <div class="col-xl-12 col-lg-12 form-group">
                            @include('admin.components.form.input',[
                                'label'         => "Name*",
                                'name'          => "name",
                                'data_limit'    => 150,
                                'placeholder'   => "Write Name...",
                                'value'         => old('name'),
                            ])
                        </div>
                        <div class="col-xl-12 col-lg-12 form-group">
                            @include('admin.components.form.input',[
                                'label'         => "Title",
                                'name'          => "title",
                                'placeholder'   => "Write Title...",
                                'value'         => old('title'),
                            ])
                        </div>
                        <div class="col-xl-12 col-lg-12 form-group">
                            @include('admin.components.button.form-btn',[
                                'class'         => "w-100 btn-loading",
                                'permission'    => "admin.coin.store",
                                'text'          => "Add",
                            ])
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
@push('script')
    <script>
        getAllCountries("{{ setRoute('global.countries') }}",$(".country-select"));
            $(document).ready(function(){

                $(".country-select").select2();

                $("select[name=country]").change(function(){
                    var phoneCode = $("select[name=country] :selected").attr("data-mobile-code");
                    placePhoneCode(phoneCode);
                });

                setTimeout(() => {
                    var phoneCodeOnload = $("select[name=country] :selected").attr("data-mobile-code");
                    placePhoneCode(phoneCodeOnload);
                }, 400);
            });
    </script>
@endpush
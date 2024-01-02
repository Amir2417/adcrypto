@extends('admin.layouts.master')

@push('css')

@endpush

@section('page-title')
    @include('admin.components.page-title',['title' => __($page_title)])
@endsection

@section('breadcrumb')
    @include('admin.components.breadcrumb',['breadcrumbs' => [
        [
            'name'  => __("Dashboard"),
            'url'   => setRoute("admin.dashboard"),
        ]
    ], 'active' => __("Outside Wallet Payment Receiving Address")])
@endsection

@section('content')
    <div class="table-area">
        <div class="table-wrapper">
            <div class="table-header">
                <h5 class="title">{{ ("Outside Wallet Payment Receiving Address") }}</h5>
                @include('admin.components.link.custom',[
                    'text'          => "Add Outside Wallet Address",
                    'class'         => 'btn btn--base',
                    'href'          => setRoute('admin.outside.wallet.create'),
                ])
            </div>
            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>{{ __("Currency Name") }}</th>
                            <th>{{ __("Network Name") }}</th>
                            <th>{{ __("P. Address") }}</th>
                            <th>{{ __("Status") }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($outside_wallets as $item)
                            <tr data-item="{{ $item }}">
                                <td>{{ $item->currency->name }}</td>
                                <td>{{ $item->network->name }}</td>
                                <td>{{ $item->public_address ?? '' }}</td>
                                <td>
                                    @include('admin.components.form.switcher',[
                                        'name'        => 'status',
                                        'value'       => $item->status,
                                        'options'     => ['Enable' => 1, 'Disable' => 0],
                                        'onload'      => true,
                                        'data_target' => $item->id,
                                    ])
                                    
                                </td>
                                <td>
                                    @include('admin.components.link.edit-default',[
                                        'href'          => setRoute('admin.outside.wallet.edit',$item->public_address),
                                        'class'         => "edit-modal-button",
                                        'permission'    => "admin.outside.wallet.edit",
                                    ])
                                    <button class="btn btn--base btn--danger delete-modal-button" ><i class="las la-trash-alt"></i></button>
                                </td>
                            </tr>
                        @empty
                            @include('admin.components.alerts.empty',['colspan' => 5])
                        @endforelse
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(".delete-modal-button").click(function(){
            var oldData     = JSON.parse($(this).parents("tr").attr("data-item"));
            var actionRoute = "{{ setRoute('admin.outside.wallet.delete') }}";
            var target      = oldData.id;
            var message     = `Are you sure to <strong>delete</strong> this Outside Wallet?`;

            openDeleteModal(actionRoute,target,message);

        });

        $(document).ready(function(){
            // Switcher
            switcherAjax("{{ setRoute('admin.outside.wallet.status.update') }}");
        })
    </script>
@endpush
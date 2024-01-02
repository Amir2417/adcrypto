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
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                   
                                    
                                </td>
                                <td>
                                    
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
    
@endpush
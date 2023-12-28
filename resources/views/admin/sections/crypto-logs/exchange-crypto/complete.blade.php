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
    ], 'active' => __("Complete Exchange Crypto Logs")])
@endsection

@section('content')
    <div class="table-area">
        <div class="table-wrapper">
            <div class="table-header">
                <h5 class="title">{{ ("Complete Exchange Crypto Logs") }}</h5>
            </div>
            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>{{ __("S. Wallet") }}</th>
                            <th>{{ __("Amount") }}</th>
                            <th>{{ __("Status") }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $item)
                            <tr>
                                <td><span>{{ $item->details->data->sender_wallet->name ?? '' }}</span></td>
                                <td>{{ get_amount($item->amount,$item->details->data->sender_wallet->code,8) }}</td>
                                <td>
                                    @if ($item->status == global_const()::STATUS_PENDING)
                                        <span>{{ __("Pending") }}</span>
                                    @elseif ($item->status == global_const()::STATUS_CONFIRM_PAYMENT)
                                        <span>{{ __("Confirm Payment") }}</span>
                                    @elseif ($item->status == global_const()::STATUS_COMPLETE)
                                        <span>{{ __("Completed") }}</span>
                                    @elseif ($item->status == global_const()::STATUS_CANCEL)
                                        <span>{{ __("Canceled") }}</span>
                                    @else
                                        <span>{{ __("Delayed") }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ setRoute('admin.exchange.crypto.details',$item->id) }}" class="btn btn--base btn--primary"><i class="las la-info-circle"></i></a>
                                </td>
                            </tr>
                        @empty
                            @include('admin.components.alerts.empty',['colspan' => 4])
                        @endforelse
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('script')
    
@endpush
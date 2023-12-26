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
    ], 'active' => __("Confirm Withdraw Crypto Logs")])
@endsection

@section('content')
    <div class="table-area">
        <div class="table-wrapper">
            <div class="table-header">
                <h5 class="title">{{ ("Confirm Withdraw Crypto Logs") }}</h5>
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
                                <td>{{ get_amount($item->amount,$item->details->data->sender_wallet->code) }}</td>
                                <td>
                                    @if ($item->status == global_const()::STATUS_REVIEW_PAYMENT)
                                    <span>{{ __("Review Payment") }}</span> 
                                @elseif ($item->status == global_const()::STATUS_PENDING)
                                    <span>{{ __("Pending") }}</span>
                                @elseif ($item->status == global_const()::STATUS_CONFIRM_PAYMENT)
                                    <span>{{ __("Confirm Payment") }}</span>
                                @elseif ($item->status == global_const()::STATUS_HOLD)
                                    <span>{{ __("On Hold") }}</span>
                                @elseif ($item->status == global_const()::STATUS_SETTLED)
                                    <span>{{ __("Settled") }}</span>
                                @elseif ($item->status == global_const()::STATUS_COMPLETE)
                                    <span>{{ __("Completed") }}</span>
                                @elseif ($item->status == global_const()::STATUS_CANCEL)
                                    <span>{{ __("Canceled") }}</span>
                                @elseif ($item->status == global_const()::STATUS_FAILED)
                                    <span>{{ __("Failed") }}</span>
                                @elseif ($item->status == global_const()::STATUS_REFUND)
                                    <span>{{ __("Refunded") }}</span>
                                @else
                                    <span>{{ __("Delayed") }}</span>
                                @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn--base bg--success"><i class="las la-check-circle"></i></button>
                                    <button type="button" class="btn btn--base bg--danger"><i class="las la-times-circle"></i></button>
                                    <a href="out-logs-edit.html" class="btn btn--base"><i class="las la-expand"></i></a>
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
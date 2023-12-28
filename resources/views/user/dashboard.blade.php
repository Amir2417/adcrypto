@extends('user.layouts.master')

@section('breadcrumb')
    @include('user.components.breadcrumb',['breadcrumbs' => [
        [
            'name'  => __("Dashboard"),
            'url'   => setRoute("user.dashboard"),
        ]
    ], 'active' => __("Dashboard")])
@endsection

@section('content')

<div class="body-wrapper">
    
    @if ($wallets->isNotEmpty())
        <div class="dashboard-area mt-20">
            <div class="dashboard-header-wrapper">
                <h4 class="title">{{ __("My Wallets") }}</h4>
                <div class="dashboard-btn-wrapper">
                    <div class="dashboard-btn">
                        <a href="{{ setRoute('user.wallet.index') }}" class="btn--base">{{ __("View More") }}</a>
                    </div>
                </div>
            </div>
            <div class="dashboard-item-area">
                <div class="row mb-20-none">
                    @foreach ($wallets ?? [] as $item)
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-20">
                            <a href="{{ setRoute('user.wallet.details',$item->public_address) }}" class="dashbord-item">
                                <div class="dashboard-content">
                                    <span class="sub-title">{{ @$item->currency->name }}</span>
                                    <h4 class="title">{{ get_amount(@$item->balance,null,"double") }} <span class="text--danger">{{ @$item->currency->code }}</span></h4>
                                </div>
                                <div class="dashboard-icon">
                                    <img src="{{ get_image(@$item->currency->flag , 'currency-flag') }}" alt="flag">
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    
    <div class="chart-area mt-20">
        <div class="row mb-20-none">
            <div class="col-xxl-6 col-xl-6 col-lg-6 mb-20">
                <div class="chart-wrapper">
                    <div class="dashboard-header-wrapper">
                        <h5 class="title">Buy Crypto Chart</h5>
                    </div>
                    <div class="chart-container">
                        <div id="chart1" class="chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 mb-20">
                <div class="chart-wrapper">
                    <div class="dashboard-header-wrapper">
                        <h5 class="title">Sell Crypto Chart</h5>
                    </div>
                    <div class="chart-container">
                        <div id="chart2" class="chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dashboard-list-area mt-20">
        <div class="dashboard-header-wrapper">
            <h4 class="title">{{ __("Buy Log") }}</h4>
            <div class="dashboard-btn-wrapper">
                <div class="dashboard-btn">
                    <a href="{{ setRoute('user.transaction.buy.log') }}" class="btn--base">{{ __("View More") }}</a>
                </div>
            </div>
        </div>
        <div class="dashboard-list-wrapper">
            @foreach ($transactions as $item)
                <div class="dashboard-list-item-wrapper">
                    <div class="dashboard-list-item sent">
                        <div class="dashboard-list-left">
                            <div class="dashboard-list-user-wrapper">
                                <div class="dashboard-list-user-icon">
                                    <i class="las la-arrow-up"></i>
                                </div>
                                <div class="dashboard-list-user-content">
                                    <h4 class="title">{{ __("Buy") }} <span>{{ $item->details->data->wallet->name ?? '' }} ({{ $item->details->data->wallet->code ?? '' }})</span></h4>
                                    <span class="sub-title text--danger">{{ $item->type ?? '' }} 
                                        <span class="badge badge--warning ms-2">
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
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard-list-right">
                            <h4 class="main-money text--base mb-0">{{ get_amount($item->amount) ?? '' }} {{ $item->details->data->wallet->code ?? '' }}</h4>
                        </div>
                    </div>
                    <div class="preview-list-wrapper">
                        <div class="preview-list-item">
                            <div class="preview-list-left">
                                <div class="preview-list-user-wrapper">
                                    <div class="preview-list-user-icon">
                                        <i class="las la-keyboard"></i>
                                    </div>
                                    <div class="preview-list-user-content">
                                        <span>{{ __("Wallet Type") }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-list-right">
                                <span>{{ $item->details->data->wallet->type ?? '' }}</span>
                            </div>
                        </div>
                        <div class="preview-list-item">
                            <div class="preview-list-left">
                                <div class="preview-list-user-wrapper">
                                    <div class="preview-list-user-icon">
                                        <i class="las la-coins"></i>
                                    </div>
                                    <div class="preview-list-user-content">
                                        <span>{{ __("Coin") }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-list-right">
                                <span>{{ $item->details->data->wallet->name ?? '' }} ({{ $item->details->data->wallet->code }})</span>
                            </div>
                        </div>
                        <div class="preview-list-item">
                            <div class="preview-list-left">
                                <div class="preview-list-user-wrapper">
                                    <div class="preview-list-user-icon">
                                        <i class="las la-network-wired"></i>
                                    </div>
                                    <div class="preview-list-user-content">
                                        <span>{{ __("Network") }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-list-right">
                                <span>{{ $item->details->data->network->name ?? '' }}</span>
                            </div>
                        </div>
                        @if ($item->details->data->wallet->type == global_const()::OUTSIDE_WALLET)
                            <div class="preview-list-item">
                                <div class="preview-list-left">
                                    <div class="preview-list-user-wrapper">
                                        <div class="preview-list-user-icon">
                                            <i class="las la-map-marked-alt"></i>
                                        </div>
                                        <div class="preview-list-user-content">
                                            <span>{{ __("Wallet Address") }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="preview-list-right">
                                    <span>{{ $item->details->data->wallet->address ?? '' }}</span>
                                </div>
                            </div>
                        @endif
                        <div class="preview-list-item">
                            <div class="preview-list-left">
                                <div class="preview-list-user-wrapper">
                                    <div class="preview-list-user-icon">
                                        <i class="las la-money-check"></i>
                                    </div>
                                    <div class="preview-list-user-content">
                                        <span>{{ __("Payment Gateway") }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-list-right">
                                <span>{{ $item->details->data->payment_method->name ?? '' }}</span>
                            </div>
                        </div>
                        <div class="preview-list-item">
                            <div class="preview-list-left">
                                <div class="preview-list-user-wrapper">
                                    <div class="preview-list-user-icon">
                                        <i class="las la-wallet"></i>
                                    </div>
                                    <div class="preview-list-user-content">
                                        <span>{{ __("Enter Amount") }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-list-right">
                                <span class="text--success">{{ get_amount($item->amount) }} {{ $item->details->data->wallet->code ?? '' }}</span>
                            </div>
                        </div>
                        <div class="preview-list-item">
                            <div class="preview-list-left">
                                <div class="preview-list-user-wrapper">
                                    <div class="preview-list-user-icon">
                                        <i class="las la-exchange-alt"></i>
                                    </div>
                                    <div class="preview-list-user-content">
                                        <span>{{ __("Exchange Rate") }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-list-right">
                                <span class="text--warning">1 {{ $item->details->data->wallet->code ?? '' }} = {{ $item->details->data->exchange_rate ?? '' }} {{ $item->details->data->payment_method->code ?? '' }}</span>
                            </div>
                        </div>
                        <div class="preview-list-item">
                            <div class="preview-list-left">
                                <div class="preview-list-user-wrapper">
                                    <div class="preview-list-user-icon">
                                        <i class="las la-battery-half"></i>
                                    </div>
                                    <div class="preview-list-user-content">
                                        <span>{{ __("Network Fees") }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-list-right">
                                <span class="text--danger">{{ get_amount($item->total_charge) ?? '' }} {{ $item->details->data->wallet->code ?? '' }}</span>
                            </div>
                        </div>
                        <div class="preview-list-item">
                            <div class="preview-list-left">
                                <div class="preview-list-user-wrapper">
                                    <div class="preview-list-user-icon">
                                        <i class="las la-money-check-alt"></i>
                                    </div>
                                    <div class="preview-list-user-content">
                                        <span class="last">{{ __("Total Payable Amount") }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-list-right">
                                <span class="last">{{ get_amount($item->total_payable) ?? '' }} {{ $item->details->data->wallet->code ?? '' }}</span>
                            </div>
                        </div>
                        @if ($item->currency->gateway->isTatum($item->currency->gateway) && $item->status == global_const()::STATUS_PENDING)
                            <div class="col-12">
                                <form action="{{ setRoute('user.buy.crypto.payment.crypto.confirm', $item->trx_id) }}" method="POST">
                                    @csrf
                                    @php
                                        $input_fields = $item->details->payment_info->requirements ?? [];
                                    @endphp

                                    @foreach ($input_fields as $input)
                                        <div class="">
                                            <h4 class="mb-0">{{ $input->label }}</h4>
                                            <input type="text" class="form-control" name="{{ $input->name }}" placeholder="{{ $input->placeholder ?? "" }}">
                                        </div>
                                    @endforeach

                                    <div class="text-end">
                                        <button type="submit" class="btn--base my-2">{{ __("Process") }}</button>
                                    </div>

                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
@push('script')
<script>
    var options = {
        series: [{
            name: 'Transactions',
            color: "#0194FC",
            data: [33, 41, 50, 101, 60, 46, 42, 33, 24, 18, 25, 12]
        }],
        chart: {
            height: 350,
            toolbar: {
              show: false
            },
            type: 'bar',
        },
        plotOptions: {
            bar: {
                borderRadius: 10,
                dataLabels: {
                    position: 'top', 
                },
            }
        },
        dataLabels: {
            enabled: true,
            formatter: function (val) {
                return val + "$";
            },
            offsetY: -20,
            style: {
                fontSize: '12px',
                colors: ["#ffffff"]
            }
        },

        xaxis: {
            categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            position: 'top',
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            crosshairs: {
                fill: {
                    type: 'gradient',
                    gradient: {
                        colorFrom: '#8781c6',
                        colorTo: '#8781c6',
                        stops: [0, 100],
                        opacityFrom: 0.4,
                        opacityTo: 0.5,
                    }
                }
            },
            tooltip: {
                enabled: true,
            }
        },
        yaxis: {
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false,
            },
            labels: {
                show: false,
                formatter: function (val) {
                    return val + "$";
                }
            }

        },
        title: {
            text: 'Transactions Overview',
            floating: true,
            offsetY: 330,
            align: 'center',
            style: {
                color: '#fff'
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart1"), options);
    chart.render();

    var options = {
        series: [{
        name: 'Buy Crypto',
        color: "#00ABB3",
        data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
        }, {
        name: 'Sell Crypto',
        color: "#0194FC",
        data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
        }, {
        name: 'Withdraw Crypto',
        color: "#cdbb71",
        data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
        }],
        chart: {
        type: 'bar',
        toolbar: {
            show: false
        },
        height: 350
        },
        plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: '55%',
            borderRadius: 5,
            endingShape: 'rounded'
        },
        },
        dataLabels: {
        enabled: false
        },
        stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
        },
        xaxis: {
        categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
        },
        yaxis: {
        title: {
            text: '$ (thousands)'
        }
        },
        fill: {
        opacity: 1
        },
        tooltip: {
        y: {
            formatter: function (val) {
            return "$ " + val + " thousands"
            }
        }
        }
        };

    var chart = new ApexCharts(document.querySelector("#chart2"), options);
    chart.render();
</script>
@endpush
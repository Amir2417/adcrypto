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
    <div class="dashboard-area mt-20">
        <div class="dashboard-header-wrapper">
            <h4 class="title">My Wallets</h4>
            <div class="dashboard-btn-wrapper">
                <div class="dashboard-btn">
                    <a href="{{ setRoute('user.wallet.index') }}" class="btn--base">{{ __("View More") }}</a>
                </div>
            </div>
        </div>
        <div class="dashboard-item-area">
            <div class="row mb-20-none">
                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-20">
                    <a href="dashboard-item-details.html" class="dashbord-item">
                        <div class="dashboard-content">
                            <span class="sub-title">Bitcoin</span>
                            <h4 class="title">1000.00 <span class="text--danger">BTC</span></h4>
                        </div>
                        <div class="dashboard-icon">
                            <img src="{{ asset('public/frontend') }}/images/flag/btc.jpg" alt="flag">
                        </div>
                    </a>
                </div>
                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-20">
                    <a href="dashboard-item-details.html" class="dashbord-item">
                        <div class="dashboard-content">
                            <span class="sub-title">Ethereum</span>
                            <h4 class="title">500.00 <span class="text--danger">ETH</span></h4>
                        </div>
                        <div class="dashboard-icon">
                            <img src="{{ asset('public/frontend') }}/images/flag/eth.webp" alt="flag">
                        </div>
                    </a>
                </div>
                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-20">
                    <a href="dashboard-item-details.html" class="dashbord-item">
                        <div class="dashboard-content">
                            <span class="sub-title">Tether</span>
                            <h4 class="title">270.00 <span class="text--danger">USDT</span></h4>
                        </div>
                        <div class="dashboard-icon">
                            <img src="{{ asset('public/frontend') }}/images/flag/usdt.webp" alt="flag">
                        </div>
                    </a>
                </div>
                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-20">
                    <a href="dashboard-item-details.html" class="dashbord-item">
                        <div class="dashboard-content">
                            <span class="sub-title">Dogecoin</span>
                            <h4 class="title">100.00 <span class="text--danger">DOGE</span></h4>
                        </div>
                        <div class="dashboard-icon">
                            <img src="{{ asset('public/frontend') }}/images/flag/doge.webp" alt="flag">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
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
            <h4 class="title">Buy Log</h4>
            <div class="dashboard-btn-wrapper">
                <div class="dashboard-btn">
                    <a href="buy-log.html" class="btn--base">View More</a>
                </div>
            </div>
        </div>
        <div class="dashboard-list-wrapper">
            <div class="dashboard-list-item-wrapper">
                <div class="dashboard-list-item sent">
                    <div class="dashboard-list-left">
                        <div class="dashboard-list-user-wrapper">
                            <div class="dashboard-list-user-icon">
                                <i class="las la-arrow-up"></i>
                            </div>
                            <div class="dashboard-list-user-content">
                                <h4 class="title">Buy <span>ETH</span></h4>
                                <span class="sub-title text--danger">Sent <span class="badge badge--warning ms-2">Pending</span></span>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-list-right">
                        <h4 class="main-money text--base mb-0">78.61 USDT</h4>
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
                                    <span>Wallet Type</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span>Outside Wallet</span>
                        </div>
                    </div>
                    <div class="preview-list-item">
                        <div class="preview-list-left">
                            <div class="preview-list-user-wrapper">
                                <div class="preview-list-user-icon">
                                    <i class="las la-coins"></i>
                                </div>
                                <div class="preview-list-user-content">
                                    <span>Coin</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span>USDT</span>
                        </div>
                    </div>
                    <div class="preview-list-item">
                        <div class="preview-list-left">
                            <div class="preview-list-user-wrapper">
                                <div class="preview-list-user-icon">
                                    <i class="las la-network-wired"></i>
                                </div>
                                <div class="preview-list-user-content">
                                    <span>Network</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span>BSC</span>
                        </div>
                    </div>
                    <div class="preview-list-item">
                        <div class="preview-list-left">
                            <div class="preview-list-user-wrapper">
                                <div class="preview-list-user-icon">
                                    <i class="las la-map-marked-alt"></i>
                                </div>
                                <div class="preview-list-user-content">
                                    <span>Wallet Address</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span>TLiHJYVyWt9Ff3aYywuxkD95BAmycmeBug</span>
                        </div>
                    </div>
                    <div class="preview-list-item">
                        <div class="preview-list-left">
                            <div class="preview-list-user-wrapper">
                                <div class="preview-list-user-icon">
                                    <i class="las la-money-check"></i>
                                </div>
                                <div class="preview-list-user-content">
                                    <span>Payment Gateway</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span>BTC</span>
                        </div>
                    </div>
                    <div class="preview-list-item">
                        <div class="preview-list-left">
                            <div class="preview-list-user-wrapper">
                                <div class="preview-list-user-icon">
                                    <i class="las la-wallet"></i>
                                </div>
                                <div class="preview-list-user-content">
                                    <span>Enter Amount</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span class="text--success">0.05 USDT</span>
                        </div>
                    </div>
                    <div class="preview-list-item">
                        <div class="preview-list-left">
                            <div class="preview-list-user-wrapper">
                                <div class="preview-list-user-icon">
                                    <i class="las la-exchange-alt"></i>
                                </div>
                                <div class="preview-list-user-content">
                                    <span>Exchange Rate</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span class="text--warning">1 USD = 1.00000000 USDT</span>
                        </div>
                    </div>
                    <div class="preview-list-item">
                        <div class="preview-list-left">
                            <div class="preview-list-user-wrapper">
                                <div class="preview-list-user-icon">
                                    <i class="las la-battery-half"></i>
                                </div>
                                <div class="preview-list-user-content">
                                    <span>Network Charge</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span class="text--danger">0.57 USDT</span>
                        </div>
                    </div>
                    <div class="preview-list-item">
                        <div class="preview-list-left">
                            <div class="preview-list-user-wrapper">
                                <div class="preview-list-user-icon">
                                    <i class="las la-money-check-alt"></i>
                                </div>
                                <div class="preview-list-user-content">
                                    <span class="last">Total Payable Amount</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span class="last">0.00005 USDT</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dashboard-list-item-wrapper">
                <div class="dashboard-list-item sent">
                    <div class="dashboard-list-left">
                        <div class="dashboard-list-user-wrapper">
                            <div class="dashboard-list-user-icon">
                                <i class="las la-arrow-up"></i>
                            </div>
                            <div class="dashboard-list-user-content">
                                <h4 class="title">Buy <span>ETH</span></h4>
                                <span class="sub-title text--danger">Sent <span class="badge badge--warning ms-2">Pending</span></span>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-list-right">
                        <h4 class="main-money text--base mb-0">78.61 USDT</h4>
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
                                    <span>Wallet Type</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span>Outside Wallet</span>
                        </div>
                    </div>
                    <div class="preview-list-item">
                        <div class="preview-list-left">
                            <div class="preview-list-user-wrapper">
                                <div class="preview-list-user-icon">
                                    <i class="las la-coins"></i>
                                </div>
                                <div class="preview-list-user-content">
                                    <span>Coin</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span>USDT</span>
                        </div>
                    </div>
                    <div class="preview-list-item">
                        <div class="preview-list-left">
                            <div class="preview-list-user-wrapper">
                                <div class="preview-list-user-icon">
                                    <i class="las la-network-wired"></i>
                                </div>
                                <div class="preview-list-user-content">
                                    <span>Network</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span>BSC</span>
                        </div>
                    </div>
                    <div class="preview-list-item">
                        <div class="preview-list-left">
                            <div class="preview-list-user-wrapper">
                                <div class="preview-list-user-icon">
                                    <i class="las la-map-marked-alt"></i>
                                </div>
                                <div class="preview-list-user-content">
                                    <span>Wallet Address</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span>TLiHJYVyWt9Ff3aYywuxkD95BAmycmeBug</span>
                        </div>
                    </div>
                    <div class="preview-list-item">
                        <div class="preview-list-left">
                            <div class="preview-list-user-wrapper">
                                <div class="preview-list-user-icon">
                                    <i class="las la-money-check"></i>
                                </div>
                                <div class="preview-list-user-content">
                                    <span>Payment Gateway</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span>BTC</span>
                        </div>
                    </div>
                    <div class="preview-list-item">
                        <div class="preview-list-left">
                            <div class="preview-list-user-wrapper">
                                <div class="preview-list-user-icon">
                                    <i class="las la-wallet"></i>
                                </div>
                                <div class="preview-list-user-content">
                                    <span>Enter Amount</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span class="text--success">0.05 USDT</span>
                        </div>
                    </div>
                    <div class="preview-list-item">
                        <div class="preview-list-left">
                            <div class="preview-list-user-wrapper">
                                <div class="preview-list-user-icon">
                                    <i class="las la-exchange-alt"></i>
                                </div>
                                <div class="preview-list-user-content">
                                    <span>Exchange Rate</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span class="text--warning">1 USD = 1.00000000 USDT</span>
                        </div>
                    </div>
                    <div class="preview-list-item">
                        <div class="preview-list-left">
                            <div class="preview-list-user-wrapper">
                                <div class="preview-list-user-icon">
                                    <i class="las la-battery-half"></i>
                                </div>
                                <div class="preview-list-user-content">
                                    <span>Network Charge</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span class="text--danger">0.57 USDT</span>
                        </div>
                    </div>
                    <div class="preview-list-item">
                        <div class="preview-list-left">
                            <div class="preview-list-user-wrapper">
                                <div class="preview-list-user-icon">
                                    <i class="las la-money-check-alt"></i>
                                </div>
                                <div class="preview-list-user-content">
                                    <span class="last">Total Payable Amount</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span class="last">0.00005 USDT</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dashboard-list-item-wrapper">
                <div class="dashboard-list-item sent">
                    <div class="dashboard-list-left">
                        <div class="dashboard-list-user-wrapper">
                            <div class="dashboard-list-user-icon">
                                <i class="las la-arrow-up"></i>
                            </div>
                            <div class="dashboard-list-user-content">
                                <h4 class="title">Buy <span>ETH</span></h4>
                                <span class="sub-title text--danger">Sent <span class="badge badge--warning ms-2">Pending</span></span>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-list-right">
                        <h4 class="main-money text--base mb-0">78.61 USDT</h4>
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
                                    <span>Wallet Type</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span>Outside Wallet</span>
                        </div>
                    </div>
                    <div class="preview-list-item">
                        <div class="preview-list-left">
                            <div class="preview-list-user-wrapper">
                                <div class="preview-list-user-icon">
                                    <i class="las la-coins"></i>
                                </div>
                                <div class="preview-list-user-content">
                                    <span>Coin</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span>USDT</span>
                        </div>
                    </div>
                    <div class="preview-list-item">
                        <div class="preview-list-left">
                            <div class="preview-list-user-wrapper">
                                <div class="preview-list-user-icon">
                                    <i class="las la-network-wired"></i>
                                </div>
                                <div class="preview-list-user-content">
                                    <span>Network</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span>BSC</span>
                        </div>
                    </div>
                    <div class="preview-list-item">
                        <div class="preview-list-left">
                            <div class="preview-list-user-wrapper">
                                <div class="preview-list-user-icon">
                                    <i class="las la-map-marked-alt"></i>
                                </div>
                                <div class="preview-list-user-content">
                                    <span>Wallet Address</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span>TLiHJYVyWt9Ff3aYywuxkD95BAmycmeBug</span>
                        </div>
                    </div>
                    <div class="preview-list-item">
                        <div class="preview-list-left">
                            <div class="preview-list-user-wrapper">
                                <div class="preview-list-user-icon">
                                    <i class="las la-money-check"></i>
                                </div>
                                <div class="preview-list-user-content">
                                    <span>Payment Gateway</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span>BTC</span>
                        </div>
                    </div>
                    <div class="preview-list-item">
                        <div class="preview-list-left">
                            <div class="preview-list-user-wrapper">
                                <div class="preview-list-user-icon">
                                    <i class="las la-wallet"></i>
                                </div>
                                <div class="preview-list-user-content">
                                    <span>Enter Amount</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span class="text--success">0.05 USDT</span>
                        </div>
                    </div>
                    <div class="preview-list-item">
                        <div class="preview-list-left">
                            <div class="preview-list-user-wrapper">
                                <div class="preview-list-user-icon">
                                    <i class="las la-exchange-alt"></i>
                                </div>
                                <div class="preview-list-user-content">
                                    <span>Exchange Rate</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span class="text--warning">1 USD = 1.00000000 USDT</span>
                        </div>
                    </div>
                    <div class="preview-list-item">
                        <div class="preview-list-left">
                            <div class="preview-list-user-wrapper">
                                <div class="preview-list-user-icon">
                                    <i class="las la-battery-half"></i>
                                </div>
                                <div class="preview-list-user-content">
                                    <span>Network Charge</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span class="text--danger">0.57 USDT</span>
                        </div>
                    </div>
                    <div class="preview-list-item">
                        <div class="preview-list-left">
                            <div class="preview-list-user-wrapper">
                                <div class="preview-list-user-icon">
                                    <i class="las la-money-check-alt"></i>
                                </div>
                                <div class="preview-list-user-content">
                                    <span class="last">Total Payable Amount</span>
                                </div>
                            </div>
                        </div>
                        <div class="preview-list-right">
                            <span class="last">0.00005 USDT</span>
                        </div>
                    </div>
                </div>
            </div>
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
                    position: 'top', // top, center, bottom
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
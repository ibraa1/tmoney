@extends('layouts.bodyDashboard')
@section('title', 'Dashboard | TMoney ')
@section('content')
    <header class="page-title-bar">
        <div class="d-flex flex-column flex-md-row">
            <p class="lead">
                <span class="font-weight-bold">Hey, {{ Auth::user()->prenom }}.</span> <span class="d-block text-muted">Voici
                    l'état de
                    ton business</span>
            </p>
            @if (Auth::user()->role == 'agent')
                <div class="ml-auto">
                    <p>Solde: @foreach (Auth::user()->balances as $balance)
                            {{ number_format($balance->montant, 2, ',', ' ') }}
                            {{ $balance->detailBalance->devise->deviseEntree }}<br>
                        @endforeach
                    </p>
                </div>
            @endif
        </div>
    </header><!-- /.page-title-bar -->
    <!-- .page-section -->
    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superAdmin')
        <div class="page-section">
            <!-- .section-block -->
            <div class="section-block">
                <!-- metric row -->
                <div class="metric-row">
                    <div class="col-lg-9">
                        <div class="metric-row metric-flush">
                            <!-- metric column -->
                            <div class="col">
                                <!-- .metric -->
                                <a href="" class="metric metric-bordered align-items-center">
                                    <h2 class="metric-label"> Clients </h2>
                                    <p class="metric-value h3">
                                        <sub><i class="oi oi-people"></i></sub> <span
                                            class="value">{{ $totalClients }}</span>
                                    </p>
                                </a> <!-- /.metric -->
                            </div><!-- /metric column -->
                            <!-- metric column -->
                            <div class="col">
                                <!-- .metric -->
                                <a href="" class="metric metric-bordered align-items-center">
                                    <h2 class="metric-label"> Transactions </h2>
                                    <p class="metric-value h3">
                                        <sub><i class="oi oi-fork"></i></sub> <span
                                            class="value">{{ $totalTransactions }}</span>
                                    </p>
                                </a> <!-- /.metric -->
                            </div><!-- /metric column -->
                            <!-- metric column -->
                            <div class="col">
                                <!-- .metric -->
                                <a href="" class="metric metric-bordered align-items-center">
                                    <h2 class="metric-label"> Agents </h2>
                                    <p class="metric-value h3">
                                        <sub><i class="fa fa-tasks"></i></sub> <span
                                            class="value">{{ $totalAgents }}</span>
                                    </p>
                                </a> <!-- /.metric -->
                            </div><!-- /metric column -->
                        </div>
                    </div><!-- metric column -->
                    <div class="col-lg-3">
                        <!-- .metric -->
                        <a href="" class="metric metric-bordered">
                            <div class="metric-badge">
                                <span class="badge badge-lg badge-success"><span
                                        class="oi oi-media-record pulse mr-1"></span>
                                    TRANSACTIONS DU JOUR</span>
                            </div>
                            <p class="metric-value h3">
                                <sub><i class="oi oi-timer"></i></sub> <span class="value">{{ $transactionsToday }}</span>
                            </p>
                        </a> <!-- /.metric -->
                    </div><!-- /metric column -->
                </div><!-- /metric row -->
            </div><!-- /.section-block -->
            <!-- grid row -->
            <div class="row">
                <!-- grid column -->
                <div class="col-12 col-lg-12 col-xl-6">
                    <!-- .card -->
                    <div class="card card-fluid">
                        <!-- .card-body -->
                        <div class="card-body">
                            <h3 class="card-title mb-4"> Transactions de la semaine </h3>
                            <div id="transactions" data-colors="#35b8e0" style="height: 292px">
                            </div>
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div><!-- /grid column -->
                <!-- grid column -->
                <div class="col-12 col-lg-12 col-xl-6">
                    <!-- .card -->
                    <div class="card card-fluid">
                        <!-- .card-body -->
                        <div class="card-body">
                            <h3 class="card-title mb-4"> Balances des Agents </h3>
                            <div id="balances" data-colors="#536de6,#35b8e0,#cfe1f6" style="height: 292px">
                            </div>
                        </div><!-- /.card-body -->

                    </div><!-- /.card -->
                </div><!-- /grid column -->
            </div><!-- /grid row -->

        </div><!-- /.page-section -->
    @endif


@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $("#transactions").empty();
            var colors = ["#39afd1"],
                dataColors = $("#transactions").data("colors");
            dataColors && (colors = dataColors.split(","));
            var options = {
                    chart: {
                        height: 380,
                        type: "bar",
                        toolbar: {
                            show: !1
                        }
                    },
                    plotOptions: {
                        bar: {
                            vertical: !0
                        }
                    },
                    dataLabels: {
                        enabled: !0
                    },
                    series: [{
                        name: "transactions",
                        data: @json($transactionCounts),
                    }, ],
                    colors: colors,
                    xaxis: {
                        categories: @json($labels),
                    },
                    states: {
                        hover: {
                            filter: "none"
                        }
                    },
                    grid: {
                        borderColor: "#f1f3fa"
                    },
                },
                chart = new ApexCharts(document.querySelector("#transactions"), options);
            chart.render();


            $("#balances").empty();
            var colors = ["#39af1"],
                dataColors = $("#balances").data("colors");
            dataColors && (colors = dataColors.split(","));
            var options = {
                    chart: {
                        height: 380,
                        type: "bar",
                        toolbar: {
                            show: !1
                        }
                    },
                    plotOptions: {
                        bar: {
                            vertical: !0
                        }
                    },
                    dataLabels: {
                        enabled: !0
                    },
                    series: [{
                        name: "balances",
                        data: @json($valuesBalances),
                    }, ],
                    colors: colors,
                    xaxis: {
                        categories: @json($labelAgents),
                    },
                    states: {
                        hover: {
                            filter: "none"
                        }
                    },
                    grid: {
                        borderColor: "#f1f3fa"
                    },
                },
                chart = new ApexCharts(document.querySelector("#balances"), options);
            chart.render();
        });
    </script>
@endsection

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
            <div class="ml-auto">
            </div>
        </div>
    </header><!-- /.page-title-bar -->
    <!-- .page-section -->
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
                            <a href="user-teams.html" class="metric metric-bordered align-items-center">
                                <h2 class="metric-label"> Clients </h2>
                                <p class="metric-value h3">
                                    <sub><i class="oi oi-people"></i></sub> <span class="value">{{ $totalClients }}</span>
                                </p>
                            </a> <!-- /.metric -->
                        </div><!-- /metric column -->
                        <!-- metric column -->
                        <div class="col">
                            <!-- .metric -->
                            <a href="user-projects.html" class="metric metric-bordered align-items-center">
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
                            <a href="user-tasks.html" class="metric metric-bordered align-items-center">
                                <h2 class="metric-label"> Agents </h2>
                                <p class="metric-value h3">
                                    <sub><i class="fa fa-tasks"></i></sub> <span class="value">{{ $totalAgents }}</span>
                                </p>
                            </a> <!-- /.metric -->
                        </div><!-- /metric column -->
                    </div>
                </div><!-- metric column -->
                <div class="col-lg-3">
                    <!-- .metric -->
                    <a href="user-tasks.html" class="metric metric-bordered">
                        <div class="metric-badge">
                            <span class="badge badge-lg badge-success"><span class="oi oi-media-record pulse mr-1"></span>
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
                        <h3 class="card-title mb-4"> Transactions mensuels </h3>
                        <div class="chartjs" style="height: 292px">
                            <canvas id="completion-tasks"></canvas>
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
                        <h3 class="card-title">Objectif mensuel </h3><!-- easy-pie-chart -->
                        <div class="text-center pt-3">
                            <div class="chart-inline-group" style="height:214px">
                                <div class="easypiechart" data-toggle="easypiechart" data-percent="100" data-size="214"
                                    data-bar-color="#346CB0" data-track-color="false" data-scale-color="false"
                                    data-rotate="225"></div>
                                <div class="easypiechart" data-toggle="easypiechart" data-percent="75" data-size="174"
                                    data-bar-color="#00A28A" data-track-color="false" data-scale-color="false"
                                    data-rotate="225"></div>
                                <div class="easypiechart" data-toggle="easypiechart" data-percent="60" data-size="134"
                                    data-bar-color="#5F4B8B" data-track-color="false" data-scale-color="false"
                                    data-rotate="225"></div>
                            </div>
                        </div><!-- /easy-pie-chart -->
                    </div><!-- /.card-body -->
                    <!-- .card-footer -->
                    <div class="card-footer">
                        <div class="card-footer-item">
                            <i class="fa fa-fw fa-circle text-indigo"></i> 100% <div class="text-muted small"> Assigned
                            </div>
                        </div>
                        <div class="card-footer-item">
                            <i class="fa fa-fw fa-circle text-purple"></i> 75% <div class="text-muted small"> Completed
                            </div>
                        </div>
                        <div class="card-footer-item">
                            <i class="fa fa-fw fa-circle text-teal"></i> 60% <div class="text-muted small"> Active </div>
                        </div>
                    </div><!-- /.card-footer -->
                </div><!-- /.card -->
            </div><!-- /grid column -->
        </div><!-- /grid row -->


    </div><!-- /.page-section -->

@endsection
@section('script')

@endsection

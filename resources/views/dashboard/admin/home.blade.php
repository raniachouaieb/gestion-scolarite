@extends('layouts.app-admin')

@section('content')



<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Parents préinscrits</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$parentPréinscrit->count()}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Eleve préinscrit</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$elevePréinscrit->count()}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Elève inscrits</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$eleveInscrit->count()}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Parent inscrits  Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Parent inscrits</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$parentInscrit->count()}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-users" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- Earnings (Monthly) Card Example -->
        <!--<div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%"
                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->


    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Line Chart</h4>
                </div>
                <div class="card-body">
                    <div id="line-chart" data-colors="[&quot;#34c38f&quot;, &quot;#ccc&quot;]" class="e-charts" _echarts_instance_="ec_1648658706525" style="-webkit-tap-highlight-color: transparent; user-select: none;"><div style="position: relative; width: 474px; height: 350px; padding: 0px; margin: 0px; border-width: 0px; cursor: default;"><canvas data-zr-dom-id="zr_0" width="474" height="350" style="position: absolute; left: 0px; top: 0px; width: 474px; height: 350px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); padding: 0px; margin: 0px; border-width: 0px;"></canvas></div></div>
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Mix Line-Bar</h4>
                </div>
                <div class="card-body">
                    <div id="mix-line-bar" data-colors="[&quot;#34c38f&quot;, &quot;#1c84ee&quot;, &quot;#ef6767&quot;]" class="e-charts" _echarts_instance_="ec_1648658706526" style="-webkit-tap-highlight-color: transparent; user-select: none; position: relative;"><div style="position: relative; width: 474px; height: 350px; padding: 0px; margin: 0px; border-width: 0px; cursor: default;"><canvas data-zr-dom-id="zr_0" width="474" height="350" style="position: absolute; left: 0px; top: 0px; width: 474px; height: 350px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); padding: 0px; margin: 0px; border-width: 0px;"></canvas></div><div style="position: absolute; display: none; border-style: solid; white-space: nowrap; z-index: 9999999; transition: left 0.4s cubic-bezier(0.23, 1, 0.32, 1) 0s, top 0.4s cubic-bezier(0.23, 1, 0.32, 1) 0s; background-color: rgba(50, 50, 50, 0.7); border-width: 0px; border-color: rgb(51, 51, 51); border-radius: 4px; color: rgb(255, 255, 255); font: 14px / 21px &quot;Microsoft YaHei&quot;; padding: 5px; left: 110px; top: 73px; pointer-events: none;">Jan<br><span style="display:inline-block;margin-right:5px;border-radius:10px;width:10px;height:10px;background-color:#34c38f;"></span>Evaporation: 2<br><span style="display:inline-block;margin-right:5px;border-radius:10px;width:10px;height:10px;background-color:#1c84ee;"></span>Precipitation: 2.6<br><span style="display:inline-block;margin-right:5px;border-radius:10px;width:10px;height:10px;background-color:#ef6767;"></span>Average Temperature: 2</div></div>
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>


</div>

<!-- Page level plugins -->
<script src="{{ asset('admin-template/vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('admin-template/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('admin-template/js/demo/chart-pie-demo.js') }}"></script>

<script src="assets/libs/jquery/jquery.min.js"></script>
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/metismenu/metisMenu.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/node-waves/waves.min.js"></script>
<script src="assets/libs/feather-icons/feather.min.js"></script>
<script src="assets/libs/pace-js/pace.min.js"></script>
<script src="assets/libs/echarts/echarts.min.js"></script>
<script src="assets/js/pages/echarts.init.js"></script>
<script src="assets/js/app.js"></script>

@endsection

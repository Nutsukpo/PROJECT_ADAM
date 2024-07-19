@extends('layout.master')

@section('title','dashbord')

@section('content')

<div class="container-fluid">
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-success-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block text-light btn btn-sm shadow-sm" style="background-color:cadetblue"><i class="fas fa-download fa-sm text-light"></i> Generate Report</a>
</div>
<!-- Content Row -->
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-2 col-md-4 mb-2">
        <div class="card border-left  shadow h-100 py-2" style="background-color:cadetblue">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-white text-uppercase display-2 mb-1">
                            Employees</div>
                        <div class="h5 mb-0 font-weight-bold text-white">{{ $employeesCount }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-tie fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-md-4 mb-2">
        <div class="card border-left bg-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-light text-uppercase display-2 mb-1">
                            Attendance</div>
                        <div class="h5 mb-0 font-weight-bold text-light">102</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-bell fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 mb-2">
        <div class="card border-left bg-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-white text-uppercase display-2 mb-1">
                            PAYMENTS</div>
                        <div class="h5 mb-0 font-weight-bold text-white">{{ $paymentsCount }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Assets Card -->
    <div class="col-xl-2 col-md-4 mb-2">
        <div class="card border-left shadow h-100 py-2" style="background-color:burlywood">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-light text-uppercase size-7px  mb-1">
                            Assets</div>
                        <div class="h5 mb-0 font-weight-bold text-light">{{ $assetCount }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="	fas fa-pallet fa-2x text-light"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-2 col-md-4 mb-2">
        <div class="card border-left shadow h-100 py-2" style="background-color:cadetblue">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Incoming-letters
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-white">{{ $incominglettersCount }}</div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info" role="progressbar"
                                        style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-2 col-md-4 mb-2">
        <div class="card border-left bg-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                            Outgoing-letters</div>
                        <div class="h5 mb-0 font-weight-bold text-white">{{ $outgoinglettersCount }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-file fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->


<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-dark">Revenue By Month</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-dark">PERFORMANCE PER MONTH</h6>
                
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-danger"></i> Direct
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Social
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-info"></i> Referral
                    </span>
                </div>
            </div>

            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </div>
    </div>
</div>
</div>





@endsection


@section('scripts')
<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>

@endsection
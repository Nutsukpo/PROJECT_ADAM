@extends('layout.master')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-dark">Dashboard Overview</h1>
        <button class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm" style="background-color: cadetblue;" id="generateReportBtn">
            <i class="fas fa-download fa-sm text-white-50"></i> <h6 class="text-light font-weight-bold">Generate Report</h6>
        </button>
    </div>

    <!-- Metrics Row -->
    <div class="row">
        <!-- Staff Card -->
        <div class="col-xl-2 col-md-4 mb-4">
            <div class="card border-left-light shadow h-100 py-2">
                 <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                Staff</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $employeesCount }}</div>
                        </div>
                        <div class="col-auto-info">
                            <i class="fas fa-users fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Attendance Card -->
        <div class="col-xl-2 col-md-4 mb-4">
            <div class="card border-left-light shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                Attendance</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $attendanceCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-check fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payments Card -->
        <div class="col-xl-2 col-md-4 mb-4">
            <div class="card border-left-light shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                Total Payments</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $paymentsCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Assets Card -->
        <div class="col-xl-2 col-md-4 mb-4">
            <div class="card border-left-light shadow h-100 py-2">
                <div class="card-body ">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                 Assets</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $assetCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-laptop fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Incoming Letters Card -->
        <div class="col-xl-2 col-md-4 mb-4">
            <div class="card border-left-light shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                Incoming Letters</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $incominglettersCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-envelope fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Outgoing Letters Card -->
        <div class="col-xl-2 col-md-4 mb-4">
            <div class="card border-left-light shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                Outgoing Letters</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $outgoinglettersCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-paper-plane fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row">
        <!-- Operational Cost Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-white">
                    <h6 class="m-0 font-weight-bold text-info">Operational Cost Analysis</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="operationalCostDropdown" 
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" 
                             aria-labelledby="operationalCostDropdown">
                            <div class="dropdown-header">Chart Options:</div>
                            <a class="dropdown-item" href="#" id="exportOperationalCost">Export as Image</a>
                            <a class="dropdown-item" href="#" id="toggleOperationalData">Toggle Data Points</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/reports/operational-cost">View Full Report</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="operationalCostChart"></canvas>
                    </div>
                    <div class="mt-3 small text-muted">
                        <i class="fas fa-info-circle mr-1"></i> Shows monthly operational expenses for the current fiscal year
                    </div>
                </div>
            </div>
        </div>

        <!-- Performance Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-white">
                    <h6 class="m-0 font-weight-bold text-info">Monthly Performance</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="performanceDropdown" 
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" 
                             aria-labelledby="performanceDropdown">
                            <div class="dropdown-header">View Options:</div>
                            <a class="dropdown-item" href="#" id="exportPerformance">Export as Image</a>
                            <a class="dropdown-item" href="#" id="togglePerformanceLegend">Toggle Legend</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/reports/performance">View Full Report</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="performancePieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Direct
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Social
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Referral
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Activities Row -->
    <div class="row">
        <!-- Weekly Activities Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-white">
                    <h6 class="m-0 font-weight-bold text-info">Weekly Activities</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="activitiesDropdown" 
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" 
                             aria-labelledby="activitiesDropdown">
                            <div class="dropdown-header">View Options:</div>
                            <a class="dropdown-item" href="#" id="exportActivities">Export as Image</a>
                            <a class="dropdown-item" href="#" id="toggleActivitiesData">Toggle Data Points</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/reports/activities">View Full Report</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="weeklyActivitiesChart"></canvas>
                    </div>
                    <div class="mt-3 small text-muted">
                        <i class="fas fa-info-circle mr-1"></i> Tracks department activities over the past 4 weeks
                    </div>
                </div>
            </div>
        </div>

        <!-- PR Metrics Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-white">
                    <h6 class="m-0 font-weight-bold text-info">Public Relations Metrics</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="prDropdown" 
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" 
                             aria-labelledby="prDropdown">
                            <div class="dropdown-header">View Options:</div>
                            <a class="dropdown-item" href="#" id="exportPR">Export as Image</a>
                            <a class="dropdown-item" href="#" id="togglePRLegend">Toggle Legend</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/reports/pr">View Full Report</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="prMetricsChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Media
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Events
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Social
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Chart.js -->
<script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

<!-- Custom Chart Scripts -->
<script>
$(document).ready(function() {
    // Generate Report Button
    $('#generateReportBtn').click(function() {
        // Implement report generation logic
        console.log("Generating dashboard report...");
        // This would typically trigger a PDF generation or data export
    });

    // Initialize Operational Cost Chart
    var operationalCostCtx = document.getElementById('operationalCostChart');
    var operationalCostChart = new Chart(operationalCostCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Operational Cost',
                data: [12000, 19000, 15000, 18000, 20000, 22000, 25000, 23000, 21000, 24000, 26000, 28000],
                backgroundColor: 'rgba(78, 115, 223, 0.05)',
                borderColor: 'rgba(95, 158, 160, 0.8)',
                pointRadius: 3,
                pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                pointBorderColor: '#fff',
                pointHoverRadius: 3,
                pointHoverBackgroundColor: 'rgba(78, 115, 223, 1)',
                pointHoverBorderColor: '#fff',
                pointHitRadius: 10,
                pointBorderWidth: 2,
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                        label: function(context) {
                            return ' $' + context.parsed.y.toLocaleString();
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '$' + value.toLocaleString();
                        }
                    },
                    grid: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                },
                x: {
                    grid: {
                        display: false,
                        drawBorder: false
                    }
                }
            }
        }
    });

    // Initialize Performance Pie Chart
    var performancePieCtx = document.getElementById('performancePieChart');
    var performancePieChart = new Chart(performancePieCtx, {
        type: 'doughnut',
        data: {
            labels: ["Direct", "Social", "Referral"],
            datasets: [{
                data: [55, 30, 15],
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                tooltip: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
            },
            cutout: '80%',
        },
    });

    // Initialize Weekly Activities Chart
    var weeklyActivitiesCtx = document.getElementById('weeklyActivitiesChart');
    var weeklyActivitiesChart = new Chart(weeklyActivitiesCtx, {
        type: 'bar',
        data: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
            datasets: [{
                label: 'Completed',
                backgroundColor: '#5F9EA0',
                hoverBackgroundColor: '#2e59d9',
                borderColor: '#4e73df',
                data: [42, 38, 45, 50],
            }, {
                label: 'Pending',
                backgroundColor: '#e74a3b',
                hoverBackgroundColor: '#d62c1a',
                borderColor: '#e74a3b',
                data: [8, 12, 5, 10],
            }],
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                tooltip: {
                    mode: 'index',
                    intersect: false
                },
                legend: {
                    position: 'top',
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + '%';
                        }
                    }
                }
            }
        }
    });

    // Initialize PR Metrics Chart
    var prMetricsCtx = document.getElementById('prMetricsChart');
    var prMetricsChart = new Chart(prMetricsCtx, {
        type: 'pie',
        data: {
            labels: ["Media Coverage", "Events", "Social Media"],
            datasets: [{
                data: [40, 35, 25],
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                tooltip: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
            },
        },
    });

    // Export chart functions
    $('#exportOperationalCost').click(function() {
        exportChartAsImage(operationalCostChart, 'Operational-Cost');
    });

    $('#exportPerformance').click(function() {
        exportChartAsImage(performancePieChart, 'Performance-Metrics');
    });

    $('#exportActivities').click(function() {
        exportChartAsImage(weeklyActivitiesChart, 'Weekly-Activities');
    });

    $('#exportPR').click(function() {
        exportChartAsImage(prMetricsChart, 'PR-Metrics');
    });

    function exportChartAsImage(chart, filename) {
        const imageLink = document.createElement('a');
        imageLink.download = filename + '.png';
        imageLink.href = chart.toBase64Image();
        imageLink.click();
    }
});
</script>
@endsection
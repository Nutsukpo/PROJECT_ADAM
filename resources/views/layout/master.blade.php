
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ADAM V1')</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    
    <!-- Custom Styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
    @yield('styles')
    
    <!-- Preloader CSS -->
    <style>
            #preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #fff;
        z-index: 999999;
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 1;
        transition: opacity 0.5s ease 0.2s; /* Added 0.2s delay before transition starts */
        }
        
        .loader {
            width: 48px;
            height: 48px;
            border: 5px solid cadetblue;
            border-bottom-color: transparent;
            border-radius: 50%;
            display: inline-block;
            box-sizing: border-box;
            animation: rotation 1s linear infinite;
        }
        
        @keyframes rotation {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
        
        .loader-text {
            margin-top: 20px;
            color: cadetblue;
            font-weight: bold;
            text-align: center;
            font-size: 1.2rem;
        }
        
        .loader-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>

<body id="page-top" class="sidebar-toggled">

<!-- Preloader -->
<div id="preloader">
    <div class="loader-container">
        <div class="loader"></div>
        <div class="loader-text">Loading ADAM V1...</div>
    </div>
</div>

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-dark accordion bg-cadetblue" id="accordionSidebar">
        <!-- Sidebar Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
            <div class="sidebar-brand-icon rotate-n-1">
                <i class="fas fa-cloud"></i>
            </div>
            <div class="sidebar-brand-text text-light font-weight-bold">ADAM<sup>V1</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        @can('viewEmployee')
        <!-- Staff Management -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStaff" aria-expanded="true">
                <i class="fas fa-users"></i>
                <span class="text-light font-weight-bold">Staff Management</span>
            </a>
            <div id="collapseStaff" class="collapse" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="/employees">Lists</a>
                    @can('createEmployee')
                    <a class="collapse-item" href="/employees/create">Add Employee</a>
                    @endcan
                </div>
            </div>
        </li>
        @endcan

        <!-- Asset Register -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAssets" aria-expanded="true">
                <i class="fas fa-laptop"></i>
                <span class="text-light font-weight-bold">Asset Register</span>
            </a>
            <div id="collapseAssets" class="collapse" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="/assets">Lists</a>
                    @can('createAsset')
                    <a class="collapse-item" href="/assets/create">Add Asset</a>
                    @endcan
                </div>
            </div>
        </li>

        <!-- Letters Management -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLetters" aria-expanded="true">
                <i class="fas fa-envelope"></i>
                <span class="text-light font-weight-bold">Letter Magt</span>
            </a>
            <div id="collapseLetters" class="collapse" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Incoming Letters</h6>
                    <a class="collapse-item" href="/incomingletters">Lists</a>
                    <a class="collapse-item" href="/incomingletters/create">Add Letter</a>
                    
                    <div class="dropdown-divider"></div>
                    
                    <h6 class="collapse-header">Outgoing Letters</h6>
                    <a class="collapse-item" href="/outgoingletters">Lists</a>
                    <a class="collapse-item" href="/outgoingletters/create">Add Letter</a>
                </div>
            </div>
        </li>

        <!-- Visitors -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseVisitors" aria-expanded="true">
                <i class="fas fa-user-friends"></i>
                <span class="text-light font-weight-bold">Visitors Records</span>
            </a>
            <div id="collapseVisitors" class="collapse" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="/visitors">List</a>
                    @can('createVisitor')
                    <a class="collapse-item" href="/visitors/create">Add Visitor</a>
                    @endcan
                </div>
            </div>
        </li>

        <!-- Attendance -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAttendance" aria-expanded="true">
                <i class="fas fa-calendar-check"></i>
                <span class="text-light font-weight-bold">Attendance Manager</span>
            </a>
            <div id="collapseAttendance" class="collapse" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="/attendance">Lists</a>
            
                    <a class="collapse-item" href="/attendance/create">Attendance</a>
                </div>
            </div>
        </li>

        
        <!-- Payments -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePayments" aria-expanded="true">
                <i class="fas fa-money-bill-wave"></i>
                <span class="text-light font-weight-bold">Payments</span>
            </a>
            <div id="collapsePayments" class="collapse" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="/payments">Lists</a>
                    <a class="collapse-item" href="/payments/create">G.P-Voucher</a>
                    <a class="collapse-item" href="/payroll">Payrolls</a>
                </div>
            </div>
        </li>
        

        <!-- Memo Tracker -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMemos" aria-expanded="true">
                <i class="fas fa-sticky-note text-warning"></i>
                <span class="text-warning font-weight-bold">Memo Tracker</span>
            </a>
            <div id="collapseMemos" class="collapse" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="/memos">Memo List</a>
                    <a class="collapse-item" href="/memos/create">Add Memo</a>
                </div>
            </div>
        </li>

        <!-- Leave Tracker -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLeave" aria-expanded="true">
                <i class="fas fa-calendar-alt text-warning"></i>
                <span class="text-warning font-weight-bold">Leave Tracker</span>
            </a>
            <div id="collapseLeave" class="collapse" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="leaves">Applications</a>
                    <a class="collapse-item" href="leaves/create">Apply Leave</a>
                </div>
            </div>
        </li>

        <!-- Approvals -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMyapprovals" aria-expanded="true">
                <i class="fas fa-user-friends"></i>
                <span class="text-light font-weight-bold">My Approvals</span>
            </a>
            <div id="collapseMyapprovals" class="collapse" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="/approvals">Memos</a>
                    <a class="collapse-item" href="/Payments">Payments</a>
                    <a class="collapse-item" href="/Leave">Leave</a>
                    <a class="collapse-item" href="/Reports">Reports</a>
                </div>
            </div>
        </li>
        <!-- Grievance -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGrievance" aria-expanded="true">
                <i class="fas fa-exclamation-triangle text-warning"></i>
                <span class="text-warning font-weight-bold">Grievance</span>
            </a>
            <div id="collapseGrievance" class="collapse" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="#">List Cases</a>
                    <a class="collapse-item" href="#">Register Case</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReport" aria-expanded="false" aria-controls="collapseReport">
        <i class="fas fa-chart-line text-light"></i>
        <span class="text-light font-weight-bold">Monthly Reports</span>
        <!-- <span class="badge badge-danger badge-pill ml-2">New</span> -->
    </a>
    <div id="collapseReport" class="collapse" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Report Actions:</h6>
            <a class="collapse-item d-flex align-items-center" href="/reports">
                <i class="fas fa-list mr-2 text-muted"></i>
                View All Reports
                <span class="badge badge-info badge-pill ml-auto">5</span>
            </a>
            <a class="collapse-item d-flex align-items-center" href="/reports/create">
                <i class="fas fa-plus-circle mr-2 text-success"></i>
                Create New Report
            </a>
            <div class="dropdown-divider"></div>
            <h6 class="collapse-header">Quick Access:</h6>
            <a class="collapse-item d-flex align-items-center" href="/reports/templates">
                <i class="fas fa-file-alt mr-2 text-info"></i>
                Report Templates
            </a>
            <a class="collapse-item d-flex align-items-center" href="/reports/archived">
                <i class="fas fa-archive mr-2 text-warning"></i>
                Archived Reports
            </a>
        </div>
    </div>
</li>

        @can('viewUser')
        <!-- User Management -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true">
                <i class="fas fa-user-cog"></i>
                <span class="text-light font-weight-bold">User Management</span>
            </a>
            <div id="collapseUsers" class="collapse" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="/users">Lists</a>
                    <a class="collapse-item" href="/users/create">Add User</a>
                    <a class="collapse-item" href="/users/roles">Manage Roles</a>
                </div>
            </div>
        </li>
        @endcan

        @can('viewSettings')
        <!-- System Settings -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSettings" aria-expanded="true">
                <i class="fas fa-cogs"></i>
                <span class="text-light font-weight-bold">System Settings</span>
            </a>
            <div id="collapseSettings" class="collapse" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="#">Tools</a>
                    <a class="collapse-item" href="#">More</a>
                </div>
            </div>
        </li>
        @endcan

        <!-- Help -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseHelp" aria-expanded="true">
                <i class="fas fa-question-circle"></i>
                <span class="text-light font-weight-bold">Help</span>
            </a>
            <div id="collapseHelp" class="collapse" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="#">Online Help</a>
                    <a class="collapse-item" href="#">Contact Admin</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle" aria-label="Toggle sidebar"></button>
        </div>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Alerts Dropdown -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <span class="badge badge-danger badge-counter">3+</span>
                            <span class="sr-only">Alerts</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">Alerts Center</h6>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 12, 2023</div>
                                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                </div>
                            </a>
                            <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                        </div>
                    </li>

                    <!-- Messages Dropdown -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-envelope fa-fw"></i>
                            <span class="badge badge-danger badge-counter">7</span>
                            <span class="sr-only">Messages</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                            <h6 class="dropdown-header">Message Center</h6>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="{{ asset('img/avatar.png') }}" alt="...">
                                    <div class="status-indicator bg-success"></div>
                                </div>
                                <div class="font-weight-bold">
                                    <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                                </div>
                            </a>
                            <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                        </div>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-dark font-weight-bold small">{{ Auth::user()->name }}</span>
                            <img class="img-profile rounded-circle" src="{{ asset('img/avatar.png') }}" alt="User Profile">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-info"></i>
                                Profile
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-info"></i>
                                Settings
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-info"></i>
                                Activity Log
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-info"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Mother-Side Web Artisans {{ date('Y') }}</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top" aria-label="Scroll to top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form action="/logout" method="POST">
                    @csrf
                    <button class="btn btn-danger" type="submit">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Core JavaScript -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- Preloader Script -->
<script>
    // Wait for window load
    $(window).on('load', function() {
        // Animate loader off screen
        $("#preloader").fadeOut("slow");
    });
    
    // Fallback in case window load event doesn't fire
    setTimeout(function() {
        $("#preloader").fadeOut("slow");
    }, 3000); // 3 seconds timeout as fallback
</script>

@if(Session::has('messages'))
<script>
    toastr.success("{{ Session::get('messages') }}");
</script>
@endif

@yield('scripts')

<style>
    .bg-cadetblue {
        background-color: cadetblue;
    }
    
    .sidebar .nav-item .nav-link {
        padding: 0.75rem 1rem;
    }
    
    .sidebar .nav-item .nav-link i {
        margin-right: 0.5rem;
    }
    
    .sidebar .nav-item .collapse-inner {
        padding: 0.5rem 0;
    }
    
    .sidebar .nav-item .collapse-inner .collapse-item {
        padding: 0.5rem 1.5rem;
    }
    
    .sidebar-brand-text {
        font-size: 1rem;
    }
    
    #sidebarToggle {
        background-color: rgba(255,255,255,0.1);
    }
    
    #sidebarToggle:hover {
        background-color: rgba(255,255,255,0.2);
    }
</style>

</body>
</html>
@extends('layout.header')

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" style="background-color:cadetblue; " id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
                <div class="sidebar-brand-icon rotate-n-1">
                    <i class="	fas fa-cloud ml-md-1" ></i>
                </div>
                <div class="sidebar-brand-text text-bold text-light text-7px mr-8 pr-5" >ADAM<sup>V1</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Divider -->
            @can('viewEmployee')
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseSix">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                    <span class="text-bold text-light text-4xl">Staff Management </span>
                </a>
                <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="/employees">Lists</a>
                        @can('createEmployee')
                        <a class="collapse-item text-dark" href="/employees/create">Add Employee</a>
                        @endcan
                    </div>
                </div>
            </li>  
            @endcan 
            <!-- <div class="bg-info"> -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                    <span class="text-bold text-light text-4xl">Asset Register </span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="/assets">Lists</a>
                        @can('createAsset')
                        <a class="collapse-item text-dark" href="/assets/create">Add Asset</a>
                        @endcan
                    </div>
                </div>
            </li> 
            <!-- </div> -->
             <!-- <div class="bg-info"> -->
             <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                    aria-expanded="true" aria-controls="collapseThree">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                    <span class="text-bold text-light text-4xl">In-coming letters</span>
                </a>
                <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="/incomingletters">Lists</a>
                        @can('createincomingletter')
                        <a class="collapse-item" href="/incomingletters/create">Add letter </a>
                        @endcan
                    </div>
                </div>
            </li> 
            <!-- </div> -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
                    aria-expanded="true" aria-controls="collapseFour">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                    <span class="text-bold text-light text-4xl">Out-going-letters </span>
                </a>
                <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="/outgoingletters">Lists</a>
                        @can('createoutgoingletter')
                        <a class="collapse-item" href="/outgoingletters/create">Add letter </a>
                        @endcan
                    </div>
                </div>
            </li> 

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEleven"
                    aria-expanded="true" aria-controls="collapseOne">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                    <span class="text-bold text-light text-4xl">Visitors Records </span>  
                </a>
                <div id="collapseEleven" class="collapse bg-white" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="/visitors">List</a>
                        @can('createVisitor')
                        <a class="collapse-item" href="/visitors/create">Add Visitor </a>
                        @endcan
                    </div>
                </div>
            </li> 

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive"
                    aria-expanded="true" aria-controls="collapseEight">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                    <span class="text-bold text-light text-4xl">Attendance Manager </span>
                </a>
                <div id="collapseFive" class="collapse bg-white" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="/attendance">Lists</a>
                        <a class="collapse-item" href="/attendance/create">Attendance </a>
                    </div>
                </div>
            </li> 
            @can('viewPayment')
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix"
                    aria-expanded="true" aria-controls="collapseSeven">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                    <span class="text-bold text-light text-4xl">Payments </span>
                </a>
                <div id="collapseSix" class="collapse bg-dark aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="/payments">Lists</a>
                        <a class="collapse-item" href="/payments/create">Pay Saff</a>
                    </div>
                </div>
            </li>
            @endcan
            
            
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSeven"
                    aria-expanded="true" aria-controls="collapseTen">
                    <!-- <i class="fas fa-fw fa-cog bg-light"></i> -->
                    <!-- <i class="fa fa-thermometer-full fa-4x bg-danger" aria-hidden="true"></i> -->
                    <!-- <i class="fa fa-cog" aria-hidden="true"></i> -->
                    <i class="fa fa-fighter-jet" aria-hidden="true"></i>

                    <span class="text-bold text-warning text-4xl">MeMo Tracker </span> 
                    <i class="bi bi-sign-railroad"></i> 
                </a>
                <div id="collapseSeven" class="collapse bg-warning" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-warning py-2 collapse-inner rounded">
                        <a class="collapse-item" href="#">MeMo List</a>
                        <a class="collapse-item" href="#">Add Memo </a>
                    </div>
                </div>
            </li> 

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEight"
                    aria-expanded="true" aria-controls="collapseFive">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                    <span class="text-bold text-light text-4xl">User Management </span>  
                </a>
                <div id="collapseEight" class="collapse bg-white" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="/users">Lists</a>
                        <a class="collapse-item" href="/users/create">Add User </a>
                        <a class="collapse-item" href="/users/roles">Manage Roles </a>
                        

                    </div>
                </div>
            </li> 

            <li class="nav-item">
                <a class="nav-link collapsed" href="/users/create" data-toggle="collapse" data-target="#collapseNine"
                    aria-expanded="true" aria-controls="collapseFive">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                    <span class="text-bold text-light text-4xl">System Settings </span>  
                </a>
                <div id="collapseNine" class="collapse bg-white" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="#">Tools</a>
                        <a class="collapse-item" href="#">More </a>
                        
                    </div>
                </div>
            </li> 
          
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTen"
                    aria-expanded="true" aria-controls="collapseOne">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                    <span class="text-bold text-light text-4xl">Help </span>  
                </a>
                <div id="collapseTen" class="collapse bg-white" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="#">Online Help</a>
                        <a class="collapse-item" href="#">Contact Admin </a>
                    </div>
                </div>
            </li> 
          

            <!-- Divider -->        

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class=" border-0 " id="sidebarToggle"></button>
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
                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="https://web.facebook.com" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-dark small">{{Auth::user()->name}}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{asset('img/avatar.png')}}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
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
                        <span>Copyright &copy; Mother-Side Web Artisans <?php echo $today = date ( "d/m/Y" );?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn text-light" style="background-color:cadetblue ;" type="button" data-dismiss="modal">Cancel</button>
                    <form action="/logout" method="POST">
                    @csrf
                    <button class="btn btn-danger" type="submit">
                        Logout
                    </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        @if(Session::has('messages'))
            <script>
                toastr.success("{{Session::get('messages')}}");
            </script>
    
        @endif

    @yield('scripts')



<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.bootstrap5.js"></script>

</body>

</html>
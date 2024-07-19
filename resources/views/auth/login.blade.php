@extends('layout.header')
@section('title', 'Login')
   
<body class="bg-gradient-light">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9 pt-5 mt-5">             
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body ">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                            <img class="img-profile-small pt-5"style="size: 20px; width:100%" src="{{asset('img/officeassistant.png')}}">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back ADAM !!!</h1>
                                    </div>                          
                                    <form class="user" action="/login" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..." name="email" value="{{ old('email')}}" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control"
                                                id="exampleInputPassword" placeholder="Password" name="password" required>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button class="btn btn-block form-control my-1 p-1 text-light" type="submit" style="background-color:cadetblue">Login</button>                                         
                                    
                                    @error('errors') 
                                        <div class="card bg-danger text-white shadow">
                                            <div class="card-body">
                                                {{$message}}
                                            </div>
                                        </div>
                                    @enderror
                                    </form>
                                    
                                    <div class="text-center">
                                        <a class="small text-info" href="forgot-password.html" style="text-decoration:none">Forgot Password?</a>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>                 
                        </div>
                    </div>
                </div>
            </div>
        </div
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

</body>

</html>
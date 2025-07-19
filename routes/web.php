<?php

use App\Http\Controllers\Authcontoller;
use App\Http\Controllers\assetcontroller;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usercontroller;
use App\Http\Controllers\employeecontroller;
use App\Http\Controllers\incomingletterscontroller;
use App\Http\Controllers\outgoingletterscontroller;
use App\Http\Controllers\dashboardcontroller;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\paymentcontroller;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/','login');
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login',[Authcontoller::class, 'login']);

Route::group(['middleware'=>['auth']], function(){
    Route::post('/logout',[Authcontoller::class, 'logout']);

    Route::get('/dashboard', function () {
        return view('dashboard.index');
    });

    Route::get('/dashboard', [dashboardcontroller::class, 'index'])->name('dashboard');



// creating users routes
    #this route is for the user table or list
    Route::get('/users',[usercontroller::class,'index']);

    #this route is for the users form
    Route::get('/users/create',[usercontroller::class,'create']);
    Route::post('/users/create',[usercontroller::class,'store'])->name('user.create');

    //route to return view to edit user details
    Route::get('/users/{id}/edit',[usercontroller::class,'edit']); 

    //route to return view to view details of a single user
    Route::get('/users/{id}/watch',[usercontroller::class,'watch']);

    //route to update user details in the database
    Route::post('/users/{id}/update',[usercontroller::class,'update']);
    Route::post('/users/{id}/delete',[usercontroller::class,'delete']);


// creating employes routes
    #this route is for the employes table or list
    Route::get('/employees',[employeecontroller::class,'index']);

    #this route is for the employees form
    Route::get('/employees/create',[employeecontroller::class,'create']);
    Route::post('/employees/create',[employeecontroller::class,'store'])->name('employee.create');

    //route to return view to edit employees details
    Route::get('/employees/{id}/edit',[employeecontroller::class,'edit'])->name('employees.edit');

    //route to return view to view details of a single employee
    Route::get('/employees/{id}/watch',[employeecontroller::class,'watch']);
    
    //route to update employee details in the database
    Route::post('/employees/{id}/update',[employeecontroller::class,'update']);
    Route::post('/employees/{id}/delete',[employeecontroller::class,'delete']);


// creating assets routes
    #this route is for the assets table or list
    Route::get('/assets',[assetcontroller::class,'index']);

    #this route is for the assets form
    Route::get('/assets/create',[assetcontroller::class,'create']);
    Route::post('/assets/create',[assetcontroller::class,'store'])->name('asset.create');

    // route to return view to edit assets details
    Route::get('/assets/{id}/edit',[assetcontroller::class,'edit'])->name('asset.edit');
    // route to return view to view details of a single incomingletters
    Route::get('/assets/{id}/watch',[assetcontroller::class,'watch']);

    //route to update assets details in the database
    Route::post('/assets/{id}/update',[assetcontroller::class,'update']);
    Route::post('/assets/{id}/delete',[assetcontroller::class,'delete']);


// creating incomingletters routes
     #this route is for the incomingletters table or list
     Route::get('/incomingletters',[incomingletterscontroller::class,'index']);

     #this route is for the incomingletters form
     Route::get('/incomingletters/create',[incomingletterscontroller::class,'create']);
     Route::post('/incomingletters/create',[incomingletterscontroller::class,'store'])->name('incomingletters.create');
 
     //route to return view to edit incomingletters details
     Route::get('/incomingletters/{id}/edit',[incomingletterscontroller::class,'edit']);

     //route to return view to view details of a single incomingletters
     Route::get('/incomingletters/{id}/watch',[incomingletterscontroller::class,'watch']);
 
     //route to update incomingletters details in the database
     Route::post('/incomingletters/{id}/update',[incomingletterscontroller::class,'update']);
 
     Route::post('/incomingletters/{id}/delete',[incomingletterscontroller::class,'delete']);


// creating outgoingletters routes
    #this route is for the outgoingletters table or list
    Route::get('/outgoingletters',[outgoingletterscontroller::class,'index']);

    #this route is for the outgoingletters form
     Route::get('/outgoingletters/create',[outgoingletterscontroller::class,'create'])->name('outgoingletters.create');
     Route::post('/outgoingletters/create',[outgoingletterscontroller::class,'store'])->name('outgoingletters.create');

     //route to return view to edit outgoingletters details
     Route::get('/outgoingletters/{id}/edit',[incomingletterscontroller::class,'edit']);

     //route to return view to view details of a single incomingletters
     Route::get('/outgoingletters/{id}/watch',[outgoingletterscontroller::class,'watch']);
 
     //route to update outgoingletters details in the database
     Route::post('/outgoingletters/{id}/update',[outgoingletterscontroller::class,'update']);
     Route::post('/outgoingletters/{id}/delete',[outgoingletterscontroller::class,'delete']);

//  creating attendance routes
    #this route is for the attendance Clock-in form
    Route::get('/attendance',[AttendanceController::class,'index']);

    #this route is for the attendance form
    Route::get('/attendance/create',[AttendanceController::class,'create'])->name('attendance.create');
    Route::post('/attendance/create',[AttendanceController::class,'store'])->name('attendance.create');

// creating payment routes
    #this route is for the payment table or list
    Route::get('/payments',[paymentcontroller::class,'index']);

    #this route is for the payment form
    Route::get('/payments/create',[paymentcontroller::class,'create']);
    Route::post('/payments/create',[paymentcontroller::class,'store'])->name('payments.create');

    //route to return view to edit payment details
    Route::get('/payments/{id}/edit',[paymentcontroller::class,'edit']);

    //route to return view to view details of a single payment
    Route::get('/payments/{id}/watch',[paymentcontroller::class,'watch']);

    //route to update payment details in the database
    Route::post('/payments/{id}/update',[paymentcontroller::class,'update']);
    Route::post('/payments/{id}/delete',[paymentcontroller::class,'delete']);  
});

Route::get('/register', function () {
    return view('auth.register');

});


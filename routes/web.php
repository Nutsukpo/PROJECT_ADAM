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
use App\Http\Controllers\visitorscontroller;
use App\Http\Controllers\RoleController;
use App\Models\payments;

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
});

    Route::get('/dashboard', function () {
        return view('dashboard.index');
    });

    Route::get('/dashboard', [dashboardcontroller::class, 'index'])->name('dashboard');



// creating users routes
Route::prefix('/users')->middleware('permission:viewUser')->group(function () {
    #this route is for the user table or list
    Route::get('/',[usercontroller::class,'index']);

    #this route is for the users form
    Route::get('/create',[usercontroller::class,'create']);
    Route::post('/create',[usercontroller::class,'store'])->name('user.create');
    Route::get('/roles',[usercontroller::class,'userRoles']);
    Route::get('/role/create',[usercontroller::class,'createRole']);
    Route::post('/role/create',[usercontroller::class,'storeRole'])->name('role.create');
    Route::get('/role/{id}/watch',[usercontroller::class,'watchRole']);
    Route::get('/role/{id}/edit',[usercontroller::class,'editRole']);
    Route::post('/role/{id}/update',[usercontroller::class,'updateRole']);
    Route::post('/role/{id}/delete',[usercontroller::class,'deleteRole']);

    Route::post('/updateRole',[usercontroller::class,'store'])->name('user.updateRole');

    //route to return view to edit user details
    Route::get('/{id}/edit',[usercontroller::class,'edit']); 

    //route to return view to view details of a single user
    Route::get('/{id}/watch',[usercontroller::class,'watch']);

    //route to update user details in the database
    Route::post('/{id}/update',[usercontroller::class,'update']);
    Route::post('/{id}/delete',[usercontroller::class,'delete']);
});



// creating employes routes
    #this route is for the employes table or list
    Route::prefix('/employees')->middleware('permission:viewEmployee')->group(function () {
        Route::get('/',[employeecontroller::class,'index']);
    
        #this route is for the employees form
        Route::get('/create',[employeecontroller::class,'create'])->middleware('permission:createEmployee');
        Route::post('/create',[employeecontroller::class,'store'])->name('employee.create');
    
        //route to return view to edit employees details
        Route::get('/{id}/edit',[employeecontroller::class,'edit'])->middleware('permission:editEmployee');
    
        //route to return view to view details of a single employee
        Route::get('/{id}/watch',[employeecontroller::class,'watch']);
        
        //route to update employee details in the database
        Route::post('/{id}/update',[employeecontroller::class,'update']);
        Route::post('/{id}/delete',[employeecontroller::class,'delete'])->middleware('permission:deleteEmployee');
    });

    



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
     Route::get('/outgoingletters/{id}/edit',[outgoingletterscontroller::class,'edit']);

     //route to return view to view details of a single outgoingletters
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

// middleware for payments
    Route::prefix('/payments')->middleware('permission:viewPayments')->group(function () {
        Route::get('/',[paymentcontroller::class,'index']);

    #this route is for the payment form
    Route::get('/create',[paymentcontroller::class,'create']);
    Route::post('/payments/create',[paymentcontroller::class,'store'])->name('payments.create');

    //route to return view to edit payment details
    Route::get('/payments/{id}/edit',[paymentcontroller::class,'edit']);

    //route to return view to view details of a single payment
    Route::get('/payments/{id}/watch',[paymentcontroller::class,'watch']);

    //route to update payment details in the database
    Route::post('/payments/{id}/update',[paymentcontroller::class,'update']);
    Route::post('/payments/{id}/delete',[paymentcontroller::class,'delete']); 
    
// creating visitors routes
    #this route is for the visitors table or list
    Route::get('/visitors',[visitorscontroller::class,'index']);

    #this route is for the visitors form
    Route::get('/visitors/create',[visitorscontroller::class,'create']);
    Route::post('/visitors/create',[visitorscontroller::class,'store'])->name('visitors.create');

    // route to return view to edit visitors details
    Route::get('/visitors/{id}/edit',[visitorscontroller::class,'edit'])->name('visitors.edit');
    // route to return view to view details of a single visitor
    Route::get('/visitors/{id}/watch',[visitorscontroller::class,'watch']);

    //route to update visitors details in the database
    Route::post('/visitors', [visitorsController::class, 'store'])->name('visitors.store');
    Route::post('/visitors/{id}/delete',[visitorsController::class,'delete'])->name('visitors.delete');
    Route::post('/visitors/{id}/update',[visitorsController::class,'update'])->name('visitors.update');
});

Route::get('/register', function () {
    return view('auth.register');

});
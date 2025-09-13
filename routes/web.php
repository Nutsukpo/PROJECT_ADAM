<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    Authcontoller,
    AssetController,
    UserController,
    EmployeeController,
    IncomingLettersController,
    OutgoingLettersController,
    DashboardController,
    FileUploadController,
    AttendanceController,
    PaymentController,
    VisitorsController,
    MemosController,
    MemosApprovalController,
    PayrollController,
    RoleController,
    LeavesController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::redirect('/', 'login');
Route::get('/login', fn() => view('auth.login'))->name('login');
Route::post('/login', [Authcontoller::class, 'login']);

Route::middleware(['auth'])->group(function () {

    Route::post('/logout', [Authcontoller::class, 'logout']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /**
     * USERS
     */
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/', [UserController::class, 'store'])->name('users.store');

        // Roles
        Route::get('/roles', [UserController::class, 'userRoles'])->name('users.roles');
        Route::get('/role/create', [UserController::class, 'createRole'])->name('users.roles.create');
        Route::post('/role', [UserController::class, 'storeRole'])->name('users.roles.store');
        Route::get('/role/{id}/watch', [UserController::class, 'watchRole'])->name('users.roles.watch');
        Route::get('/role/{id}/edit', [UserController::class, 'editRole'])->name('users.roles.edit');
        Route::put('/role/{id}', [UserController::class, 'updateRole'])->name('users.roles.update');
        Route::delete('/role/{id}', [UserController::class, 'deleteRole'])->name('users.roles.delete');

        // Users
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::get('/{id}/watch', [UserController::class, 'watch'])->name('users.watch');
        Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{id}', [UserController::class, 'delete'])->name('users.delete');
    });

    /**
     * EMPLOYEES
     */
    Route::prefix('employees')->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('employees.index');
        Route::get('/create', [EmployeeController::class, 'create'])->name('employees.create');
        Route::post('/', [EmployeeController::class, 'store'])->name('employees.store');

        Route::get('/{id}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
        Route::get('/{id}/watch', [EmployeeController::class, 'watch'])->name('employees.watch');
        Route::put('/{id}', [EmployeeController::class, 'update'])->name('employees.update');
        Route::delete('/{id}', [EmployeeController::class, 'destroy'])->name('employees.delete');
    });

    /**
     * ASSETS
     */
    Route::prefix('assets')->group(function () {
        Route::get('/', [AssetController::class, 'index'])->name('assets.index');
        Route::get('/create', [AssetController::class, 'create'])->name('assets.create');
        Route::post('/', [AssetController::class, 'store'])->name('assets.store');
    
        Route::get('/{id}/edit', [AssetController::class, 'edit'])->name('assets.edit');
        Route::get('/{id}/watch', [AssetController::class, 'watch'])->name('assets.watch');
        Route::put('/{id}', [AssetController::class, 'update'])->name('assets.update');
        Route::delete('/{id}', [AssetController::class, 'delete'])->name('assets.delete');
    });
    
    /**
     * INCOMING LETTERS
     */
    Route::prefix('incomingletters')->group(function () {
        Route::get('/', [IncomingLettersController::class, 'index'])->name('incomingletters.index');
        Route::get('/create', [IncomingLettersController::class, 'create'])->name('incomingletters.create');
        Route::post('/', [IncomingLettersController::class, 'store'])->name('incomingletters.store');

        Route::get('/{id}/edit', [IncomingLettersController::class, 'edit'])->name('incomingletters.edit');
        Route::get('/{id}/watch', [IncomingLettersController::class, 'watch'])->name('incomingletters.watch');
        Route::put('/{id}', [IncomingLettersController::class, 'update'])->name('incomingletters.update');
        Route::delete('/{id}', [IncomingLettersController::class, 'delete'])->name('incomingletters.delete');
    });

    /**
     * OUTGOING LETTERS
     */
    Route::prefix('outgoingletters')->group(function () {
        Route::get('/', [OutgoingLettersController::class, 'index'])->name('outgoingletters.index');
        Route::get('/create', [OutgoingLettersController::class, 'create'])->name('outgoingletters.create');
        Route::post('/', [OutgoingLettersController::class, 'store'])->name('outgoingletters.store');

        Route::get('/{id}/edit', [OutgoingLettersController::class, 'edit'])->name('outgoingletters.edit');
        Route::get('/{id}/watch', [OutgoingLettersController::class, 'watch'])->name('outgoingletters.watch');
        Route::put('/{id}', [OutgoingLettersController::class, 'update'])->name('outgoingletters.update');
        Route::delete('/{id}', [OutgoingLettersController::class, 'delete'])->name('outgoingletters.delete');
    });

    /**
     * ATTENDANCE
     */
    Route::prefix('attendance')->group(function () {
        Route::get('/', [AttendanceController::class, 'index'])->name('attendance.index');
        Route::get('/create', [AttendanceController::class, 'create'])->name('attendance.create');
        Route::post('/', [AttendanceController::class, 'store'])->name('attendance.store');

        Route::get('/{id}/edit', [AttendanceController::class, 'edit'])->name('attendance.edit');
        Route::get('/{id}/watch', [AttendanceController::class, 'watch'])->name('attendance.watch');
        Route::put('/{id}', [AttendanceController::class, 'update'])->name('attendance.update');
        Route::delete('/{id}', [AttendanceController::class, 'delete'])->name('attendance.delete');

        Route::post('/{id}/clock-out', [AttendanceController::class, 'clockOut'])->name('attendance.clockOut');
    });

    /**
     * PAYMENTS
     */
    Route::prefix('payments')->middleware('permission:viewPayment')->group(function () {
        Route::get('/', [PaymentController::class, 'index'])->name('payments.index');
        Route::get('/create', [PaymentController::class, 'create'])->name('payments.create')->middleware('permission:createPayment');
        Route::post('/', [PaymentController::class, 'store'])->name('payments.store')->middleware('permission:createPayment');
    });

    /**
     * VISITORS
     */
    Route::prefix('visitors')->group(function () {
        Route::get('/', [VisitorsController::class, 'index'])->name('visitors.index');
        Route::get('/create', [VisitorsController::class, 'create'])->name('visitors.create');
        Route::post('/', [VisitorsController::class, 'store'])->name('visitors.store');

        Route::get('/{id}/edit', [VisitorsController::class, 'edit'])->name('visitors.edit');
        Route::get('/{id}/watch', [VisitorsController::class, 'watch'])->name('visitors.watch');
        Route::put('/{id}', [VisitorsController::class, 'update'])->name('visitors.update');
        Route::delete('/{id}', [VisitorsController::class, 'delete'])->name('visitors.delete');
    });

    /**
     * MEMOS
     */
    Route::prefix('memos')->group(function () {
        Route::get('/', [MemosController::class, 'index'])->name('memos.index');
        Route::get('/create', [MemosController::class, 'create'])->name('memos.create');
        Route::post('/', [MemosController::class, 'store'])->name('memos.store');
        Route::get('/{id}/edit', [MemosController::class, 'edit'])->name('memos.edit');
        Route::put('/{id}', [MemosController::class, 'update'])->name('memos.update');
        Route::delete('/{id}', [MemosController::class, 'delete'])->name('memos.delete');
        Route::get('/{id}/watch', [MemosController::class, 'watch'])->name('memos.watch');
        Route::get('/{id}/download-pdf', [MemosController::class, 'downloadPDF'])->name('memos.download.pdf');
        Route::get('/{id}/download-word', [MemosController::class, 'downloadWord'])->name('memos.download.word'); 

        // ✅ fixed (removed duplicate "memos/")
        Route::post('/{memo}/minutes', [MemosController::class, 'addMinutes'])
            ->name('memos.addMinutes');
    });

    /**
     * LEAVES
     */
    Route::prefix('leaves')->group(function () {
        Route::get('/', [LeavesController::class, 'index'])->name('leaves.index');
        Route::get('/create', [LeavesController::class, 'create'])->name('leaves.create');
        Route::post('/', [LeavesController::class, 'store'])->name('leaves.store');
        Route::get('/{id}/edit', [LeavesController::class, 'edit'])->name('leaves.edit');
        Route::put('/{id}', [LeavesController::class, 'update'])->name('leaves.update');
        Route::delete('/{id}', [LeavesController::class, 'destroy'])->name('leaves.destroy');
    
        Route::get('/{id}/watch', [LeavesController::class, 'watch'])->name('leaves.watch');
        Route::get('/{id}/download-pdf', [LeavesController::class, 'downloadPDF'])->name('leaves.download.pdf');
        Route::get('/{id}/download-word', [LeavesController::class, 'downloadWord'])->name('leaves.download.word');
    
        Route::post('/{id}/approve', [LeavesController::class, 'approve'])->name('leaves.approve');
        Route::post('/{id}/reject', [LeavesController::class, 'reject'])->name('leaves.reject');
    });

    /**
     * APPROVALS
     */
    Route::prefix('approvals')->name('approvals.')->group(function () {
        Route::get('/', [MemosApprovalController::class, 'index'])->name('index');
        Route::get('/status/{status}', [MemosApprovalController::class, 'filterByStatus'])->name('filter');
        Route::get('/{memo}', [MemosApprovalController::class, 'show'])->name('show');
    
        Route::post('/{memo}/next-stage', [MemosApprovalController::class, 'moveToNextStage'])
            ->name('next-stage');
        
        Route::post('/{memo}/previous-stage', [MemosApprovalController::class, 'moveToPreviousStage'])
            ->name('previous-stage');

        // ✅ fixed (removed "memos/")
        Route::post('/{memo}/update', [MemosController::class, 'updateMinutes'])
            ->name('memo.update');
    });

    /**
     * PAYROLL
     */
    Route::prefix('payroll')->group(function () {
        Route::get('/', [PayrollController::class, 'index'])->name('payroll.index');
        Route::get('/create', [PayrollController::class, 'create'])->name('payroll.create');
        Route::post('/', [PayrollController::class, 'store'])->name('payroll.store');
        Route::get('/{payroll}', [PayrollController::class, 'show'])->name('payroll.show');
        Route::get('/{payroll}/edit', [PayrollController::class, 'edit'])->name('payroll.edit');
        Route::put('/{payroll}', [PayrollController::class, 'update'])->name('payroll.update');
        Route::delete('/{payroll}', [PayrollController::class, 'destroy'])->name('payroll.delete');
        
        Route::post('/{payroll}/add-employee', [PayrollController::class, 'addEmployee'])->name('payroll.add-employee');
        Route::delete('/{payroll}/remove-employee/{employee}', [PayrollController::class, 'removeEmployee'])->name('payroll.remove-employee');
        
        Route::post('/{payroll}/approve', [PayrollController::class, 'approve'])->name('payroll.approve');
        Route::post('/{payroll}/export-pdf', [PayrollController::class, 'exportPDF'])->name('payroll.export-pdf');
    });

    Route::get('/register', fn() => view('auth.register'))->name('register');
});

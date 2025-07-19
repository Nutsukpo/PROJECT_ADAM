php?
Route::middleware(['auth'])->group(function () {
    
    // logout
    Route::post('/logout', [Authcontoller::class, 'logout']);

    // dashboard
    Route::get('/dashboard', [dashboardcontroller::class, 'index'])->name('dashboard');

    /**
     * USERS ROUTES (Protected by `viewUser` permission)
     */
    Route::prefix('users')->middleware('permission:viewUser')->group(function () {
        Route::get('/', [usercontroller::class, 'index']);
        Route::get('/create', [usercontroller::class, 'create']);
        Route::post('/create', [usercontroller::class, 'store'])->name('user.create');
        Route::get('/roles', [usercontroller::class, 'userRoles']);
        Route::get('/role/create', [usercontroller::class, 'createRole']);
        Route::post('/role/create', [usercontroller::class, 'storeRole'])->name('role.create');
        Route::get('/role/{id}/watch', [usercontroller::class, 'watchRole']);
        Route::get('/role/{id}/edit', [usercontroller::class, 'editRole']);
        Route::post('/role/{id}/update', [usercontroller::class, 'updateRole']);
        Route::post('/role/{id}/delete', [usercontroller::class, 'deleteRole']);

        Route::get('/{id}/edit', [usercontroller::class, 'edit']);
        Route::get('/{id}/watch', [usercontroller::class, 'watch']);
        Route::post('/{id}/update', [usercontroller::class, 'update']);
        Route::post('/{id}/delete', [usercontroller::class, 'delete']);
    });

    /**
     * EMPLOYEE ROUTES
     */
    Route::prefix('employees')->middleware('permission:viewEmployee')->group(function () {
        Route::get('/', [employeecontroller::class, 'index']);
        Route::get('/create', [employeecontroller::class, 'create'])->middleware('permission:createEmployee');
        Route::post('/create', [employeecontroller::class, 'store'])->name('employee.create');
        Route::get('/{id}/edit', [employeecontroller::class, 'edit'])->name('employees.edit');
        Route::get('/{id}/watch', [employeecontroller::class, 'watch']);
        Route::post('/{id}/update', [employeecontroller::class, 'update']);
        Route::post('/{id}/delete', [employeecontroller::class, 'destroy']);
    });

    /**
     * ASSETS ROUTES
     */
    Route::prefix('assets')->middleware('permission:viewAsset')->group(function () {
        Route::get('/', [assetcontroller::class, 'index']);
        Route::get('/create', [assetcontroller::class, 'create']);
        Route::post('/create', [assetcontroller::class, 'store'])->name('asset.create');
        Route::get('/{id}/edit', [assetcontroller::class, 'edit'])->name('asset.edit');
        Route::get('/{id}/watch', [assetcontroller::class, 'watch']);
        Route::post('/{id}/update', [assetcontroller::class, 'update']);
        Route::post('/{id}/delete', [assetcontroller::class, 'delete']);
    });

    /**
     * INCOMING LETTERS ROUTES
     */
    Route::prefix('incomingletters')->middleware('permission:viewIncoming')->group(function () {
        Route::get('/', [incomingletterscontroller::class, 'index']);
        Route::get('/create', [incomingletterscontroller::class, 'create']);
        Route::post('/create', [incomingletterscontroller::class, 'store'])->name('incomingletters.create');
        Route::get('/{id}/edit', [incomingletterscontroller::class, 'edit']);
        Route::get('/{id}/watch', [incomingletterscontroller::class, 'watch']);
        Route::post('/{id}/update', [incomingletterscontroller::class, 'update']);
        Route::post('/{id}/delete', [incomingletterscontroller::class, 'delete']);
    });

    /**
     * OUTGOING LETTERS ROUTES
     */
    Route::prefix('outgoingletters')->middleware('permission:viewOutgoing')->group(function () {
        Route::get('/', [outgoingletterscontroller::class, 'index']);
        Route::get('/create', [outgoingletterscontroller::class, 'create'])->name('outgoingletters.create');
        Route::post('/create', [outgoingletterscontroller::class, 'store'])->name('outgoingletters.create');
        Route::get('/{id}/edit', [outgoingletterscontroller::class, 'edit']);
        Route::get('/{id}/watch', [outgoingletterscontroller::class, 'watch']);
        Route::post('/{id}/update', [outgoingletterscontroller::class, 'update']);
        Route::post('/{id}/delete', [outgoingletterscontroller::class, 'delete']);
    });

    /**
     * ATTENDANCE ROUTES
     */
    Route::prefix('attendance')->middleware('permission:manageAttendance')->group(function () {
        Route::get('/', [AttendanceController::class, 'index']);
        Route::get('/create', [AttendanceController::class, 'create'])->name('attendance.create');
        Route::post('/create', [AttendanceController::class, 'store'])->name('attendance.create');
    });

    /**
     * PAYMENTS ROUTES
     */
    Route::prefix('payments')->middleware('permission:viewPayment')->group(function () {
        Route::get('/', [paymentcontroller::class, 'index']);
        Route::get('/create', [paymentcontroller::class, 'create']);
        Route::post('/create', [paymentcontroller::class, 'store'])->name('payments.create');
        Route::get('/{id}/edit', [paymentcontroller::class, 'edit']);
        Route::get('/{id}/watch', [paymentcontroller::class, 'watch']);
        Route::post('/{id}/update', [paymentcontroller::class, 'update']);
        Route::post('/{id}/delete', [paymentcontroller::class, 'delete']);
    });

    /**
     * VISITORS ROUTES
     */
    Route::prefix('visitors')->middleware('permission:viewVisitor')->group(function () {
        Route::get('/', [visitorscontroller::class, 'index']);
        Route::get('/create', [visitorscontroller::class, 'create']);
        Route::post('/create', [visitorscontroller::class, 'store'])->name('visitors.create');
        Route::get('/{id}/edit', [visitorscontroller::class, 'edit'])->name('visitors.edit');
        Route::get('/{id}/watch', [visitorscontroller::class, 'watch']);
        Route::post('/{id}/update', [visitorscontroller::class, 'update'])->name('visitors.update');
        Route::post('/{id}/delete', [visitorscontroller::class, 'delete'])->name('visitors.delete');
    });
});

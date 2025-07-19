<?php

namespace App\Http\Controllers;

use App\Models\employees;
use App\Models\incomingletters;
use App\Models\outgoingletters;
use App\Models\assets;
use App\Models\payments;
use App\Models\attendance;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class dashboardController extends Controller
{
    public function index()
    {
        $employeesCount = employees::count();
        $incominglettersCount = incomingletters::count();
        $outgoinglettersCount = outgoingletters::count();
        $paymentsCount = payments::count();
        $attendanceCount = attendance::count();
        $assetCount = assets::count();
        return view('dashboard.index', compact('employeesCount', 'incominglettersCount', 'assetCount', 'outgoinglettersCount','paymentsCount','attendanceCount'));
    }

  
}

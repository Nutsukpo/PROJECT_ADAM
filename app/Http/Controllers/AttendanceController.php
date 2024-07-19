<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{

    public function create(){
        return view('attendance.create');
    }
    public function clockIn()
    {
        $user = Auth::user();
        $attendance = Attendance::create([
            'user_id' => $user->id,
            'clock_in' => now(),
        ]);

        return redirect()->back()->with('success', 'Clocked in successfully.');
    }

    public function clockOut()
    {
        $user = Auth::user();
        $attendance = Attendance::where('user_id', $user->id)
            ->whereNull('clock_out')
            ->first();

        if ($attendance) {
            $attendance->update([
                'clock_out' => now(),
            ]);
            return redirect()->back()->with('success', 'Clocked out successfully.');
        } else {
            return redirect()->back()->with('error', 'You need to clock in first.');
        }
    }
}

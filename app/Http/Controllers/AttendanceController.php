<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendance = Attendance::with('employee')->latest()->get();
        return view('attendance.index', compact('attendance'));
    }

    public function create()
    {
        $employees = employees::select('id', 'firstname', 'lastname')->get();
        return view('attendance.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_name' => 'required',
            'date' => 'required|date',
            'clock_in' => 'required|date_format:H:i',
            'clock_out' => 'nullable|date_format:H:i|after:clock_in',
            'status' => 'required|in:present,absent,late,half_day',
            'notes' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $employee = employees::findOrFail($request->employee_id);

        Attendance::create([
            // 'employee_id' => $request->employee_id,
            'employee_name' => $employee->firstname . ' ' . $employee->lastname,
            'date' => $request->date,
            'clock_in' => $request->clock_in,
            'clock_out' => $request->clock_out,
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        return redirect()->route('attendance.index')->with('success', 'Attendance recorded successfully');
    }

    public function edit($id)
    {
        $attendance = Attendance::findOrFail($id);
        $employees = employees::select('id', 'firstname', 'lastname')->get();
        return view('attendance.edit', compact('attendance', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $attendance = Attendance::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'employee_name' => 'required',
            'date' => 'required|date',
            'clock_in' => 'required|date_format:H:i',
            'clock_out' => 'nullable|date_format:H:i|after:clock_in',
            'status' => 'required|in:present,absent,late,half_day',
            'notes' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $employee = employees::findOrFail($request->employee_id);

        $attendance->update([
            // 'employee_id' => $request->employee_id,
            'employee_name' => $employee->firstname . ' ' . $employee->lastname,
            'date' => $request->date,
            'clock_in' => $request->clock_in,
            'clock_out' => $request->clock_out,
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        return redirect()->route('attendance.index')->with('success', 'Attendance updated successfully');
    }

    public function show($id)
    {
        $attendance = Attendance::with('employee')->findOrFail($id);
        return view('attendance.show', compact('attendance'));
    }

    public function destroy($id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();
        
        return redirect()->route('attendance.index')->with('success', 'Attendance deleted successfully');
    }

    public function clockOut(Request $request, $id)
    {
        $attendance = Attendance::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'clock_out' => 'required|date_format:H:i|after:clock_in',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $attendance->update([
            'clock_out' => $request->clock_out,
        ]);

        return redirect()->back()->with('success', 'Clock out recorded successfully');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\Employee;
use App\Models\employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PayrollController extends Controller
{
    public function index()
    {
        $payrolls = Payroll::latest()->get();
        return view('payroll.index', compact('payrolls'));
    }

    public function create()
    {
        // Use firstname and lastname instead of name
        $employees = employees::select('id', 'firstname', 'lastname', 'position')->get();
        return view('payroll.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'period_start' => 'required|date',
            'period_end' => 'required|date|after:period_start',
            'status' => 'required|in:draft,approved,paid',
            'notes' => 'nullable|string',
            'employees' => 'required|array',
            'employees.*' => 'exists:employees,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $payroll = Payroll::create($request->only(['title', 'period_start', 'period_end', 'status', 'notes']));
        
        // Attach employees to payroll
        if ($request->has('employees')) {
            $payroll->employees()->attach($request->employees);
        }

        return redirect()->route('payroll.index')->with('success', 'Payroll created successfully');
    }

    public function show($id)
    {
        $payroll = Payroll::with('employees')->findOrFail($id);
        return view('payroll.show', compact('payroll'));
    }

    public function edit($id)
    {
        $payroll = Payroll::with('employees')->findOrFail($id);
        $employees = employees::select('id', 'firstname', 'lastname', 'position')->get();
        return view('payroll.edit', compact('payroll', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $payroll = Payroll::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'period_start' => 'required|date',
            'period_end' => 'required|date|after:period_start',
            'status' => 'required|in:draft,approved,paid',
            'notes' => 'nullable|string',
            'employees' => 'required|array',
            'employees.*' => 'exists:employees,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $payroll->update($request->only(['title', 'period_start', 'period_end', 'status', 'notes']));
        
        // Sync employees for payroll
        if ($request->has('employees')) {
            $payroll->employees()->sync($request->employees);
        }

        return redirect()->route('payroll.index')->with('success', 'Payroll updated successfully');
    }

    public function destroy($id)
    {
        $payroll = Payroll::findOrFail($id);
        $payroll->delete();
        
        return redirect()->route('payroll.index')->with('success', 'Payroll deleted successfully');
    }
}
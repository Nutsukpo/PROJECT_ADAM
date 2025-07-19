<?php

namespace App\Http\Controllers;

use App\Models\employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class employeecontroller extends Controller
{
    public function show(employees $employee)
    {
        $this->authorize('view', $employee);
        return view('employees.show', ['employee' => $employee]);
    }

    // Display a list of employees
    public function index()
    {
        $employees = employees::all();
        return view('employees.index', ['employees' => $employees]);
    }

    // Show the form to create a new employee
    public function create()
    {
        return view('employees.create');
    }

    // Store a new employee in the database
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'firstname' => 'required|min:2',
            'lastname' => 'required|min:2',
            'email' => 'required|email|unique:employees,email',
            'department' => 'required',
            'contact' => 'required|min:10|max:13|unique:employees,contact',
            'address' => 'required',
            'position' => 'required',
            'picture' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('picture')) {
            $imagePath = $request->file('picture')->store('uploads/employees', 'public');
        }

        // Generate a unique employee ID
        do {
            $employee_id = 'SBZCOS' . rand(100000, 999999);
        } while (employees::where('employee_id', $employee_id)->exists());

        // Create the employee
        employees::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'employee_id' => $employee_id,
            'department' => $data['department'],
            'contact' => $data['contact'],
            'address' => $data['address'],
            'position' => $data['position'],
            'picture' => $imagePath,
        ]);

        return redirect()->intended('employees')->with('messages', 'employee added successfully');
    }

    // Show the form to edit an employee
    public function edit($id)
    {
        $employee = employees::findOrFail($id);
        return view('employees.edit', ['employee' => $employee]);
    }

    // Update an existing employee
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'firstname' => 'required|min:2',
            'lastname' => 'required|min:2',
            'email' => 'required|email',
            'employee_id' => 'required',
            'department' => 'required',
            'contact' => 'required|min:10|max:13',
            'address' => 'required',
            'position' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $employee = employees::findOrFail($id);
        $employee->firstname = $data['firstname'];
        $employee->lastname = $data['lastname'];
        $employee->email = $data['email'];
        $employee->employee_id = $data['employee_id'];
        $employee->department = $data['department'];
        $employee->contact = $data['contact'];
        $employee->address = $data['address'];
        $employee->position = $data['position'];
        $employee->save();

        return redirect()->intended('employees')->with('messages','employees updated successfully');
    }

    // Delete an employee
    public function delete($id){
        employees::find($id)->delete();
        return redirect()->intended('employees')->with('messages','employee deleted successfully');
    }
    



    // View a single employee's details
    public function watch($id)
    {
        $employee = employees::findOrFail($id);
        return view('employees.watch', ['employee' => $employee]);
    }
}

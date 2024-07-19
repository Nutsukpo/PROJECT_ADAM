<?php

namespace App\Http\Controllers;

use App\Models\employees;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class employeecontroller extends Controller
{   
    public function show(employees $post)
    {
        $this->authorize('view', $post);

        return view('posts.show', ['post' => $post]);
    }
    
    //func to return employees list view
    public function index(){
        // fetch all employees fromm the db
        $employees= employees::all();
        // return the view data
        return view('employees.index',['employees'=>$employees]);
    }
    //func to return the form to add a new employee to the list
    public function create(){
        return view('employees.create');
    }
    // func to store data in the database
    public function store(Request $request){
        $data = $request->all();

        $Validator = Validator::make($data,[
            'firstname' =>'required |min:2',
            'lastname' =>'required |min:2',
            'email' =>'required |email |unique:employees,email',
            'employee_id' =>'required ',
            'department'=>'required ',
            'contact' =>'required | min:10 | max:13 |unique:employees,contact',
            'address' =>'required',
            'position' =>'required',

        ]);
        if ($Validator->fails()) {
            return redirect()->back()->withErrors($Validator)->withInput();
        }
        employees::create([
            'firstname' => $data['firstname'],
            'lastname'=>$data['lastname'],
            'email' =>$data['email'],
            'employee_id' =>$data['employee_id'],
            'department'=>$data['department'],
            'contact' =>$data['contact'],
            'address' =>$data['address'],
            'position' =>$data['position'],


        ]);
        return redirect()->intended('employees')->with('messages','employee added successfully');
    }
    // fun to return the form for editing
    public function edit($id){
        //find students records with the id provided
        $employee= employees::find($id);
        // return the edit.blade.php which is in the employee folder and pass the data to it
        return view('employees.edit',['employee'=>$employee]);
    }
    // function to update column in the database
    public function update(Request $resquest, $id){
        
        //save the datarequest to a variable called data 
        $data= $resquest->all();
        $Validator = Validator::make($data,[
            'firstname' =>'required |min:2',
            'lastname' =>'required |min:2',
            'email' =>'required |email',
            'employee_id' =>'required ',
            'department'=>'required ',
            'contact' =>'required | min:10 | max:13 ',
            'address' =>'required',
            'position' =>'required',

        ]);
        //if validation fails return back with errors
        if ($Validator->fails()) {
           return redirect()->back()->withErrors($Validator)->withInput();
        }

        //find the student with the id coming first
        $employee = employees::find($id);
        // check if the employees is already in the list then update else return error 
        if ($employee) {
            $employee->firstname = $data['firstname'];
            $employee->lastname = $data['lastname'];
            $employee->email = $data['email'];
            $employee->employee_id = $data['employee_id'];
            $employee->department = $data['department'];
            $employee->contact = $data['contact'];
            $employee->address= $data['address'];
            $employee->position= $data['position'];

            // save the new changes
            $employee->save();

            return redirect()->intended('employees')->with('messages','employee updated successfully');
        }
        return redirect()->back();
    }

    // function to delete an employee
    public function delete($id){
        employees::find($id)->delete();
        return redirect()->intended('employees')->with('messages','employee deleted successfully');
    }
    public function watch($id){
        //find user records with the id provided
        $employee= employees::find($id);
        // return the edit.blade.php which is in the employee folder and pass the data to it
        return view('employees.watch',['employee'=>$employee]);
    }
    public function showEmployeeDropdown()
    {
        $employee = employees::all();
        return view('employees.dropdown', compact('employees'));
    }

}

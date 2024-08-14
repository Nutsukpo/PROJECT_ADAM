<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\employees;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class AttendanceController extends Controller
{   
    public function show(attendance $post)
    {
        $this->authorize('view', $post);

        return view('posts.show', ['post' => $post]);
    }

    //func to return attendance list view
    public function index(){
        // fetch all attendance fromm the db
        $attendance= attendance::all();
        // dd($attendance);
        // return the view data
        return view('attendance.index',['attendance'=>$attendance]);
    }
    //func to return the form to add a new attendance to the list
    public function create(){
        $employees = employees::select('firstname','lastname','employee_id')->get();
        // dd($employees);
        return view('attendance.create',['employees'=>$employees]);
    }

    // func to store data in the database
    public function store(Request $request){
        $data = $request->all();
        // dd($data);
        $Validator = Validator::make($data,[
            'name_of_employee' =>'required ',
            'clock_in' =>'required ',
            'attendance_date'=>'required ',
            'time' =>'required ',   
        ]);
        if ($Validator->fails()) {
            return redirect()->back()->withErrors($Validator)->withInput();
        }
        attendance::create([
            'name_of_employee' =>$data['name_of_employee'],
            'clock_in' =>$data['clock_in'],
            'attendance_date'=>$data['attendance_date'],
            'time' =>$data['time'],
        ]);
        return redirect()->intended('attendance')->with('messages','attendance added successfully');
    }
    // fun to return the form for editing
    public function edit($id){
        //find students records with the id provided
        $attendance= attendance::find($id);
        // return the edit.blade.php which is in the attendance folder and pass the data to it
        return view('attendance.edit',['attendance'=>$attendance]);
    }
    // function to update column in the database
    public function update(Request $resquest, $id){
        
        //save the datarequest to a variable called data 
        $data= $resquest->all();
        $Validator = Validator::make($data,[
            'attendance_date' =>'required ',
            'name_of_employee' =>'required ',
            'clock_in' =>'required ',
            'time'=>'required ',
            
            
        ]);
        //if validation fails return back with errors
        if ($Validator->fails()) {
           return redirect()->back()->withErrors($Validator)->withInput();
        }

        //find the attendance with the id coming first
        $attendance = attendance::find($id);
        // check if the attendance is already in the list then update else return error 
        if ($attendance) {
            $attendance->attendance_date = $data['attendance_date'];
            $attendance->name_of_employee = $data['name_of_employee'];
            $attendance->clock_in = $data['clock_in'];
            $attendance->time = $data['time'];

            // save the new changes
            $attendance->save();

            return redirect()->intended('attendance')->with('messages','attendance updated successfully');
        }
        return redirect()->back();
    }

    // function to delete an attendance
    public function delete($id){
        attendance::find($id)->delete();
        return redirect()->intended('attendance')->with('messages','attendance deleted successfully');
    }
    public function watch($id){
        //find attendance records with the id provided
        $attendance= attendance::find($id);
        // return the edit.blade.php which is in the sttendance folder and pass the data to it
        return view('attendance.watch',['attendance'=>$attendance]);
    }
    public function showattendanceDropdown()
    {
        $attendance = attendance::all();
        return view('attendance.dropdown', compact('attendance'));
    }
}


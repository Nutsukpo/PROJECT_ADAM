<?php

namespace App\Http\Controllers;

use App\Models\visitors;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;




class visitorscontroller extends Controller
{   
    public function show(visitors $post)
    {
        $this->authorize('view', $post);

        return view('posts.show', ['post' => $post]);
    }
    
    //fun to return visitors list view
    public function index(){
        // fetch all visitors fromm the db
        $visitors= visitors::all();
        // return the view data
        return view('visitors.index',['visitors'=>$visitors]);
    }
    //fun to return the visitors form to add a new visitor
    public function create(){
        return view('visitors.create');
    }
    // fun to store data in the database
    public function store(Request $request){
        $data = $request->all();

        $Validator = Validator::make($data,[
            'visitor_name' =>'required |min:2',
            'contact' =>'required ',
            'department' =>'required',
            'gender' =>'required',
            'vulnerability'=>'required ',
            'purpose_of_visit' =>'required',
            'time_in' =>'required',
            'time_out' =>'nullable',
            'visiting_date' =>'nullable'
        ]);
        
        if ($Validator->fails()) {
            return redirect()->back()->withErrors($Validator)->withInput();
        }
        $visitor = visitors::create([
            'visitor_name' => $data['visitor_name'],
            'contact' => $data['contact'],
            'department' => $data['department'],
            'gender' => $data['gender'],
            'vulnerability' => $data['vulnerability'],
            'purpose_of_visit' => $data['purpose_of_visit'],
            'time_in' => $data['time_in'],
            'time_out' => $data['time_out'],
            'visiting_date' => $data['visiting_date']
        ]);
       
        return redirect()->intended('visitors')->with('messages','visitor added successfully');
    }
    // fun to return the form for editing
    public function edit($id){
        //find visitors records with the id provided
        $visitor= visitors::find($id);
        // return the edit.blade.php which is in the visitor folder and pass the data to it
        return view('visitors.edit',['visitor'=>$visitor]);
    }
    // function to update column in the database
    public function update(Request $request, $id)
    
{
    $data = $request->all();
    Log::info('Visitor update triggered', $request->all());


    $Validator = Validator::make($data, [
        'visitor_name' => 'required',
        'contact' => 'required',
        'department' => 'required',
        'gender' => 'required',
        'vulnerability' => 'required',
        'purpose_of_visit' => 'required',
        'time_in' => 'required',
        'time_out' => 'nullable',
        'visiting_date' => 'required'
    ]);

    if ($Validator->fails()) {
        return redirect()->back()->withErrors($Validator)->withInput();
    }

    $visitor = visitors::find($id);

    if ($visitor) {
        $visitor->visitor_name = $data['visitor_name'];
        $visitor->contact = $data['contact'];
        $visitor->department = $data['department'];
        $visitor->gender = $data['gender'];
        $visitor->vulnerability = $data['vulnerability'];
        $visitor->purpose_of_visit = $data['purpose_of_visit'];
        $visitor->time_in = $data['time_in'];
        $visitor->time_out = $data['time_out'];
        $visitor->visiting_date = $data['visiting_date'];

        $visitor->save();

        return redirect()->intended('visitors')->with('messages', 'Visitor updated successfully');
        
    }

    return redirect()->back()->with('error', 'Visitor not found');


        //if validation fails return back with errors
        if ($Validator->fails()) {
           return redirect()->back()->withErrors($Validator)->withInput();
        }
        //find the visitor with the id coming first
        $visitor = visitors::find($id);

        // check if the visitor is already in the list then update else return error 
        if ($visitor) {
            $visitor->visitor_name = $data['visitor_name'];
            $visitor->contact = $data['contact'];
            $visitor->department = $data['department'];
            $visitor->gender = $data['gender'];
            $visitor->vulnerability = $data['vulnerability'];
            $visitor->purpose_of_visit = $data['purpose_of_visit'];
            $visitor->time_in = $data['time_in'];
            $visitor->time_out = $data['time_out'];
            $visitor->visiting_date = $data['visiting_date'];
            

            // save the new changes
            $visitor->save();
            return redirect()->intended('visitor')->with('messages','visitor updated successfully');
        }
        return redirect()->back();
    }

    // function to delete a visitor
    public function delete($id){
        Log::info('Attempting to delete visitor ID: ' . $id);
        visitors::find($id)->delete();
        return redirect()->intended('visitors')->with('messages','visitor deleted successfully');

        
    }
    public function watch($id){
        //find user records with the id provided
        $visitor= visitors::find($id);
        // return the edit.blade.php which is in the students folder and pass the data to it
        return view('visitors.watch',['visitor'=>$visitor]);
    }

}


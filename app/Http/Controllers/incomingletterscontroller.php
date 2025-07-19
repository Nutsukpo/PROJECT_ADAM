<?php

namespace App\Http\Controllers;

use App\Models\employees;
use App\Models\incomingletters;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Support\Facades\Log;

class incomingletterscontroller extends Controller
{   
    public function show(incomingletters $post)
    {
        $this->authorize('view', $post);

        return view('posts.show', ['post' => $post]);
    }
    
    //func to return incomingletters list view
    public function index(){
        // fetch all incomingletters fromm the db
        $incomingletter= incomingletters::all();
        // return the view data
        return view('incomingletters.index',['incomingletters'=>$incomingletter]);
    }
    //func to return the form to add a new incomingletters to the list
    public function create(){
        return view('incomingletters.create');
    }
    // func to store data in the database
    public function store(Request $request){
        $data = $request->all();
   
        $Validator = Validator::make($data,[
            // 'letter_id' =>'required',
            'reference_no' =>'required ',
            'organization_name' =>'required',
            'description' =>'required ',
            'receiving_date'=>'required ',
            'to_whom_received'=>'required ',
            'date_of_letter'=>'required ',
            'sender'=>'required ',
            'mode_of_letter'=>'required ',
            'name_of_person_receiving'=>'required ',
            'file_path' => 'nullable|mimes:pdf|max:10240',
        ]);
        $filePath = null;
        // Save the PDF file to storage
        $filePath = $request->file('file_path')->store('uploads/incomingletters', 'public');
        if ($Validator->fails()) {
            return redirect()->back()->withErrors($Validator)->withInput();
        }
        incomingletters::create([
            // 'letter_id' => $data['letter_id'],
            'reference_no'=>$data['reference_no'],
            'organization_name' =>$data['organization_name'],
            'description'=>$data['description'],
            'receiving_date'=>$data['receiving_date'],
            'to_whom_received'=>$data['to_whom_received'],
            'date_of_letter'=>$data['date_of_letter'],
            'sender'=>$data['sender'],
            'mode_of_letter'=>$data['mode_of_letter'],
            'name_of_person_receiving'=>$data['name_of_person_receiving'],
            'file_path' => $filePath,

            

        ]);
        return redirect()->intended('incomingletters')->with('messages','letter added successfully');
    }
    // fun to return the form for editing
    public function edit($id){
        //find incomingletters records with the id provided
        $incomingletters= incomingletters::find($id);
        // return the edit.blade.php which is in the incomingletters folder and pass the data to it
        return view('incomingletters.edit',['incomingletters'=>$incomingletters]);
    }
    // function to update column in the database
    public function update(Request $resquest, $id){
        
        //save the datarequest to a variable called data 
        $data= $resquest->all();
        $Validator = Validator::make($data,[
            // 'letter_id' =>'required |min:2'|'Unique',
            'reference_no' =>'required |min:2',
            'organization_name' =>'required',
            'description' =>'required ',
            'receiving_date'=>'required',
            'to_whom_received'=>'required ',
            'date_of_letter'=>'required ',
            'sender'=>'required ',
            'mode_of_letter'=>'required ',
            'name_of_person_receiving'=>'required ',

            
        ]);
        //if validation fails return back with errors
        // if ($Validator->fails()) {
        //    return redirect()->back()->withErrors($Validator)->withInput();
        // }
        //find the student with the id coming first
        $incomingletters = incomingletters::find($id);

        // check if the incomingletters is already in the list then update else return error 
        if ($incomingletters) {
            $incomingletters->letter_id = $data['letter_id'];
            $incomingletters->reference_no = $data[ 'reference_no'];
            $incomingletters->organization_name = $data['organization_name'];
            $incomingletters->description = $data['description'];
            $incomingletters->receiving_date = $data['receiving_date'];
            $incomingletters->to_whom_received = $data['to_whom_received'];
            $incomingletters->date_of_letter = $data['date_of_letter'];
            $incomingletters->sender = $data['sender'];
            $incomingletters->mode_of_letter = $data['mode_of_letter'];
            $incomingletters->name_of_person_receiving =$data ['name_of_person_receiving'];


            

            // save the new changes
            $incomingletters->save();

            return redirect()->intended('incomingletters')->with('messages','letter updated successfully');
        }
        return redirect()->back();
    }

    // function to delete a incomingletters
    public function delete($id){
        incomingletters::find($id)->delete();
        return redirect()->intended('incomingletters')->with('messages','letter deleted successfully');
    }
    public function watch($id){
        //find user records with the id provided
        $incomingletters=incomingletters::find($id);
        // return the edit.blade.php which is in the students folder and pass the data to it
        return view('incomingletters.watch',['incomingletters'=>$incomingletters]);
    }

}






<?php

namespace App\Http\Controllers;

use App\Models\outgoingletters;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;


class outgoingletterscontroller extends Controller
{   
    public function show(outgoingletters $post)
    {
        $this->authorize('view', $post);

        return view('posts.show', ['post' => $post]);
    }
    
    //func to return outgoingletters list view
    public function index(){
        // fetch all outgoingletters fromm the db
        $outgoingletters= outgoingletters::all();
        // return the view data
        return view('outgoingletters.index',['outgoingletters'=>$outgoingletters]);
    }
    //func to return the form to add a new outgoingletters to the list
    public function create(){
        return view('outgoingletters.create');
    }
    // func to store data in the database
    public function store(Request $request){
        $data = $request->all();

        $Validator = Validator::make($data,[
            // 'letter_id' =>'required |min:2',
            'reference_no' =>'required |min:2',
            'organization_name' =>'required',
            'description' =>'required ',
            'sending_date'=>'required ',
            'file_path' => 'nullable|mimes:pdf,docx,xlsx,csv,zip|max:10240',

        ]);
        $filePath = null;
        // Save the PDF file to storage
        $filePath = $request->file('file_path')->store('uploads/outgoingletters', 'public');
        if ($Validator->fails()) {
            return redirect()->back()->withErrors($Validator)->withInput();
        }
        outgoingletters::create([
            // 'letter_id' => $data['letter_id'],
            'reference_no'=>$data['reference_no'],
            'organization_name' =>$data['organization_name'],
            'description'=>$data['description'],
            'sending_date'=>$data['sending_date'],
            'file_path' => $filePath,
            
            

        ]);
        return redirect()->intended('outgoingletters')->with('messages','letter added successfully');
    }
    // fun to return the form for editing
    public function edit($id){
        //find outgoingletters records with the id provided
        $outgoingletters= outgoingletters::find($id);
        // return the edit.blade.php which is in the incomingletters folder and pass the data to it
        return view('outgoingletters.edit',['outgoingletters'=>$outgoingletters]);
    }
    // function to update column in the database
    public function update(Request $resquest, $id){
        
        //save the datarequest to a variable called data 
        $data= $resquest->all();
        $Validator = Validator::make($data,[
            'letter_id' =>'required ',
            'reference_no' =>'required ',
            'organization_name' =>'required',
            'description' =>'required ',
            'sending_date'=>'required ',
            
        ]);
        //if validation fails return back with errors
        if ($Validator->fails()) {
           return redirect()->back()->withErrors($Validator)->withInput();
        }
        //find the outgoingletters with the id coming first
        $outgoingletters = outgoingletters::find($id);

        // check if the outgoingletters is already in the list then update else return error 
        if ($outgoingletters) {
            $outgoingletters->letter_id = $data['letter_id'];
            $outgoingletters->reference_no = $data[ 'reference_no'];
            $outgoingletters->organization_name = $data['organization_name'];
            $outgoingletters->description = $data['description'];
            $outgoingletters->sending_date = $data['sending_date'];
            

            // save the new changes
            $outgoingletters->save();

            return redirect()->intended('outgoingletters')->with('messages','letter updated successfully');
        }
        return redirect()->back();
    }

    // function to delete a incomingletters
    public function delete($id){
        outgoingletters::find($id)->delete();
        return redirect()->intended('outgoingletters')->with('messages','letter deleted successfully');
    }
    public function watch($id){
        //find user records with the id provided
        $outgoingletters= outgoingletters::find($id);
        // return the edit.blade.php which is in the students folder and pass the data to it
        return view('outgoingletters.watch',['outgoingletters'=>$outgoingletters]);
    }

}







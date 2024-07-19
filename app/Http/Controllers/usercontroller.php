<?php

namespace App\Http\Controllers;

use App\Mail\UserWelcome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\user;
use Illuminate\Support\Facades\Log;

class usercontroller extends Controller
{
     //fun to return student list view
     public function index(){
        // fetch all users fromm the db
        $users= user ::all();
        // return the view data
        return view('users.index',['users'=>$users]);
    }
    //fun to return the form to add a new student
    public function create(){
        return view('users.create');
    }
    // fun to store data in the database
    public function store(Request $request){
        $data = $request->all();

        $Validator = Validator::make($data,[
            'name' =>'required |min:2',
            'title' =>'required |min:2',
            'email' =>'required |email |unique:users,email',
            'contact' =>'required | min:10 | max:13 |unique:users,contact',
            'password' => 'required | confirmed',
            
        ]);
        if ($Validator->fails()) {
            return redirect()->back()->withErrors($Validator)->withInput();
        }

        Log::info(config()->get('mail'));

        user::create([
            'name' => $data['name'],
            'title'=>$data['title'],
            'email' =>$data['email'],
            'contact' =>$data['contact'],
            'password' =>$data['password'],

        ]);


        Mail::to($data['email'])->send(new UserWelcome($data['name'],$data['password']));

        return redirect()->intended('users')->with('messages','user added successfully'); 
    }
    // fun to return the form for editing
    public function edit($id){
        //find user records with the id provided
        $user= user::find($id);
        // return the edit.blade.php which is in the students folder and pass the data to it
        return view('users.edit',['user'=>$user]);
    }

    public function watch($id){
        //find user records with the id provided
        $user= user::find($id);
        // return the edit.blade.php which is in the students folder and pass the data to it
        return view('users.watch',['user'=>$user]);
    }



    // function to update column in the database
    public function update(Request $resquest, $id){
        
        //save the datarequest to a variable called data 
        $data= $resquest->all();
        $Validator = Validator::make($data,[
            'name' =>'required |min:2',
            'title' =>'required |min:2',
            'email' =>'required |email',
            'contact' =>'required | min:10 | max:13 ',
            
        ]);


        //if validation fails return back with errors
        if ($Validator->fails()) {
           return redirect()->back()->withErrors($Validator)->withInput();
        }
        //find the student with the id coming first
        $user= user::find($id);

        // check if the user is already in the list then update else return error 
        if ($user) {
            $user->name = $data['name'];
            $user->title = $data['title'];
            $user->email = $data['email'];         
            $user->contact = $data['contact'];

            // save the new changes
            $user->save();
            return redirect()->intended('users')->with('messages','user updated successfully');
        }
        return redirect()->back();
    }

    // function to delete a user
    public function delete($id){
        user::find($id)->delete();
        return redirect()->intended('users')->with('messages','user deleted successfully');
    }
}

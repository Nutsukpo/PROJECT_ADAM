<?php

namespace App\Http\Controllers;

use App\Models\assets;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;



class assetcontroller extends Controller
{   
    public function show(assets $post)
    {
        $this->authorize('view', $post);

        return view('posts.show', ['post' => $post]);
    }
    
    //fun to return assets list view
    public function index(){
        // fetch all assets fromm the db
        $assets= assets::all();
        // return the view data
        return view('assets.index',['assets'=>$assets]);
    }
    //fun to return the assets form to add a new asset
    public function create(){
        return view('assets.create');
    }
    // fun to store data in the database
    public function store(Request $request){
        $data = $request->all();

        $Validator = Validator::make($data,[
            'asset_name' =>'required |min:2',
            // 'asset_id' =>'sometimes',
            'asset_type'=>'required',
            'asset_cost' =>'required',
            'serial_number' =>'required',
            'department_for' =>'required',

        
        
        ]);
        
        if ($Validator->fails()) {
            return redirect()->back()->withErrors($Validator)->withInput();
        }
        $asset = assets::create([
            'asset_name' => $data['asset_name'],
            // 'asset_id'=>$data['asset_id'],
            'asset_type'=>$data['asset_type'],
            'asset_cost' =>$data['asset_cost'],
            'serial_number'=>$data['serial_number'],
            'department_for' =>$data['department_for'],
           

        ]);
       
        return redirect()->intended('assets')->with('messages','asset added successfully');
    }
    // fun to return the form for editing
    public function edit($id){
        //find assets records with the id provided
        $asset= assets::find($id);
        // return the edit.blade.php which is in the students folder and pass the data to it
        return view('assets.edit',['asset'=>$asset]);
    }
    // function to update column in the database
    public function update(Request $resquest, $id){
        
        //save the datarequest to a variable called data 
        $data= $resquest->all();
        $Validator = Validator::make($data,[
            'asset_name' =>'required',
            'asset_id' =>'required',
            'asset_type' =>'required',
            'asset_cost' =>'required ',
            'serial_number'=>'required ',
            'department_for' =>'required',
            
        ]);
        //if validation fails return back with errors
        if ($Validator->fails()) {
           return redirect()->back()->withErrors($Validator)->withInput();
        }
        //find the asset with the id coming first
        $asset = assets::find($id);

        // check if the asset is already in the list then update else return error 
        if ($asset) {
            $asset->asset_name = $data['asset_name'];
            $asset->asset_id = $data['asset_id'];
            $asset->asset_type = $data['asset_type'];
            $asset->asset_cost = $data['asset_cost'];
            $asset->serial_number = $data['serial_number'];
            $asset->department_for = $data['department_for'];
            

            // save the new changes
            $asset->save();
            return redirect()->intended('assets')->with('messages','asset updated successfully');
        }
        return redirect()->back();
    }

    // function to delete a student
    public function delete($id){
        assets::find($id)->delete();
        return redirect()->intended('assets')->with('messages','asset deleted successfully');
    }
    public function watch($id){
        //find user records with the id provided
        $asset= assets::find($id);
        // return the edit.blade.php which is in the students folder and pass the data to it
        return view('assets.watch',['asset'=>$asset]);
    }

}


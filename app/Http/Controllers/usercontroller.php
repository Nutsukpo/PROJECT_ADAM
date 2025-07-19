<?php

namespace App\Http\Controllers;

use App\Mail\UserWelcome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\user;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class usercontroller extends Controller
{
     //fun to return student list view
     public function index(){
        // fetch all users fromm the db
        $users= user ::all();
        // return the view data
        return view('users.index',['users'=>$users]);
        $users = User::with('roles')->get();
        $roles = Role::all();
        return view('users.index', compact('users', 'roles'));
    }
    //fun to return the form to add a new student
    public function create(){
        $roles = Role::all();
        return view('users.create', compact('roles'));
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
            'role' => 'required |exists:roles,id'
            
        ]);
        if ($Validator->fails()) {
            return redirect()->back()->withErrors($Validator)->withInput();
        }

        Log::info(config()->get('mail'));

        $role = Role::find($data['role']);

        $user = user::create([
            'name' => $data['name'],
            'title'=>$data['title'],
            'email' =>$data['email'],
            'contact' =>$data['contact'],
            'password' =>$data['password'],

        ]);

        $user->assignRole($role->name);

        $permissions = $role->permissions->pluck('name')->toArray();
        $user->syncPermissions($permissions);



        Mail::to($data['email'])->send(new UserWelcome($data['name'],$data['password']));

        return redirect()->intended('users')->with('messages','user added successfully'); 
    }
    // fun to return the form for editing
    public function edit($id){
        //find user records with the id provided
        $user= user::find($id);
        $permissions = Permission::all();
        $roles = Role::all();
        // return the edit.blade.php which is in the students folder and pass the data to it
        return view('users.edit',['user'=>$user, 'roles'=>$roles, 'permissions'=>$permissions]);
    }

    public function watch($id){
        //find user records with the id provided
        $user= user::find($id);
        $permissions = Permission::all();
        // return the edit.blade.php which is in the students folder and pass the data to it
        return view('users.watch',['user'=>$user, 'permissions' => $permissions]);
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
            'role' => 'required |exists:roles,id',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ]);


        //if validation fails return back with errors
        if ($Validator->fails()) {
           return redirect()->back()->withErrors($Validator)->withInput();
        }
        //find the student with the id coming first
        $user= user::find($id);
        $role = Role::find($data['role']);

        // check if the user is already in the list then update else return error 
        if ($user) {
            $user->name = $data['name'];
            $user->title = $data['title'];
            $user->email = $data['email'];         
            $user->contact = $data['contact'];

            // save the new changes
            $user->save();
            $user->assignRole($role->name);
            $user->syncPermissions($data['permissions'] ?? []);

            return redirect()->intended('users')->with('messages','user updated successfully');
        }
        return redirect()->back();
    }

    // function to delete a user
    public function delete($id){
        user::find($id)->delete();
        return redirect()->intended('users')->with('messages','user deleted successfully');
    }

  

public function updateRoles(Request $request, User $user)
{
    $request->validate([
        'roles' => 'array',
    ]);

    $user->syncRoles($request->roles);
    return redirect()->route('users.index')->with('success', 'Roles updated!');
}

    public function userRoles(){
        $roles = Role::all();

        return view('users.roles', compact('roles'));
    }

    public function createRole(){
        $permissions = Permission::all();

        return view('users.createRole', compact('permissions'));
    }

    public function storeRole(Request $request){
        $data = $request->all();

        $Validator = Validator::make($data,[
            'name' =>'required |min:2 | unique:roles,name',  
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,name',          
        ]);
        if ($Validator->fails()) {
            return redirect()->back()->withErrors($Validator)->withInput();
        }

        $role = Role::create(['name' => $data['name']]);
        $role->syncPermissions($data['permissions'] ?? []);

        return redirect()->intended('users/roles')->with('messages', 'Role created successfully!');
    }

    public function watchRole($id){
        //find user records with the id provided
        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        return view('users.roleWatch',['role'=>$role, 'permissions'=>$permissions]);
    }

    public function editRole($id){
        //find user records with the id provided
        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        return view('users.editRole',['role'=>$role, 'permissions'=>$permissions]);
    }

    public function deleteRole($id){
        Role::find($id)->delete();
        return redirect()->intended('users/roles')->with('messages','Role deleted successfully');
    }

    public function updateRole(Request $request, $id){
        $role = Role::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|unique:roles,name,' . $role->id,
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        $role->update(['name' => $validated['name']]);
        $role->syncPermissions($validated['permissions'] ?? []);

        return redirect()->intended('users/roles')->with('messages', 'Role updated successfully!');
    }
}

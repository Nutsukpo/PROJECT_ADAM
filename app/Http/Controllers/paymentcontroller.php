<?php

namespace App\Http\Controllers;

use App\Models\payments;
use App\Models\employees;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;


class paymentcontroller extends Controller
{   
    public function show(payments $post)
    {
        $this->authorize('view', $post);

        return view('posts.show', ['post' => $post]);
    }



    
    //func to return payments list view
    public function index(){
        // fetch all payments fromm the db
        $payments= payments::all();
        // dd($payments);
        // return the view data
        return view('payments.index',['payments'=>$payments]);
    }
    //func to return the form to add a new payment to the list
    public function create(){
        $employees = employees::select('firstname','lastname','employee_id')->get();
        // dd($employees);
        return view('payments.create',['employees'=>$employees]);
    }
    // func to store data in the database
    public function store(Request $request){
        $data = $request->all();
        // dd($data);
        $Validator = Validator::make($data,[
            // 'voucher_id' =>'required ',
            'payment_date' =>'required',
            'name_of_employee' =>'required ',
            'month_of_payment' =>'required ',
            'payment_amount'=>'required ',
            'purpose_of_payment' =>'required ',   
        ]);
        if ($Validator->fails()) {
            return redirect()->back()->withErrors($Validator)->withInput();
        }
        payments::create([
            // 'voucher_id' => $data['voucher_id'],
            'payment_date'=>$data['payment_date'],
            'name_of_employee' =>$data['name_of_employee'],
            'month_of_payment' =>$data['month_of_payment'],
            'payment_amount'=>$data['payment_amount'],
            'purpose_of_payment' =>$data['purpose_of_payment'],
        ]);
        return redirect()->intended('payments')->with('messages','payment added successfully');
    }
    // fun to return the form for editing
    public function edit($id){
        //find students records with the id provided
        $payment= payments::find($id);
        // return the edit.blade.php which is in the payment folder and pass the data to it
        return view('payments.edit',['payment'=>$payment]);
    }
    // function to update column in the database
    public function update(Request $resquest, $id){
        
        //save the datarequest to a variable called data 
        $data= $resquest->all();
        $Validator = Validator::make($data,[
            // 'voucher_id' =>'required |min:2',
            'payment_date' =>'required ',
            'name_of_employee' =>'required ',
            'month_of_payment' =>'required ',
            'payment_amount'=>'required ',
            'purpose_of_payment' =>'required ',
            
        ]);
        //if validation fails return back with errors
        if ($Validator->fails()) {
           return redirect()->back()->withErrors($Validator)->withInput();
        }

        //find the student with the id coming first
        $payment = payments::find($id);
        // check if the payments is already in the list then update else return error 
        if ($payment) {
            $payment->voucher_id = $data['voucher_id'];
            $payment->payment_date = $data['payment_date'];
            $payment->name_of_employee = $data['name_of_employee'];
            $payment->month_of_payment = $data['month_of_payment'];
            $payment->payment_amount = $data['payment_amount'];
            $payment->purpose_of_payment = $data['purpose_of_payment'];

            // save the new changes
            $payment->save();

            return redirect()->intended('payments')->with('messages','payment updated successfully');
        }
        return redirect()->back();
    }

    // function to delete an payment
    public function delete($id){
        payments::find($id)->delete();
        return redirect()->intended('payments')->with('messages','payment deleted successfully');
    }
    public function watch($id){
        //find user records with the id provided
        $payment= payments::find($id);
        // return the edit.blade.php which is in the students folder and pass the data to it
        return view('payments.watch',['payment'=>$payment]);
    }
    public function showpaymentDropdown()
    {
        $payment = payments::all();
        return view('payments.dropdown', compact('payments'));
    }

    

    

}

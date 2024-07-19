<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authcontoller extends Controller
{
    public function login(Request $request){
        // dd($request);
        $credentials = $request->validate([
            'email'=>['required','email'],
            'password'=>['required'],

        ]);
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }
        return back()->withErrors(['errors'=>'Email or password incorrect'])->onlyInput('email');
    }
    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}

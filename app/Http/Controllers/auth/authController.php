<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class authController extends Controller
{
    public function index(){
        if(auth()->user() == null){
            return view('index');
        }

        return redirect()->route('dashboard');
    }

    public function login(Request $request){

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(!auth()->attempt($request->only('email', 'password'), $request->remember)){
            return back()->with('status', 'Invalid Login Details');
        }

        return redirect()->route('dashboard');
    }

    public function logout(){
        auth()->logout();

        return redirect()->route('index');
    }
}

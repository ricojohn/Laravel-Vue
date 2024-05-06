<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    public function dashboard(){
        if(auth()->user() == null){
            return view('index');
        }   
        return view('dashboard');
    }

}

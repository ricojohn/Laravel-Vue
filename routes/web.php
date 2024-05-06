<?php

use App\Http\Controllers\auth\authController;
use App\Http\Controllers\dashboard\dashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/',[authController::class, 'index'])->name('index');
Route::get('/logout',[authController::class, 'logout'])->name('logout');
Route::post('/login',[authController::class, 'login'])->name('login');


Route::get('/dashboard',[dashboardController::class, 'dashboard'])->name('dashboard');

Route::get('/products/create',[dashboardController::class, 'dashboard'])->name('create');


Route::get('/products/{search}', function($query){
    $list_product = DB::table('products')
        ->where('name', 'like', '%'.$query.'%')
        ->orWhere('description', 'like', '%'.$query.'%')
        ->get();
        return response($list_product);
});
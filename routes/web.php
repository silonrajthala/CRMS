<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('logout', [LoginController::class, 'logout']);
Route::resource('login',LoginController::class);

Route::group(['middleware' => 'admin'], function(){
    Route::resource('dashboard', DashboardController::class);
});


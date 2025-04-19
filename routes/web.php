<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsertypeController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});


    Route::get('logout', [LoginController::class, 'logout']);
    Route::resource('login',LoginController::class);


    Route::group(['middleware' => 'admin'], function(){
    
        Route::resource('dashboard', DashboardController::class);

        Route::resource('usertype', UsertypeController::class);

        Route::resource('user', UserController::class);

});



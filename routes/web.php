<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'getMenu'], function(){
    Route::get('/', function () {
        return view('welcome');
    });
    
    Route::view('/home', 'pages/home');
    Route::view('/animals/cats', 'pages/home')->middleware('isAdmin');
    
    Auth::routes();
});


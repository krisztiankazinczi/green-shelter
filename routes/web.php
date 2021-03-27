<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;

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
    Route::view('/home', 'pages/home');
    Route::get('/animals/{page}', [AnimalController::class, 'index']);
    Route::get('/animals/{page}/{id}', [AnimalController::class, 'show']);
    Route::view('/create', 'pages/create-animal');

    Auth::routes();
});


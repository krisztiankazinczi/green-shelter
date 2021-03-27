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
    Route::get('/', function () {
        return view('welcome');
    });
    
    Route::view('/home', 'pages/home');
    Route::get('/animals/dogs', [AnimalController::class, 'getAnimals']);
    Route::get('/animals/lost-dogs', [AnimalController::class, 'getAnimals']);
    Route::get('/animals/found-dogs', [AnimalController::class, 'getAnimals']);
    
    Auth::routes();
});


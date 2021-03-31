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
    Auth::routes();

    Route::view('/home', 'pages/home')->name('home');
    Route::middleware('auth')->group(function () {
        Route::get('animals/{page}/create', [AnimalController::class, 'create'])->name('show.create.advertisement');
        Route::post('/animals/{page}/create', [AnimalController::class, 'store'])->name('create.advertisement');
    });

    Route::middleware('checkAccess')->group(function () {
        Route::get('animals/{page}/{id}/edit', [AnimalController::class, 'edit'])->name('edit.advertisement');
        Route::put('/animals/{page}/{id}/edit', [AnimalController::class, 'update'])->name('update.advertisement');
    });
    
    Route::get('/animals/{page}', [AnimalController::class, 'index'])->name('show.list.pages');
    Route::get('/animals/{page}/{id}', [AnimalController::class, 'show'])->name('show.advertisement');

});


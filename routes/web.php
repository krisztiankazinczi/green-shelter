<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\ImageController;

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
        Route::delete('/animals/{id}/delete', [AnimalController::class, 'destroy'])->name('delete.advertisement');
        Route::put('/animals/{page}/{id}/adopt', [AnimalController::class, 'adopt'])->name('adopt');
        Route::put('/success-stories/{id}/withdraw-adopt', [AnimalController::class, 'withdrawAdopt'])->name('withdraw.adopt');
        Route::put('/images/{id}/{image_id}', [ImageController::class, 'changeMain'])->name('change.main.image');
        Route::delete('/images/{id}/{image_id}', [ImageController::class, 'destroy'])->name('delete.image');
    });
    
    Route::get('/animals/{page}', [AnimalController::class, 'index'])->name('show.list.pages');
    Route::get('/animals/{page}/{id}', [AnimalController::class, 'show'])->name('show.advertisement');
    Route::get('/success-stories', [AnimalController::class, 'successStories'])->name('success.stories');
    Route::get('/success-stories/{id}', [AnimalController::class, 'successStory'])->name('success.story');

});


<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AnimalTypeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\AdminController;

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
        Route::put('/animals/{id}/animal-of-week', [AnimalController::class, 'setAnimalOfWeek'])->name('set.animal.of.week');
        Route::put('/animals/{page}/{id}/adopt', [AnimalController::class, 'adopt'])->name('adopt');
        Route::put('/success-stories/{id}/withdraw-adopt', [AnimalController::class, 'withdrawAdopt'])->name('withdraw.adopt');
        Route::put('/images/{id}/{image_id}', [ImageController::class, 'changeMain'])->name('change.main.image');
        Route::delete('/images/{id}/{image_id}', [ImageController::class, 'destroy'])->name('delete.image');
    });
    
    Route::get('/animals/{page}', [AnimalController::class, 'index'])->name('show.list.pages');
    Route::get('/animals/{page}/{id}', [AnimalController::class, 'show'])->name('show.advertisement');
    Route::get('/success-stories', [AnimalController::class, 'successStories'])->name('success.stories');
    Route::get('/success-stories/{id}', [AnimalController::class, 'successStory'])->name('success.story');
    Route::get('/gallery', [ImageController::class, 'gallery'])->name('gallery');
    Route::get('/animal-of-week', [AnimalController::class, 'animalOfWeek'])->name('animal.of.week');
    Route::get('/type/{type_id}', [AnimalTypeController::class, 'index'])->name('anymal.type');

    Route::post('adoption-request/{id}', [AdoptionController::class, 'adoptionRequest'])->name('request.adoption');
    Route::delete('revert-adoption-request/{id}', [AdoptionController::class, 'revertAdoptionRequest'])->name('revert.adoption.request');

    Route::middleware('isAdmin')->group(function () {
        Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin-dashboard/adoption/{type}', [AdminController::class, 'adoptions'])->name('admin.adoption');

        Route::put('approve-adoption/{id}', [AdoptionController::class, 'approveAdoption'])->name('approve.adoption');
        Route::put('reject-adoption/{id}', [AdoptionController::class, 'rejectAdoption'])->name('reject.adoption');
        Route::put('revert-rejection/{id}', [AdoptionController::class, 'revertAdoptionRejection'])->name('revert.adoption.rejection');
        Route::put('revert-adoption/{id}', [AdoptionController::class, 'revertAdoption'])->name('revert.adoption');
    });
});


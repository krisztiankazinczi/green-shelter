<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AnimalTypeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\MessageController;

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
        Route::post('adoption-request/{id}', [AdoptionController::class, 'adoptionRequest'])->name('request.adoption');
        Route::delete('revert-adoption-request/{id}', [AdoptionController::class, 'revertAdoptionRequest'])->name('revert.adoption.request');
    
        Route::get('my-likes', [LikeController::class, 'myLikes'])->name('my.likes');
        Route::put('toggle-like/{animal_id}', [LikeController::class, 'toggleLike'])->name('toggle.like');

        Route::get('profile', [UserController::class, 'showProfile'])->name('show.profile');
        Route::get('edit-profile', [UserController::class, 'editProfile'])->name('edit.profile');
        Route::put('update-profile', [UserController::class, 'updateProfile'])->name('update.profile');
        
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

        Route::middleware('isAdmin')->group(function () {
            Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
            Route::get('/admin-dashboard/adoption/{type}', [AdminController::class, 'adoptions'])->name('admin.adoption');
            Route::put('approve-adoption/{id}', [AdoptionController::class, 'approveAdoption'])->name('approve.adoption');
            Route::put('reject-adoption/{id}', [AdoptionController::class, 'rejectAdoption'])->name('reject.adoption');
            Route::put('revert-rejection/{id}', [AdoptionController::class, 'revertAdoptionRejection'])->name('revert.adoption.rejection');
            Route::put('revert-adoption/{id}', [AdoptionController::class, 'revertAdoption'])->name('revert.adoption');
    
            Route::get('/admin-dashboard/create-species', [AdminController::class, 'createSpecies'])->name('show.create.species');
            Route::post('/create-species', [AnimalTypeController::class, 'create'])->name('create.species');
            Route::get('/admin-dashboard/species-list', [AdminController::class, 'animalTypes'])->name('anymal.types');
            Route::get('/type/{id}/edit', [AnimalTypeController::class, 'show'])->name('anymal.type.show');
            Route::put('/type/{id}/edit', [AnimalTypeController::class, 'edit'])->name('animal.type.edit');
            Route::delete('/type/{id}/delete', [AnimalTypeController::class, 'destroy'])->name('animal.type.delete');
        });

        Route::post('/add-review', [ReviewController::class, 'addReview'])->name('add.review');
        Route::post('/edit-review', [ReviewController::class, 'editReview'])->name('edit.review');
        Route::get('/messages', [MessageController::class, 'index'])->name('show.messages');
    });
 
    Route::get('/animals/{page}', [AnimalController::class, 'index'])->name('show.list.pages');
    Route::get('/animals/{page}/{id}', [AnimalController::class, 'show'])->name('show.advertisement');
    Route::get('/success-stories', [AnimalController::class, 'successStories'])->name('success.stories');
    Route::get('/success-stories/{id}', [AnimalController::class, 'successStory'])->name('success.story');
    Route::get('/gallery', [ImageController::class, 'gallery'])->name('gallery');
    Route::get('/animal-of-week', [AnimalController::class, 'animalOfWeek'])->name('animal.of.week');
    Route::get('/type/{type_id}', [AnimalTypeController::class, 'index'])->name('anymal.type');
    Route::get('/about-us/reviews', [ReviewController::class, 'index'])->name('reviews');
});


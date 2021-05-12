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
use App\Http\Controllers\ContactFormController;

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
            Route::get('/admin-dashboard/adoption/{type}/{days}', [AdminController::class, 'adoptions'])->name('admin.adoption');
            Route::put('approve-adoption/{id}', [AdoptionController::class, 'approveAdoption'])->name('approve.adoption');
            Route::put('reject-adoption/{id}', [AdoptionController::class, 'rejectAdoption'])->name('reject.adoption');
            Route::put('revert-rejection/{id}', [AdoptionController::class, 'revertAdoptionRejection'])->name('revert.adoption.rejection');
            Route::put('revert-adoption/{id}', [AdoptionController::class, 'revertAdoption'])->name('revert.adoption');
    
            Route::get('/admin-dashboard/create-species', [AdminController::class, 'createSpecies'])->name('show.create.species');
            Route::post('/create-species', [AnimalTypeController::class, 'create'])->name('create.species');
            Route::get('/admin-dashboard/species-list', [AdminController::class, 'animalTypes'])->name('animal.types');
            Route::get('/admin-dashboard/contact_messages/{type}/{days}', [AdminController::class, 'contactMessages'])->name('contact.messages');
            Route::get('/admin-dashboard/contact_message/{id}', [AdminController::class, 'contactMessage'])->name('contact.message');
            Route::put('/admin-dashboard/read/contact_message/{id}', [ContactFormController::class, 'readContactMessage'])->name('read.contact.message');
            Route::put('/admin-dashboard/complete/contact_message/{id}', [ContactFormController::class, 'completeContactMessage'])->name('complete.contact.message');
            Route::put('/admin-dashboard/revert-complete/contact_message/{id}', [ContactFormController::class, 'revertCompleteContactMessage'])->name('revert.complete.contact.message');
            Route::get('/type/{id}/edit', [AnimalTypeController::class, 'show'])->name('anymal.type.show');
            Route::put('/type/{id}/edit', [AnimalTypeController::class, 'edit'])->name('animal.type.edit');
            Route::delete('/type/{id}/delete', [AnimalTypeController::class, 'destroy'])->name('animal.type.delete');
        });

        Route::post('/add-review', [ReviewController::class, 'addReview'])->name('add.review');
        Route::post('/edit-review', [ReviewController::class, 'editReview'])->name('edit.review');
        Route::get('/messages/{type}', [MessageController::class, 'index'])->name('show.messages');
        Route::get('/messages/{type}/{id}', [MessageController::class, 'showMessage'])->name('show.message');
        Route::put('/archive-messages{id}', [MessageController::class, 'archiveMessage'])->name('archive.message');
        Route::put('/revert-archive-message/{id}', [MessageController::class, 'revertArchiveMessage'])->name('revert.archive.message');
        Route::put('/trash-message/{id}', [MessageController::class, 'trashMessage'])->name('trash.message');
        Route::put('/revert-trash-message/{id}', [MessageController::class, 'revertTrashMessage'])->name('revert.trash.message');
        Route::put('/read-message/{id}', [MessageController::class, 'readMessage'])->name('read.message');
        Route::post('/send-message', [MessageController::class, 'sendMessage'])->name('send.message');
    });
 
    Route::get('/animals/{page}', [AnimalController::class, 'index'])->name('show.list.pages');
    Route::get('/animals/{page}/{id}', [AnimalController::class, 'show'])->name('show.advertisement');
    Route::get('/success-stories', [AnimalController::class, 'successStories'])->name('success.stories');
    Route::get('/success-stories/{id}', [AnimalController::class, 'successStory'])->name('success.story');
    Route::get('/gallery', [ImageController::class, 'gallery'])->name('gallery');
    Route::get('/animal-of-week', [AnimalController::class, 'animalOfWeek'])->name('animal.of.week');
    Route::get('/type/{type_id}', [AnimalTypeController::class, 'index'])->name('anymal.type');
    Route::view('/about-us', 'pages.about_us')->name('about.us');
    Route::get('/about-us/contact-details', [ContactFormController::class, 'index'])->name('contact.details');
    Route::post('/send-message-to-admin', [ContactFormController::class, 'sendMessage'])->name('send.message.admin');
    Route::get('/about-us/reviews', [ReviewController::class, 'index'])->name('reviews');
});


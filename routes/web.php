<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\GameLogic\GameController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\AdminController;

// Home routes
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::post('/', 'uploadImage')->name('upload.image');
});

// Auth routes
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout')->name('logout');
    Route::get('/blacklisted', 'showBlacklisted')->name('blacklisted');
});

// Profile routes 
Route::prefix('profile')->name('profile.')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('index');
        Route::post('/edit', [ProfileController::class, 'edit'])->name('edit');
    });
    Route::get('view/{id}', [ProfileController::class, 'viewProfile'])->name('view');
});

// FAQ routes
Route::controller(FaqController::class)->group(function () {
    Route::get('/faq', 'index')->name('faq');
    Route::middleware('auth')->group(function () {
        Route::get('/addQuestion', 'showAddQuestionForm')->name('addQuestion');
        Route::post('/addQuestion/store', 'storeQuestion')->name('saveFAQ');
        Route::delete('/delete/{id}', 'deleteFaq')->name('faq.delete');
        Route::post('/update/{id}', 'updateFaq')->name('faq.update');
        Route::post('/faq/update/category', 'updateCategory')->name('faq.updateCategory');
        Route::get('/faq/details/{id}', 'showDetailsFaq')->name('faq.details');
        Route::post('/faq/approve/{id}', 'approveFaq')->name('faq.approve');
    });
});

// File upload routes
Route::controller(FileUploadController::class)->prefix('upload')->name('upload.')->group(function () {
    Route::get('/', 'showForm')->name('form');
    Route::post('/file', 'uploadFile')->name('file');
});

// Contact routes
Route::controller(ContactController::class)->prefix('contact')->name('contact.')->group(function () {
    Route::get('/', 'show')->name('show');
    Route::post('/send', 'submit')->name('submit');
});

// News routes
Route::controller(NewsController::class)->prefix('news')->name('news.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::middleware('auth')->group(function () {
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
        Route::post('/comments', 'storeComment')->name('comments.store');
        Route::delete('/comments/destroy/{id}', 'destroyComment')->name('comments.destroy');
        Route::post('/comments/update/{id}', 'updateComment')->name('comments.update');
    });
});

// Game routes
Route::middleware('auth')->prefix('game')->name('game.')->group(function () {
    Route::get('/', [GameController::class, 'index'])->name('index');
});

// Leaderboard routes
Route::controller(LeaderboardController::class)->prefix('leaderboard')->name('leaderboard.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/update', 'updateHighscore')->name('update');
});
Route::controller(AdminController::class)->prefix('admin')->name('admin.')->group(function () {
    Route::get('/manageUsers', 'getUserManagement')->name('userManagement');
    Route::post('/blacklist/{userId}', 'blacklistUser')->name('blacklist.toggle');
    Route::post('/admin/{userId}', 'adminUser')->name('admin.toggle');
    Route::get('/user/create', 'makeNewUser')->name('user.create');
    Route::post('/user/store', 'storeUser')->name('user.store');
    Route::delete('/user/delete/{id}', 'deleteUser')->name('user.delete');
});






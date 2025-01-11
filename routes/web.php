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
    Route::get('/password/forgotPassword', 'showForgotPasswordForm')->name('password.forgotPassword');
    Route::post('/password/sendResetCode', 'sendResetCode')->name('password.resetCode');
    Route::get('password/validateResetPage' , 'getValidateResetPage')->name('password.validateResetPage');
    Route::post('/password/validateResetCode', 'validateResetCode')->name('password.validateResetCode');
    Route::get('/password/resetPassword', 'showResetPasswordForm')->name('password.reset');
    Route::post('/password/performReset', 'performPasswordReset')->name('password.update');
});

// Profile routes 
Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/', 'show')->name('index');
        Route::post('/edit', 'edit')->name('edit');
        Route::post('/postComment/{id}', 'postComment')->name('postComment');
        Route::delete('/deleteComment/{id}', 'deleteComment')->name('deleteComment');
    });
    Route::get('view/{id}', 'viewProfile')->name('view');
});

// FAQ routes
Route::prefix('faq')->name('faq.')->controller(FaqController::class)->group(function () {
    Route::get('/', 'index')->name('main');
    Route::get('/addQuestion', 'showAddQuestionForm')->name('addQuestion');
    Route::post('/addQuestion/store', 'storeQuestion')->name('saveFAQ');
    Route::middleware('auth')->group(function () {
        Route::delete('/delete/{id}', 'deleteFaq')->name('delete');
        Route::post('/update/{id}', 'updateFaq')->name('update');
        Route::post('/update/categories/category', 'updateCategory')->name('updateCategory');
        Route::get('/details/{id}', 'showDetailsFaq')->name('details');
        Route::post('/approve/{id}', 'approveFaq')->name('approve');
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
    Route::get('/contactDashboard', 'showContactDashboard')->name('contactDashboard');
    Route::post('/contactDashboard/respond/{id}', 'respondContactRequest')->name('contactRequestResponse');
    Route::delete('/contactDashboard/delete/{id}', 'deleteContactRequest')->name('contactRequestDelete');
    Route::post('/leaderboard/{id}/illegitimate', 'illegitimateScore')->name('leaderboard.illegitimate');
});






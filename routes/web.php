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




Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/', [HomeController::class, 'uploadImage']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/upload', [FileUploadController::class, 'showForm'])->name('uploadForm');
Route::post('/upload', [FileUploadController::class, 'uploadFile'])->name('uploadFile');
Route::get('/profile', [ProfileController::class, 'show'])->name('profile')->middleware('auth');
Route::post('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/faq', [FaqController::class, 'index'])->name('faq');
Route::get('/addQuestion', [FAQController::class, 'showAddQuestionForm'])->name('addQuestion');
Route::post('/addQuestion', [FAQController::class, 'storeQuestion'])->name('saveFAQ');
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/create', [NewsController::class, 'create'])->name('news.create')->middleware('auth');
Route::post('/news', [NewsController::class, 'store'])->name('news.store')->middleware('auth');
Route::post('/news', [NewsController::class, 'update'])->name('news.update')->middleware('auth');
Route::delete('/news/{id}', [NewsController::class, 'destroy'])->name('news.destroy')->middleware('auth');
Route::post('/news/comments', [NewsController::class, 'storeComment'])->name('news.comments.store')->middleware('auth');
Route::delete('/news/comments/{id}', [NewsController::class, 'destroyComment'])->name('news.comments.destroy')->middleware('auth');
Route::post('/news/comments/{id}', [NewsController::class, 'updateComment'])->name('news.comments.update')->middleware('auth');
Route::post('/upload-image', [HomeController::class, 'uploadImage'])->name('upload.image');
Route::get('/game', [GameController::class, 'index'])->name('game.index');




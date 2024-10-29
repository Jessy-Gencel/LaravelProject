<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ContactController;



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





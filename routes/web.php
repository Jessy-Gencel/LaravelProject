<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileUploadController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/', [HomeController::class, 'uploadImage']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/upload', [FileUploadController::class, 'showForm'])->name('uploadForm');
Route::post('/upload', [FileUploadController::class, 'uploadFile'])->name('uploadFile');



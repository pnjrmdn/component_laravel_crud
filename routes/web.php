<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;



Route::get('/', function () {
    return view('home', ['title' => 'Home']);
})->name('home');

Route::get('/pegawai', function () {
    return view('pegawai.index');
});

Route::get('register', [UserController::class, 'register'])->name('register');
Route::post('register', [UserController::class, 'register_action'])->name('register.action');
Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('login', [UserController::class, 'login_action'])->name('login.action');
Route::get('password', [UserController::class, 'password'])->name('password');
Route::post('password', [UserController::class, 'password_action'])->name('password.action');
Route::get('logout', [UserController::class, 'logout'])->name('logout');
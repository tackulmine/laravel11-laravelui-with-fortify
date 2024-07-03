<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashbord');

Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', function () {
        return view('profile.edit');
    })->name('profile.edit');

    Route::get('/profile/password', function () {
        return view('profile.password');
    })->name('profile.password');

    Route::get('/profile/2fa', function () {
        return view('profile.2fa');
    })->name('profile.2fa');
});

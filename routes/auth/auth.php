<?php

use App\Http\Controllers\GoogleController;
use App\Http\Controllers\AuthController;

Route::middleware(['guest'])->group(function(){

    Route::get('/login', fn() => view('auth.login'))->name('account.login');
    Route::get('/signup', fn() => view('auth.signup'))->name('account.signup');
    
});

Route::middleware(['guest', 'throttle:20,1'])->group(function(){

    Route::post('/signup', [AuthController::class, 'signup']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/auth/redirect', [GoogleController::class, 'redirect'])
    ->name('auth.google.redirect');
    Route::get('/auth/handle', [GoogleController::class, 'handle'])
    ->name('auth.google.handle');

});




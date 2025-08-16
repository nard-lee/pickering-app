<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () 
{
    return view('dashboard');
})->middleware('auth');

Route::get('/logout', function () 
{
    auth()->logout();
    return redirect('/login');
});

require __DIR__.'/auth/auth.php';
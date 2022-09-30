<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/my-schedule', function () {
    return view('my-schedule.index');
})->middleware(['auth', 'verified'])->name('my-schedule');

require __DIR__.'/auth.php';

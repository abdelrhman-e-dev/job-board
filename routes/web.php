<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;


Route::controller(IndexController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/about', 'about')->name('about');
});

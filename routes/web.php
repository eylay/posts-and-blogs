<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('landing-page');
Route::resource('posts', 'PostController');

<?php

use App\Http\Controllers\CoursesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout.starter-en');
});

Route::get('/home', function(){
    return view('home');
});

Route::resource('courses',CoursesController::class);

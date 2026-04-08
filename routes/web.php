<?php

use App\Http\Controllers\CoursesController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TrainigProgramController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout.starter-en');
});

Route::get('/home', function(){
    return view('home');
});

Route::resource('courses',CoursesController::class);

Route::resource('students', StudentController::class);

Route::resource('programs', TrainigProgramController::class);

<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\GroupScheduleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TrainigProgramController;
use App\Http\Controllers\ProgramSessionController;
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

Route::resource('program-sessions', ProgramSessionController::class)->parameters([
    'program-sessions' => 'programSession'
]);

Route::resource('branches', BranchController::class);

Route::resource('groups', GroupController::class);

Route::resource('groupSchedules', GroupScheduleController::class);

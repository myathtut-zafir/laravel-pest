<?php

use App\Http\Controllers\PageCourseDetailController;
use App\Http\Controllers\PageHomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', PageHomeController::class)->name('home');
Route::get('/course/{course:slug}/', PageCourseDetailController::class)->name('course-detail');


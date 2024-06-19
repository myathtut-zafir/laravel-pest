<?php

use App\Http\Controllers\PageCourseDetailController;
use App\Http\Controllers\PageHomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', PageHomeController::class)->name('pages.home');
Route::get('/course/{course:slug}/', PageCourseDetailController::class)->name('pages.course-detail');


<?php

use App\Http\Controllers\PageCourseDetailController;
use App\Http\Controllers\PageDashboardController;
use App\Http\Controllers\PageHomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', PageHomeController::class)->name('pages.home');
Route::get('/course/{course:slug}/', PageCourseDetailController::class)->name('pages.course-detail');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard',PageDashboardController::class)->name('dashboard');
});

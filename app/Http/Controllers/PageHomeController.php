<?php

namespace App\Http\Controllers;

use App\Models\Course;

class PageHomeController extends Controller
{
    public function __invoke()
    {
        $courses = Course::query()->whereNotNull('release_at')->
        orderBy('release_at','desc')->
        get();
        return view('home', compact('courses'));
    }
}

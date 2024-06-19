<?php

namespace App\Http\Controllers;

use App\Models\Course;

class PageHomeController extends Controller
{
    public function __invoke()
    {
        $courses = Course::query()->released()->
        orderBy('release_at', 'desc')->
        get();

        return view('pages.home', compact('courses'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Course;

class PageCourseDetailController extends Controller
{
    public function __invoke(Course $course)
    {
        return view('course-detail', compact('course'));

    }
}

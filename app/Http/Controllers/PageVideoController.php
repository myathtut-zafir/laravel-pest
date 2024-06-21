<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Video;

class PageVideoController extends Controller
{
    public function __invoke(Course $course, Video $video)
    {
        $video = $video->exists ? $video : $course->videos->first();

        return view('pages.course-video', compact('video'));
    }
}

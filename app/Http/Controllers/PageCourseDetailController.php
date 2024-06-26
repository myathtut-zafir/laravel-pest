<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PageCourseDetailController extends Controller
{
    public function __invoke(Course $course)
    {

        if (! $course->release_at) {
            throw new NotFoundHttpException();
        }
        $course->loadCount('videos');

        return view('pages.course-detail', compact('course'));

    }
}

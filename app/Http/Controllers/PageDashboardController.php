<?php

namespace App\Http\Controllers;

class PageDashboardController extends Controller
{
    public function __invoke()
    {
        $purchaseCourses = auth()->user()->courses;

        return view('dashboard', compact('purchaseCourses'));

    }
}

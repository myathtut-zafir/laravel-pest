<?php

namespace App\Http\Controllers;

class PageDashboardController extends Controller
{
    public function __invoke()
    {
        $purchaseCourses = auth()->user()->purchasedCourses;

        return view('dashboard', compact('purchaseCourses'));

    }
}

<?php

namespace Tests\Feature;

use App\Models\Course;

use function Pest\Laravel\get;

it('give back success home page', function () {
    //Act & Assert
    get(route('pages.home'))->assertOk();
});
it('give back success response for course detail', function () {
    //Act & Assert
    $course = Course::factory()->release()->create();
    get(route('pages.course-detail', $course))->assertOk();
});
it('give back success response for dashboard', function () {

    loginAsUser();
    get(route('pages.dashboard'))->assertOk();
});

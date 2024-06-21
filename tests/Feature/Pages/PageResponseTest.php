<?php

namespace Tests\Feature;

use App\Models\Course;

use App\Models\Video;
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
it('does not find jetstream regsiration page', function () {

    get('register')->assertNotFound();
});

it('give succes response for video page', function () {

    $course = Course::factory()->has(Video::factory())->create();
    loginAsUser();
    get(route('page.course-videos', $course))->assertOk();
});

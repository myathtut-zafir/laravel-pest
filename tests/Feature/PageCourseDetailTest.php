<?php

use App\Models\Course;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('show course details', function () {
    $course = Course::factory()->release()->create();

    get(route('course-detail', $course))->assertOk()->assertSeeText([
        $course->title,
        $course->description,
        $course->tagline,
        ...$course->learnings
    ])->assertSee(asset("images/$course->image_name"));
});

it('show course video count', function () {
    $course = Course::factory()
        ->has(Video::factory()->count(3))
        ->create();

    get(route('course-detail', $course))->assertSeeText("3 Videos");
});

it('does not find unreleased course', function () {
    $course = Course::factory()->create();

    get(route('course-detail', $course))->assertNotFound();
});


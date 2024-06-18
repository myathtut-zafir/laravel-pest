<?php

use App\Models\Course;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('show course detail', function () {
    $course = Course::factory()->create([
        "tagline" => "This is a tagline",
        "image" => "image.png",
        "learnings" => ["Learning 1", "Learning 2", "Learning 3"],
    ]);
    get(route('course-detail', $course))->assertOk()->assertSeeText([
        $course->title,
        $course->description,
        "This is a tagline",
        "Learning 1",
        "Learning 2",
        "Learning 3",
    ])->assertSee("image.png");
});

it('show course video count', function () {
    $course = Course::factory()->create();
    Video::factory()->count(3)->create(['course_id' => 1]);
    get(route('course-detail', $course))->assertSeeText("3 Videos");
});


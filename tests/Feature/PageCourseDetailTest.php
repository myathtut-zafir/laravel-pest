<?php

use App\Models\Course;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('show course details', function () {
    $course = Course::factory()->create(['image_name'=>'image.png']);
    get(route('course-detail', $course))->assertOk()->assertSeeText([
        $course->title,
        $course->description,
        $course->tagline,
        ...$course->learnings
    ])->assertSee(asset("images/$course->image_name"));
});

it('show course video count', function () {
    $course = Course::factory()->create();
    Video::factory()->count(3)->create(['course_id' => 1]);
    get(route('course-detail', $course))->assertSeeText("3 Videos");
});


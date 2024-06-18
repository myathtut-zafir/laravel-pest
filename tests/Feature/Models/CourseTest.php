<?php

use App\Models\Course;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('only return release course for released scope', function () {
    Course::factory()->release()->create();
    Course::factory()->create();

    expect(Course::released()->get())->toHaveCount(1)
        ->first()->id->toEqual(1);

});
it('has video', function () {
    $course = Course::factory()->create();
    Video::factory()->count(3)->create(['course_id' => 1]);

    expect($course->videos)->toHaveCount(3)
        ->each->toBeInstanceOf(Video::class);
});

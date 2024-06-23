<?php


use App\Models\Course;
use App\Models\Video;

test('given back readable video duration', function () {
    $video = Video::factory()->create(['duration_in_mins' => 10]);

    expect($video->getReadableDuration())->toEqual('10min');
});

test('belong to a course', function () {
    $video = Video::factory()->
    has(Course::factory())->
    create();

    expect($video->course)->toBeInstanceOf(Course::class);
});

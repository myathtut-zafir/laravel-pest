<?php

use App\Models\Course;
use App\Models\User;
use App\Models\Video;

test('has courses', function () {
    $users = User::factory()->
    has(Course::factory()->count(2),'purchasedCourses')->
    create();

    expect($users->purchasedCourses)->toHaveCount(2)
        ->each->toBeInstanceOf(Course::class);
});
test('has videos', function () {
    $users = User::factory()->
    has(Video::factory()->count(2),'watchedVideos')->
    create();

    expect($users->watchedVideos)->toHaveCount(2)
        ->each->toBeInstanceOf(Video::class);
});

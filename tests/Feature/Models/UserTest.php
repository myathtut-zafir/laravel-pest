<?php

use App\Models\Course;
use App\Models\User;
use App\Models\Video;

test('has courses', function () {
    $users = User::factory()->
    has(Course::factory()->count(2))->
    create();

    expect($users->courses)->toHaveCount(2)
        ->each->toBeInstanceOf(Course::class);
});
test('has videos', function () {
    $users = User::factory()->
    has(Video::factory()->count(2),'videos')->
    create();

    expect($users->videos)->toHaveCount(2)
        ->each->toBeInstanceOf(Video::class);
});

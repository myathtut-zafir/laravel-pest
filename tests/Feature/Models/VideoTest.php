<?php


use App\Models\Course;
use App\Models\User;
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
test('tell current user has already watched video', function () {
    $user = User::factory()
        ->has(Video::factory(), 'watchedVideos')
        ->create();
    loginAsUser($user);
    expect($user->watchedVideos()->first()->alreadyWatchedByCurrentUser())->toBeTrue();
});
test('tell current user has not  watched video', function () {
    $video = Video::factory()->create();
    loginAsUser();
    expect($video->alreadyWatchedByCurrentUser())->toBeFalse();
});

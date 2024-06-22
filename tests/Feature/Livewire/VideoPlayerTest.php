<?php


use App\Livewire\VideoPlayer;
use App\Models\Course;
use App\Models\Video;

test('show details for given video', function () {
    $course = Course::factory()->
    has(Video::factory()
        ->state(
            [
                'title' => 'My Video',
                'description' => 'My Video Description',
                'duration' => 10
            ]))
        ->create();

    Livewire::test(VideoPlayer::class, ['video' => $course->videos->first()])
        ->assertSeeText([
            'My Video',
            'My Video Description',
            '(10min)',
        ]);
});

test('show given video', function () {
    $course = Course::factory()->
    has(Video::factory()
        ->state(
            [
                'vimeo_id' => 'vimeo-id',
            ]))
        ->create();

    Livewire::test(VideoPlayer::class, ['video' => $course->videos->first()])
        ->assertSee('<iframe src="https://player.vimeo.com/video/vimeo-id"', false);
});

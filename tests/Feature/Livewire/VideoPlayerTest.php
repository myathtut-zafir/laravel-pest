<?php


use App\Livewire\VideoPlayer;
use App\Models\Course;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Sequence;

test('show details for given video', function () {
    $course = Course::factory()->
    has(Video::factory()
        ->state(
            [
                'duration_in_mins' => 10
            ]))
        ->create();
    $video = $course->videos->first();
    Livewire::test(VideoPlayer::class, ['video' => $video])
        ->assertSeeText([
            $video->title,
            $video->description,
            "({$video->duration_in_mins}min)"
        ]);
});

test('show given video', function () {
    $course = Course::factory()->
    has(Video::factory())
        ->create();
    $video = $course->videos->first();
    Livewire::test(VideoPlayer::class, ['video' => $video])
        ->assertSeeHtml('<iframe src="https://player.vimeo.com/video/' . $video->vimeo_id . '"');
});
test('show lists of all video courses', function () {
    $course = Course::factory()->
    has(Video::factory()->count(3)
        ->state(new Sequence(
            ['title' => 'First video'],
            ['title' => 'Second video'],
            ['title' => 'Third video']
        ))
    )->create();


    Livewire::test(VideoPlayer::class, ['video' => $course->videos->first()])
        ->assertSee([
            ...$course->videos->pluck('title')->toArray()
        ])
        ->assertSeeHtml([
            route('page.course-videos', Video::where('title', "First video")->first()),
            route('page.course-videos', Video::where('title', "Second video")->first()),
            route('page.course-videos', Video::where('title', "Third video")->first()),
        ]);
});
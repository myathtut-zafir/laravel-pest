<?php


use App\Livewire\VideoPlayer;
use App\Models\Course;
use App\Models\Video;

beforeEach(function () {
    $this->loggedInUser = loginAsUser();
});
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
    $course = createCourseAndVideos();
    $video = $course->videos->first();

    Livewire::test(VideoPlayer::class, ['video' => $video])
        ->assertSeeHtml('<iframe src="https://player.vimeo.com/video/' . $video->vimeo_id . '"');
});
test('show lists of all video courses', function () {
    $course = createCourseAndVideos(videosCount: 3);


    Livewire::test(VideoPlayer::class, ['video' => $course->videos->first()])
        ->assertSee([
            ...$course->videos->pluck('title')->toArray()
        ])
        ->assertSeeHtml([
            route('page.course-videos', [ $course, $course->videos[1]]),
            route('page.course-videos', [ $course, $course->videos[2]]),
        ]);
});
test('does not include route for current video', function () {
    $course = createCourseAndVideos(videosCount: 3);


    Livewire::test(VideoPlayer::class, ['video' => $course->videos->first()])
        ->assertDontSeeHtml(route('page.course-videos', $course->videos->first()),);
});
test('marks video as completed', function () {
//    $user = User::factory()->create();
    $course = createCourseAndVideos();

    $this->loggedInUser->purchasedCourses()->attach($course);

    expect($this->loggedInUser->watchedVideos)->toHaveCount(0);

    loginAsUser($this->loggedInUser);
    Livewire::test(VideoPlayer::class, ['video' => $course->videos->first()])
        ->assertMethodWired('markVideoAsCompleted')
        ->call('markVideoAsCompleted')
        ->assertMethodNotWired('markVideoAsCompleted')
        ->assertMethodWired('markVideoAsNotCompleted');

    $this->loggedInUser->refresh();
    expect($this->loggedInUser->watchedVideos)->toHaveCount(1)->
    first()->title->toEqual($course->videos->first()->title);

});
test('marks video as not completed', function () {
//    $user = User::factory()->create();
    $course = createCourseAndVideos();

    $this->loggedInUser->purchasedCourses()->attach($course);
    $this->loggedInUser->watchedVideos()->attach($course->videos()->first());

    expect($this->loggedInUser->watchedVideos)->toHaveCount(1);

    loginAsUser($this->loggedInUser);
    Livewire::test(VideoPlayer::class, ['video' => $course->videos->first()])
        ->assertMethodWired('markVideoAsNotCompleted')
        ->call('markVideoAsNotCompleted')
        ->assertMethodNotWired('markVideoAsNotCompleted')
        ->assertMethodWired('markVideoAsCompleted');

    $this->loggedInUser->refresh();
    expect($this->loggedInUser->watchedVideos)->toHaveCount(0);
});

function createCourseAndVideos(int $videosCount = 1): Course
{
    return Course::factory()
        ->has(Video::factory()
            ->count($videosCount))
        ->create();
}

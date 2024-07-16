<?php

use App\Livewire\VideoPlayer;
use App\Models\Course;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Sequence;
use function Pest\Laravel\get;

test('cannot access by guest', function () {
    $course = Course::factory()->create();
    get(route('page.course-videos', $course))
        ->assertRedirect(route('login'));

});
test('include video player', function () {
    $courses = Course::factory()->
        has(Video::factory())
        ->create();
    loginAsUser();
    get(route('page.course-videos', $courses))
        ->assertOk()
        ->assertSeeLivewire(VideoPlayer::class);
});
test('show first course video by default', function () {
    $course = Course::factory()->
    has(Video::factory())->create();

    loginAsUser();
    get(route('page.course-videos', [
        'course' => $course,
        'video' => $course->videos()->orderByDesc('id')->first()]))
        ->assertOk()
        ->assertSeeText($course->videos()->first()->title);

});
test('show provided course video', function () {

});

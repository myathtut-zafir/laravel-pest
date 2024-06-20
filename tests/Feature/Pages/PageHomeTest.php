<?php

use App\Models\Course;
use Illuminate\Support\Carbon;

use function Pest\Laravel\get;

test('show course overview', function () {
    //Arrange
    $first = Course::factory()->release()->create();
    $second = Course::factory()->release()->create();
    $third = Course::factory()->release()->create();
    //Act & Assert
    get(route('pages.home'))->assertSeeText([
        $first->title,
        $first->description,
        $second->title,
        $second->description,
        $third->title,
        $third->description,
    ]);
});

test('show only released course', function () {
    $release = Course::factory()->release()->create();
    $nonRelease = Course::factory()->create();
    get(route('pages.home'))->assertSeeText([
        $release->title,
    ])->assertDontSee([$nonRelease->title]);
});
it('show course by release date', function () {
    $releaseCourse = Course::factory()->release(Carbon::yesterday())->create();
    $newtReleaseCourse = Course::factory()->release()->create();

    get(route('pages.home'))->assertSeeTextInOrder([
        $newtReleaseCourse->title,
        $releaseCourse->title,
    ]);
});

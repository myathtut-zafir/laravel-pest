<?php

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

test('show course overview', function () {
    //Arrange
    $first = Course::factory()->release()->create();
    $second = Course::factory()->release()->create();
    $third = Course::factory()->release()->create();
    //Act & Assert
    get(route('home'))->assertSeeText([
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
    get(route('home'))->assertSeeText([
        $release->title,
    ])->assertDontSee([$nonRelease->title]);
});
it('show course by release date', function () {
    $releaseCourse = Course::factory()->release(Carbon::yesterday())->create();
    $newtReleaseCourse = Course::factory()->release()->create();

    get(route('home'))->assertSeeTextInOrder([
        $newtReleaseCourse->title,
        $releaseCourse->title,
    ]);
});

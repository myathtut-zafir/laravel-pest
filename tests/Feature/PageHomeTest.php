<?php

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
    ])->assertDontSee([$nonRelease->title,]);
});
test('show course by release date', function () {
    Course::factory()->create(['title' => 'Course A', 'release_at' => Carbon\Carbon::yesterday()]);
    Course::factory()->create(['title' => 'Course B', 'release_at' => Carbon\Carbon::now()]);

    get(route('home'))->assertSeeTextInOrder([
        'Course B',
        'Course A',
    ]);
});

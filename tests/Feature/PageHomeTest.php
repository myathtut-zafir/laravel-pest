<?php

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

test('show course overview', function () {
    //Arrange
    Course::factory()->create(['title' => 'Course A', 'description' => "Description A",'release_at' => Carbon\Carbon::now()]);
    Course::factory()->create(['title' => 'Course B', 'description' => "Description B",'release_at' => Carbon\Carbon::now()]);
    Course::factory()->create(['title' => 'Course C', 'description' => "Description C",'release_at' => Carbon\Carbon::now()]);
    //Act & Assert
    get(route('home'))->assertSeeText([
        'Course A',
        'Description A',
        'Course B',
        'Description B',
        'Course C',
        'Description C',
    ]);
});

test('show only released course', function () {
    Course::factory()->create(['title' => 'Course A', 'release_at' => Carbon\Carbon::yesterday()]);
    Course::factory()->create(['title' => 'Course B', 'description' => "Description B"]);
    get(route('home'))->assertSeeText([
        'Course A',
    ])->assertDontSee(['Course B']);
});
test('show course by release date', function () {
    Course::factory()->create(['title' => 'Course A', 'release_at' => Carbon\Carbon::yesterday()]);
    Course::factory()->create(['title' => 'Course B', 'release_at' => Carbon\Carbon::now()]);

    get(route('home'))->assertSeeTextInOrder([
        'Course B',
        'Course A',
    ]);
});

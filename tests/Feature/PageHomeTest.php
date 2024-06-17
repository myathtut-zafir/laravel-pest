<?php

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

test('show course overview', function () {
    //Arrange
    Course::factory()->create(['title' => 'Course A', 'description' => "Description A"]);
    Course::factory()->create(['title' => 'Course B', 'description' => "Description B"]);
    Course::factory()->create(['title' => 'Course C', 'description' => "Description C"]);
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

});
test('show course by release date', function () {

});

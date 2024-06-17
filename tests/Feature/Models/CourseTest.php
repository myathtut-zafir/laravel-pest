<?php

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('only return release course for released scope', function () {
    Course::factory()->release()->create();
    Course::factory()->create();

    expect(Course::released()->get())->toHaveCount(1)
        ->first()->id->toEqual(1);

});

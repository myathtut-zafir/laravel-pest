<?php

use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('has courses', function () {
    $users = User::factory()->
    has(Course::factory()->count(2))->
    create();

    expect($users->courses)->toHaveCount(2)
        ->each->toBeInstanceOf(Course::class);
});

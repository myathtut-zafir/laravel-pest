<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('give back success home page', function () {
    //Act & Assert
    get(route('pages.home'))->assertOk();
});
it('give back success response for course detail', function () {
    //Act & Assert
    $course = Course::factory()->release()->create();
    get(route('pages.course-detail', $course))->assertOk();
});
it('give back success response for dashboard', function () {

    $user = User::factory()->create();
    $this->actingAs($user);
    get(route('dashboard'))->assertOk();
});

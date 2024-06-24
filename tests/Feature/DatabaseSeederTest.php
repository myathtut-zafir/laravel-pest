<?php


use App\Models\Course;
use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\App;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

test('add given courses', function () {
    assertDatabaseCount(Course::class, 0);
    $this->artisan('db:seed');
    assertDatabaseCount(Course::class, 3);
    assertDatabaseHas(Course::class, ['title' => 'Laravel For Beginners']);
    assertDatabaseHas(Course::class, ['title' => 'Advanced Laravel']);
    assertDatabaseHas(Course::class, ['title' => 'TDD The Laravel Way']);
});

test('add given courses only once', function () {
    $this->artisan('db:seed');
    $this->artisan('db:seed');

    assertDatabaseCount(Course::class, 3);
});
test('add given video', function () {
    assertDatabaseCount(Video::class, 0);
    $this->artisan('db:seed');
    $laravelForBeginnersCourse = Course::where('title', 'Laravel For Beginners')->firstOrFail();
    $advancedLaravelCourse = Course::where('title', 'Advanced Laravel')->firstOrFail();
    $tddTheLaravelWayCourse = Course::where('title', 'TDD The Laravel Way')->firstOrFail();
    assertDatabaseCount(Video::class, 8);
    expect($laravelForBeginnersCourse)
        ->videos
        ->toHaveCount(3);
    expect($advancedLaravelCourse)
        ->videos
        ->toHaveCount(3);
    expect($tddTheLaravelWayCourse)
        ->videos
        ->toHaveCount(2);
});
test('add given video only once', function () {
    assertDatabaseCount(Video::class, 0);
    $this->artisan('db:seed');
    $this->artisan('db:seed');
    assertDatabaseCount(Video::class, 8);
});
test('add local test user', function () {
    App::partialMock()->shouldReceive('environment')->andReturn('local');
    assertDatabaseCount(User::class, 0);
    $this->artisan('db:seed');
    assertDatabaseCount(User::class, 1);
});
test('does not add test user for production', function () {
    assertDatabaseCount(User::class, 0);
    $this->artisan('db:seed');
    assertDatabaseCount(User::class, 0);
});

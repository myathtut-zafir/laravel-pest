<?php


use App\Models\Course;
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
    $response = $this->get('/');

    $response->assertStatus(200);
});
test('add given video only once', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

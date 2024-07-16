<?php

use App\Models\Course;
use App\Models\Video;

use function Pest\Laravel\get;

it('show course details', function () {
    $course = Course::factory()->release()->create();

    get(route('pages.course-detail', $course))->assertOk()->assertSeeText([
        $course->title,
        $course->description,
        $course->tagline,
        ...$course->learnings,
    ])->assertSee(asset("images/$course->image_name"));
});

it('show course video count', function () {
    $course = Course::factory()
        ->has(Video::factory()->count(3))
        ->release()
        ->create();

    get(route('pages.course-detail', $course))->assertSeeText('3 Videos');
});

it('does not find unreleased course', function () {
    $course = Course::factory()->create();

    get(route('pages.course-detail', $course))->assertNotFound();
});
it('include paddle checkout button', function () {
    $course = Course::factory()->release()->create([
        'paddle_product_id' => 'product-id'
    ]);

    get(route('pages.course-detail', $course))->assertOk()
        ->assertSee('<script src="https://cdn.paddle.com/paddle/paddle.js"></script>', false)
        ->assertSee('Paddle.Setup({vendor: 4736});',false)
        ->assertSee('<a href="#!" data-product="product-id" data-theme="none" class="paddle_button', false);
});

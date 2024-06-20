<?php

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

test('cannot be access guest', function () {
    get(route('dashboard'))->assertRedirect(route('login'));
});
test('list purchased course', function () {

    $users = User::factory()->
    has(Course::factory()->count(2)->state(
        new Sequence(
            ["title" => "Course A"],
            ["title" => "Course B"])
    ))->
    create();
    $this->actingAs($users);
    get(route('dashboard'))->assertOk()
        ->assertSeeText([
            "Course A",
            "Course B"

        ]);
});
test('does not list other course', function () {
    $user = User::factory()->create();
    $course = Course::factory()->create();

    $this->actingAs($user);
    get(route('dashboard'))->
    assertOk()->
    assertDontSeeText($course->title);
});
test('show latest purchased course first', function () {
    $user = User::factory()->create();
    $firstPurchaseCourse = Course::factory()->create();
    $lastPurchaseCourse = Course::factory()->create();
    $user->courses()->attach($firstPurchaseCourse, ['created_at' => \Carbon\Carbon::yesterday()]);
    $user->courses()->attach($lastPurchaseCourse, ['created_at' => \Carbon\Carbon::now()]);
    $this->actingAs($user);
    get(route('dashboard'))->
    assertOk()->
    assertSeeInOrder([
        $lastPurchaseCourse->title,
        $firstPurchaseCourse->title
    ]);

});
test('include link to product videos', function () {
    $user = User::factory()->
    has(Course::factory())->
    create();
    $this->actingAs($user);
    get(route('dashboard'))->
    assertOk()->
    assertSeeText('Watch videos')->
    assertSee(route('page.course-videos', Course::first()));

});

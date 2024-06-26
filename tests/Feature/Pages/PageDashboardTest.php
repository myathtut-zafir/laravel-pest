<?php

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;

use function Pest\Laravel\get;

test('cannot be access guest', function () {
    get(route('pages.dashboard'))->assertRedirect(route('login'));
});
test('list purchased course', function () {

    $users = User::factory()->
    has(Course::factory()->count(2)->state(
        new Sequence(
            ['title' => 'Course A'],
            ['title' => 'Course B']
        )),'purchasedCourses')->
    create();
    loginAsUser($users);
    get(route('pages.dashboard'))->assertOk()
        ->assertSeeText([
            'Course A',
            'Course B',

        ]);
});
test('does not list other course', function () {
    $course = Course::factory()->create();

    loginAsUser();
    get(route('pages.dashboard'))->
    assertOk()->
    assertDontSeeText($course->title);
});
test('show latest purchased course first', function () {
    $user = User::factory()->create();
    $firstPurchaseCourse = Course::factory()->create();
    $lastPurchaseCourse = Course::factory()->create();
    $user->purchasedCourses()->attach($firstPurchaseCourse, ['created_at' => \Carbon\Carbon::yesterday()]);
    $user->purchasedCourses()->attach($lastPurchaseCourse, ['created_at' => \Carbon\Carbon::now()]);
    loginAsUser($user);
    get(route('pages.dashboard'))->
    assertOk()->
    assertSeeInOrder([
        $lastPurchaseCourse->title,
        $firstPurchaseCourse->title,
    ]);

});
test('include link to product videos', function () {
    $user = User::factory()->
    has(Course::factory(),'purchasedCourses')->
    create();
    loginAsUser($user);
    get(route('pages.dashboard'))->
    assertOk()->
    assertSeeText('Watch videos')->
    assertSee(route('page.course-videos', Course::first()));

});

it('include logout', function () {

    loginAsUser();
    get(route('pages.dashboard'))->assertOk()
        ->assertSeeText("Log Out")
        ->assertSee(route('logout'));
});

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
test('show latest purchased course first', function () {

});
test('include link to product videos', function () {

});

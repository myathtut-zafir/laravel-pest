<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

test('cannot be access guest', function () {
    get(route('dashboard'))->assertRedirect(route('login'));
});
test('list purchased course', function () {

});
test('show latest purchased course first', function () {

});
test('include link to product videos', function () {

});

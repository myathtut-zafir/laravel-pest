<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('give back success home page', function () {
    //Act & Assert
    get(route('home'))->assertOk();
});

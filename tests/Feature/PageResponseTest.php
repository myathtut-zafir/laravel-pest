<?php

namespace Tests\Feature;

use function Pest\Laravel\get;

it('give back success home page', function () {
    //Act & Assert
    get(route('home'))->assertOk();
});

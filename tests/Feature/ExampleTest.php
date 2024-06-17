<?php

namespace Tests\Feature;

it('basic test', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

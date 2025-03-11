<?php

it('returns a successful response', function () {
    $response = $this->get('/');

    // Users not logged in are redirected to login...
    $response->assertStatus(302);
});

<?php

test('the application returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);

    expect($response->getContent())->toContain('<title>Laravel</title>');
});

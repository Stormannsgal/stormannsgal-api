<?php declare(strict_types=1);

use Psr\Http\Message\ResponseInterface;

test('GET /api/ping returns successful json response', function () {
    $request = $this->createGetRequest('/api/ping');

    $response = $this->app->handle($request);

    expect($response->getStatusCode())->toBe(200);

    $body = (string)$response->getBody();
    $data = json_decode($body, true);

    expect($data)
        ->toBeArray()
        ->toHaveKey('message', 'pong')
        ->toHaveKey('ack');
});

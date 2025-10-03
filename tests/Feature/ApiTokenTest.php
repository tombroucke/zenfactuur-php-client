<?php

use Otomaties\Zenfactuur\GetApiTokenRequest;
use Otomaties\Zenfactuur\ZenfactuurConnector;

test('api token retrieval', function () {
    $connector = new ZenfactuurConnector(
        token: $_ENV['ZENFACTUUR_API_TOKEN'] ?? null,
    );
    $request = new GetApiTokenRequest;
    $response = $connector->send($request);

    expect($response->status())->toBe(200);
    expect($response->data())->toHaveKey('username');
});

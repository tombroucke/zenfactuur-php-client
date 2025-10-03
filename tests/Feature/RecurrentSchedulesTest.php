<?php

use Otomaties\Zenfactuur\RecurrentSchedules\GetRecurrentScheduleRequest;
use Otomaties\Zenfactuur\RecurrentSchedules\GetRecurrentSchedulesRequest;
use Otomaties\Zenfactuur\ZenfactuurConnector;

test('get recurrent schedules', function () {
    $connector = new ZenfactuurConnector(
        token: $_ENV['ZENFACTUUR_API_TOKEN'] ?? null,
    );
    $request = new GetRecurrentSchedulesRequest;
    $response = $connector->send($request);

    expect($response->status())->toBe(200);
    expect($response->data())->toBeArray();
});

test('get recurrent schedule', function () {
    $connector = new ZenfactuurConnector(
        token: $_ENV['ZENFACTUUR_API_TOKEN'] ?? null,
    );
    $request = new GetRecurrentScheduleRequest(5362);
    $response = $connector->send($request);

    expect($response->status())->toBe(200);
    expect($response->data())->toBeArray();
});

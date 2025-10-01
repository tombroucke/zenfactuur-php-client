<?php

use Otomaties\Zenfactuur\Clients\CreateClientRequest;
use Otomaties\Zenfactuur\Clients\FindClientsRequest;
use Otomaties\Zenfactuur\Clients\GetClientsRequest;
use Otomaties\Zenfactuur\Clients\UpdateClientRequest;
use Otomaties\Zenfactuur\ZenfactuurConnector;

test('get clients', function () {
    $connector = new ZenfactuurConnector(
        token: $_ENV['ZENFACTUUR_TOKEN'] ?? null,
    );

    // Page 1
    $requestPage1 = new GetClientsRequest;
    $responsePage1 = $connector->send($requestPage1);

    expect($responsePage1->status())->toBe(200);
    expect($responsePage1->data())->toBeArray();

    $requestPage2 = new GetClientsRequest;
    $requestPage2->page(2);
    $responsePage2 = $connector->send($requestPage2);

    expect($responsePage2->status())->toBe(200);
    expect($responsePage2->data())->toBeArray();

    expect($responsePage1->data())->not->toBe($responsePage2->data());

});

test('create clients', function () {
    $connector = new ZenfactuurConnector(
        token: $_ENV['ZENFACTUUR_TOKEN'] ?? null,
    );
    $request = new CreateClientRequest([
        'type_id' => 0,
        'name' => 'Test Client '.time(),
        'email' => 'test+'.time().'@example.com',
    ]);
    $response = $connector->send($request);

    expect($response->status())->toBe(201);
    expect($response->data())->toBeArray();
    expect($response->data())->toHaveKey('id');
    expect($response->data())->toHaveKey('name');
});

test('find clients', function () {
    $connector = new ZenfactuurConnector(
        token: $_ENV['ZENFACTUUR_TOKEN'] ?? null,
    );
    $request = new FindClientsRequest(query: 'Test Client');
    $response = $connector->send($request);

    expect($response->status())->toBe(200);
    expect($response->data())->toBeArray();
});

test('update clients', function () {
    $connector = new ZenfactuurConnector(
        token: $_ENV['ZENFACTUUR_TOKEN'] ?? null,
    );
    $request = new FindClientsRequest(query: 'Test Client');
    $response = $connector->send($request);

    $firstClient = $response->data()[0] ?? null;
    expect($firstClient)->not->toBeNull();

    $clientId = $firstClient['id'];
    $client = [
        'name' => 'Updated Client '.time(),
    ];
    $request = new UpdateClientRequest($clientId, $client);
    $response = $connector->send($request);

    expect($response->status())->toBe(200);
    expect($response->data())->toBeArray();
    expect($response->data())->toHaveKey('id');
    expect($response->data())->toHaveKey('name');
    expect($response->data()['name'])->toBe($client['name']);
});

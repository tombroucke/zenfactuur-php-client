<?php

use Otomaties\Zenfactuur\Invoices\CreateInvoiceRequest;
use Otomaties\Zenfactuur\Invoices\GetInvoiceRequest;
use Otomaties\Zenfactuur\Invoices\GetInvoicesRequest;
use Otomaties\Zenfactuur\Invoices\SendByEmailRequest;
use Otomaties\Zenfactuur\Invoices\SendToPeppolRequest;
use Otomaties\Zenfactuur\ZenfactuurConnector;

test('get invoices', function () {
    $connector = new ZenfactuurConnector(
        token: $_ENV['ZENFACTUUR_API_TOKEN'] ?? null,
    );
    $request = new GetInvoicesRequest;
    $response = $connector->send($request);

    expect($response->status())->toBe(200);
    expect($response->data())->toBeArray();
});

test('create invoice', function () {
    $connector = new ZenfactuurConnector(
        token: $_ENV['ZENFACTUUR_API_TOKEN'] ?? null,
    );
    $request = new CreateInvoiceRequest([
        'client' => [
            'type_id' => 0,
            'name' => 'Test Client '.time(),
            'email' => 'test+'.time().'@example.com',
            'street' => 'Test Street 123',
            'postcode' => '12345',
            'city' => 'Test City',
            'country' => 'BE',
        ],
        'invoice' => [
            'date' => date('Y-m-d'),
            'internal_description' => 'Test Invoice '.time(),
            'vat_percentage' => 21,
            'pay_message' => true,
            'commercial_document_lines_attributes' => [
                [
                    'description' => 'Test Product 1',
                    'unit_price' => 100,
                    'number_skus' => 2,
                ],
            ],
        ],
    ]);
    $response = $connector->send($request);

    expect($response->status())->toBe(201);
    expect($response->data())->toBeArray();
});

test('get invoice', function () {
    $connector = new ZenfactuurConnector(
        token: $_ENV['ZENFACTUUR_API_TOKEN'] ?? null,
    );
    $request = new GetInvoiceRequest(1944398);
    $response = $connector->send($request);

    expect($response->status())->toBe(200);
    expect($response->data())->toBeArray();
});

test('send to peppol', function () {
    $connector = new ZenfactuurConnector(
        token: $_ENV['ZENFACTUUR_API_TOKEN'] ?? null,
    );
    $request = new SendToPeppolRequest(1944398);
    $response = $connector->send($request);

    expect($response->status())->toBe(200);
    expect($response->data())->toBeArray();
});

test('send invoice by email', function () {
    $connector = new ZenfactuurConnector(
        token: $_ENV['ZENFACTUUR_API_TOKEN'] ?? null,
    );
    $request = new SendByEmailRequest(1944398, $_ENV['EMAIL_TO']);
    // $request->attachPdf(true);
    $response = $connector->send($request);

    expect($response->status())->toBe(200);
    expect($response->data())->toBeArray();
});

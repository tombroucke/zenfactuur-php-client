# Zenfactuur PHP Client

A PHP client library for consuming the Zenfactuur API. This library provides a simple and intuitive way to interact with Zenfactuur's invoicing and client management features.

## Installation

Install the package via Composer:

```bash
composer require tombroucke/zenfactuur-php-client
```

## Basic Usage

### Creating a Connector

```php
use Otomaties\Zenfactuur\ZenfactuurConnector;

$connector = new ZenfactuurConnector(
    token: 'your-api-token'
);
```

### API Token Validation

Verify your API token and get account information:

```php
use Otomaties\Zenfactuur\GetApiTokenRequest;

$request = new GetApiTokenRequest();
$response = $connector->send($request);

if ($response->successful()) {
    $data = $response->data();
    echo "Username: " . $data['username'];
}
```

## Client Management

### Get All Clients

```php
use Otomaties\Zenfactuur\Clients\GetClientsRequest;

// Get first page
$request = new GetClientsRequest();
$response = $connector->send($request);

// Get specific page
$requestPage2 = new GetClientsRequest();
$requestPage2->page(2);
$responsePage2 = $connector->send($requestPage2);
```

### Create a Client

```php
use Otomaties\Zenfactuur\Clients\CreateClientRequest;

$request = new CreateClientRequest([
    'type_id' => 0,
    'name' => 'John Doe',
    'email' => 'john@example.com',
]);

$response = $connector->send($request);

if ($response->status() === 201) {
    $client = $response->data();
    echo "Created client with ID: " . $client['id'];
}
```

### Find Clients

Search for clients by name or other criteria:

```php
use Otomaties\Zenfactuur\Clients\FindClientsRequest;

$request = new FindClientsRequest(query: 'John Doe');
$response = $connector->send($request);

$clients = $response->data();
```

### Update a Client

```php
use Otomaties\Zenfactuur\Clients\UpdateClientRequest;

$clientId = 123;
$updateData = [
    'name' => 'John Smith',
    'email' => 'johnsmith@example.com',
];

$request = new UpdateClientRequest($clientId, $updateData);
$response = $connector->send($request);
```

### Get Single Client

```php
use Otomaties\Zenfactuur\Clients\GetClientRequest;

$request = new GetClientRequest($clientId);
$response = $connector->send($request);
```

## Invoice Management

### Get All Invoices

```php
use Otomaties\Zenfactuur\Invoices\GetInvoicesRequest;

$request = new GetInvoicesRequest();
$response = $connector->send($request);

$invoices = $response->data();
```

### Get Unpaid Invoices

```php
use Otomaties\Zenfactuur\Invoices\GetUnpaidInvoicesRequest;

$request = new GetUnpaidInvoicesRequest();
$response = $connector->send($request);
```

### Create an Invoice

```php
use Otomaties\Zenfactuur\Invoices\CreateInvoiceRequest;

$request = new CreateInvoiceRequest([
    'client' => [
        'type_id' => 0,
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'street' => 'Main Street 123',
        'postcode' => '12345',
        'city' => 'Brussels',
        'country' => 'BE',
    ],
    'invoice' => [
        'date' => date('Y-m-d'),
        'internal_description' => 'Invoice for services',
        'vat_percentage' => 21,
        'pay_message' => true,
        'commercial_document_lines_attributes' => [
            [
                'description' => 'Web Development Services',
                'unit_price' => 75.00,
                'number_skus' => 10, // quantity
            ],
            [
                'description' => 'Hosting Services',
                'unit_price' => 25.00,
                'number_skus' => 1,
            ],
        ],
    ],
]);

$response = $connector->send($request);

if ($response->status() === 201) {
    $invoice = $response->data();
    echo "Created invoice with ID: " . $invoice['id'];
}
```

### Get Single Invoice

```php
use Otomaties\Zenfactuur\Invoices\GetInvoiceRequest;

$invoiceId = 123456;
$request = new GetInvoiceRequest($invoiceId);
$response = $connector->send($request);

$invoice = $response->data();
```

### Send Invoice by Email

Send an invoice to a recipient via email with optional attachments and customization:

```php
use Otomaties\Zenfactuur\Invoices\SendByEmailRequest;

$invoiceId = 123456;
$recipientEmail = 'client@example.com';

$request = new SendByEmailRequest($invoiceId, $recipientEmail);

// Optional: Add CC recipients
$request->cc('manager@example.com');

// Optional: Add BCC recipients
$request->bcc('accounting@example.com');

// Optional: Customize subject
$request->subject('Your Invoice from Company Name');

// Optional: Add custom email content
$request->content('Dear Client, please find your invoice attached. Thank you for your business!');

// Optional: Attach PDF version (default: true)
$request->attachPdf(true);

// Optional: Attach XML version (default: false)
$request->attachXml(true);

// Optional: Send reminder notification (default: false)
$request->sendReminder(true);

$response = $connector->send($request);

if ($response->successful()) {
    echo "Invoice sent successfully!";
}
```

#### Basic Email Send

For a simple email send with default settings:

```php
use Otomaties\Zenfactuur\Invoices\SendByEmailRequest;

$request = new SendByEmailRequest(123456, 'client@example.com');
$response = $connector->send($request);
```

### Send Invoice to Peppol

Send an invoice via the Peppol network for B2B electronic invoicing:

```php
use Otomaties\Zenfactuur\Invoices\SendToPeppolRequest;

$invoiceId = 123456;
$request = new SendToPeppolRequest($invoiceId);
$response = $connector->send($request);

if ($response->successful()) {
    echo "Invoice sent to Peppol network successfully!";
    $data = $response->data();
    // Handle response data as needed
}
```

**Note:** Peppol sending requires:

-   The client to have a valid Peppol participant ID
-   The invoice to be in a valid format for Peppol transmission
-   Your Zenfactuur account to have Peppol integration enabled

## Pagination

For endpoints that support pagination (like `GetClientsRequest`), you can specify the page:

```php
$request = new GetClientsRequest();
$request->page(2); // Get page 2
```

## Testing

Run the test suite:

```bash
composer test
```

The package includes comprehensive tests for all API endpoints. Make sure to set your `ZENFACTUUR_TOKEN` in a `.env` file before running tests.

## Requirements

-   PHP 8.0 or higher
-   Guzzle HTTP client
-   Fansipan HTTP client library

## License

This package is open-sourced software licensed under the MIT license.

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

---

For more information about the Zenfactuur API, please refer to their official documentation.

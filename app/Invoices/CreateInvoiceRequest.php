<?php

namespace Otomaties\Zenfactuur\Invoices;

use Fansipan\Body\AsJson;
use Fansipan\Request;

final class CreateInvoiceRequest extends Request
{
    use AsJson;

    public function __construct(private array $data)
    {
        //
    }

    public function method(): string
    {
        return 'POST';
    }

    public function endpoint(): string
    {
        return 'invoices.json';
    }

    protected function defaultBody()
    {
        return $this->data;
    }
}

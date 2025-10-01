<?php

namespace Otomaties\Zenfactuur\Invoices;

use Fansipan\Body\AsJson;
use Fansipan\Request;

final class GetInvoiceRequest extends Request
{
    use AsJson;

    public function __construct(private int $invoiceId)
    {
        //
    }

    public function endpoint(): string
    {
        return 'invoices/'.$this->invoiceId.'.json';
    }
}

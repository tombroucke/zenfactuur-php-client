<?php

namespace Otomaties\Zenfactuur\Invoices;

use Fansipan\Body\AsJson;
use Fansipan\Request;

final class SendToPeppolRequest extends Request
{
    use AsJson;

    public function __construct(private int $invoiceId)
    {
        //
    }

    public function method(): string
    {
        return 'POST';
    }

    public function endpoint(): string
    {
        return 'invoices/'.$this->invoiceId.'/send_to_peppol.json';
    }
}

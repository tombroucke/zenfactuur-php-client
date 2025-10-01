<?php

namespace Otomaties\Zenfactuur\Invoices;

use Fansipan\Body\AsJson;
use Otomaties\Zenfactuur\PaginatedRequest;

final class GetUnpaidInvoicesRequest extends PaginatedRequest
{
    use AsJson;

    public function endpoint(): string
    {
        return 'invoices/unpaid.json';
    }
}

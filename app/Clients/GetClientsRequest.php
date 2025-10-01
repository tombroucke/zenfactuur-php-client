<?php

namespace Otomaties\Zenfactuur\Clients;

use Fansipan\Body\AsJson;
use Otomaties\Zenfactuur\PaginatedRequest;

final class GetClientsRequest extends PaginatedRequest
{
    use AsJson;

    public function endpoint(): string
    {
        return 'clients.json';
    }
}

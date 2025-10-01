<?php

namespace Otomaties\Zenfactuur\Clients;

use Fansipan\Body\AsJson;
use Otomaties\Zenfactuur\PaginatedRequest;

final class FindClientsRequest extends PaginatedRequest
{
    use AsJson;

    public function __construct(private string $query, private ?string $phone = null)
    {
        //
    }

    public function endpoint(): string
    {
        return 'clients/search.json';
    }

    protected function defaultQuery(): array
    {
        $query = [
            'q' => $this->query,
            'page' => $this->page,
            'phone' => $this->phone,
        ];

        return array_filter($query);
    }
}

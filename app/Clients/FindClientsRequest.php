<?php

namespace Otomaties\Zenfactuur\Clients;

use Fansipan\Body\AsJson;
use Otomaties\Zenfactuur\PaginatedRequest;

final class FindClientsRequest extends PaginatedRequest
{
    use AsJson;

    private ?string $phone = null;

    public function __construct(private string $query)
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

    public function phone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }
}

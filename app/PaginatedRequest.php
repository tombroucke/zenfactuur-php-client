<?php

namespace Otomaties\Zenfactuur;

use Fansipan\Request;

abstract class PaginatedRequest extends Request
{
    protected ?int $page = null;

    public function page(int $page): static
    {
        $this->page = $page;

        return $this;
    }

    protected function defaultQuery(): array
    {
        $query = [
            'page' => $this->page,
        ];

        return array_filter($query);
    }
}

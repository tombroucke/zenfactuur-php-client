<?php

namespace Otomaties\Zenfactuur\Clients;

use Fansipan\Body\AsJson;
use Fansipan\Request;

final class CreateClientRequest extends Request
{
    use AsJson;

    public function __construct(private array $client)
    {
        //
    }

    public function method(): string
    {
        return 'POST';
    }

    public function endpoint(): string
    {
        return 'clients.json';
    }

    protected function defaultBody()
    {
        return ['client' => $this->client];
    }
}

<?php

namespace Otomaties\Zenfactuur\Clients;

use Fansipan\Body\AsJson;
use Fansipan\Request;

final class UpdateClientRequest extends Request
{
    use AsJson;

    public function __construct(private int $clientId, private array $client)
    {
        //
    }

    public function method(): string
    {
        return 'PUT';
    }

    public function endpoint(): string
    {
        return 'clients/'.$this->clientId.'.json';
    }

    protected function defaultBody()
    {
        return ['client' => $this->client];
    }
}

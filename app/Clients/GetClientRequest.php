<?php

namespace Otomaties\Zenfactuur\Clients;

use Fansipan\Body\AsJson;
use Fansipan\Request;

final class GetClientRequest extends Request
{
    use AsJson;

    public function __construct(private int $clientId)
    {
        //
    }

    public function endpoint(): string
    {
        return 'clients/'.$this->clientId.'.json';
    }
}

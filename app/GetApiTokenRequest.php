<?php

namespace Otomaties\Zenfactuur;

use Fansipan\Body\AsJson;
use Fansipan\Request;

final class GetApiTokenRequest extends Request
{
    use AsJson;

    public function endpoint(): string
    {
        return 'api_tokens.json';
    }
}

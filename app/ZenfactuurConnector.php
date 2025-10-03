<?php

namespace Otomaties\Zenfactuur;

use Fansipan\Authenticator\QueryAuthenticator;
use Fansipan\Contracts\ConnectorInterface;
use Fansipan\Middleware\Authentication;
use Fansipan\Traits\ConnectorTrait;

final class ZenfactuurConnector implements ConnectorInterface
{
    use ConnectorTrait;

    public function __construct(private string $token, private string $baseUri = 'https://app.zenfactuur.be/api/v2')
    {
        //
    }

    /**
     * @phpstan-ignore-next-line return.unusedType
     */
    public function baseUri(): ?string
    {
        return rtrim($this->baseUri, '/').'/';
    }

    protected function defaultMiddleware(): array
    {
        return [
            new Authentication(new QueryAuthenticator('token', $this->token)),
        ];
    }
}

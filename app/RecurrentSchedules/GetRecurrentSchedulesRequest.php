<?php

namespace Otomaties\Zenfactuur\RecurrentSchedules;

use Fansipan\Body\AsJson;
use Otomaties\Zenfactuur\PaginatedRequest;

final class GetRecurrentSchedulesRequest extends PaginatedRequest
{
    use AsJson;

    public function endpoint(): string
    {
        return 'recurrent_schedules.json';
    }
}

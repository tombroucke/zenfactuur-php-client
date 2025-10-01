<?php

namespace Otomaties\Zenfactuur\RecurrentSchedules;

use Fansipan\Body\AsJson;
use Fansipan\Request;

final class GetRecurrentScheduleRequest extends Request
{
    use AsJson;

    public function __construct(private int $recurrentScheduleId)
    {
        //
    }

    public function endpoint(): string
    {
        return 'recurrent_schedules/'.$this->recurrentScheduleId.'.json';
    }
}

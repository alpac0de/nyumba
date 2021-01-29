<?php

namespace App\Housing\Event;

use App\Entity\Housing;
use Symfony\Contracts\EventDispatcher\Event;

class HousingCreatedEvent extends Event
{
    private Housing $model;

    public function __construct(Housing $housing)
    {
        $this->model = $housing;
    }

    public function getModel(): Housing
    {
        return $this->model;
    }
}

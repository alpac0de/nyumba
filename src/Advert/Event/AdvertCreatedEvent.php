<?php

namespace App\Advert\Event;

use App\Entity\Advert;
use Symfony\Contracts\EventDispatcher\Event;

class AdvertCreatedEvent extends Event
{
    private Advert $model;

    public function __construct(Advert $housing)
    {
        $this->model = $housing;
    }

    public function getModel(): Advert
    {
        return $this->model;
    }
}

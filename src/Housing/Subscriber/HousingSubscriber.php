<?php

namespace App\Housing\Subscriber;

use App\Housing\Event\HousingCreatedEvent;
use MeiliSearch\Client;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Serializer\SerializerInterface;

class HousingSubscriber implements EventSubscriberInterface
{
    private Client $meiliSearchClient;
    private SerializerInterface $serializer;

    public function __construct(Client $meiliSearchClient, SerializerInterface $serializer)
    {
        $this->meiliSearchClient = $meiliSearchClient;
        $this->serializer = $serializer;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            HousingCreatedEvent::class => 'onCreateHousing',
        ];
    }

    public function onCreateHousing(HousingCreatedEvent $event)
    {
        $data = $this->serializer->norma($event->getModel(), 'json');
        $data = json_decode($data);
        $this->meiliSearchClient->getIndex('housings')->addDocuments([$data]);
    }
}

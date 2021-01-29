<?php

namespace App\Advert\Subscriber;

use App\Advert\Event\AdvertCreatedEvent;
use App\Entity\Advert;
use MeiliSearch\Client;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Serializer\SerializerInterface;

class AdvertiseSubscriber implements EventSubscriberInterface
{
    private Client $meiliSearchClient;
    private SerializerInterface $serializer;

    private $index;

    public function __construct(Client $meiliSearchClient, SerializerInterface $serializer)
    {
        $this->meiliSearchClient = $meiliSearchClient;
        $this->serializer = $serializer;
        $this->index = $this->meiliSearchClient->getIndex('advert');
    }

    public static function getSubscribedEvents(): array
    {
        return [
            AdvertCreatedEvent::class => 'onCreateAdvertise',
        ];
    }

    public function onCreateAdvertise(AdvertCreatedEvent $event): void
    {
        $data = $this->serializer->serialize($event->getModel(), 'json');
        $data = json_decode($data);

        $this->index->addDocuments([$data]);
    }
}

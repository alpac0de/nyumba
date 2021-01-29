<?php

namespace App\DataFixtures;

use App\Entity\Advert;
use App\Advert\Event\AdvertCreatedEvent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use MeiliSearch\Client;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class AppFixtures extends Fixture
{
    private EventDispatcherInterface $eventDispatcher;
    private Client $meiliSearchClient;

    public function __construct(EventDispatcherInterface $eventDispatcher, Client $meiliSearchClient)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->meiliSearchClient = $meiliSearchClient;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        try {
            $this->meiliSearchClient->deleteIndex('advert');
        } catch (\Exception $exception) { }

        $this->meiliSearchClient->createIndex('advert');

        foreach (range(1, 1000) as $item) {
            $advert = new Advert();
            $advert->setCurrentLocale('fr');
            $advert->setName($faker->name());
            $advert->setDescription($faker->text());

            $types = Advert::TYPES;
            $advert->setAddress($faker->address);
            $advert->setCountry($faker->country);
            $advert->setType($types[array_rand(Advert::TYPES, 1)]);
            $manager->persist($advert);

            $this->eventDispatcher->dispatch(new AdvertCreatedEvent($advert));
        }

        $manager->flush();
    }
}

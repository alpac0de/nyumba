<?php

namespace App\DataFixtures;

use App\Entity\Housing;
use App\Housing\Event\HousingCreatedEvent;
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
        $this->meiliSearchClient->deleteIndex('housings');
        $this->meiliSearchClient->createIndex('housings');

        foreach (range(1, 1000) as $item) {
            $housing = new Housing();
            $housing->setName($faker->name());
            $housing->setDescription($faker->text());

            $types = Housing::TYPES;
            $housing->setAddress($faker->address);
            $housing->setCountry($faker->country);
            $housing->setType($types[array_rand(Housing::TYPES, 1)]);
            $manager->persist($housing);

            $this->eventDispatcher->dispatch(new HousingCreatedEvent($housing));
        }

        $manager->flush();
    }
}

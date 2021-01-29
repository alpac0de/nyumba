<?php

namespace App\Housing\Infrastructure\ApiPlatform\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use App\Housing\Model\Housing;
use MeiliSearch\Client;
use Symfony\Component\Serializer\SerializerInterface;

class HousingDataProvider implements ContextAwareCollectionDataProviderInterface
{
    private Client $meiliSearchClient;
    private SerializerInterface $serializer;

    public function __construct(Client $meiliSearchClient, SerializerInterface $serializer)
    {
        $this->meiliSearchClient = $meiliSearchClient;
        $this->serializer = $serializer;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Housing::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        foreach ($this->meiliSearchClient->getIndex('housings')->getDocuments() as $data) {
            $data = json_encode($data);

            yield $this->serializer->deserialize($data, Housing::class, 'json');
        }
    }
}

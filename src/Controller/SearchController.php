<?php

declare(strict_types=1);

namespace App\Controller;

use MeiliSearch\Client;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/search', name: 'search')]
class SearchController
{
    public function __invoke(Client $client, SerializerInterface $serializer): Response
    {
        $documents = $client->getIndex('advert')->getDocuments();

        return new JsonResponse($documents);
    }
}

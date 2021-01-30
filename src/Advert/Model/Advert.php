<?php

namespace App\Advert\Model;

use ApiPlatform\Core\Annotation\ApiResource;

#[ApiResource(
    collectionOperations: ['get'],
    itemOperations: ['get'],
)]
class Advert
{
    public string $id;
    public \DateTimeInterface $createdAt;
    public ?\DateTimeInterface $updatedAt = null;
    public string $type;
    public string $address;
    public string $price = '500€';
    public string $cover;
}

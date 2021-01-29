<?php

namespace App\Entity;

use App\Repository\AdvertRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\UuidV4;

/**
 * @ORM\Entity(repositoryClass=AdvertRepository::class)
 */
class Advert
{
    use TranslatableTrait {
        __construct as private initializeTranslationsCollection;
    }
    public const TYPES = [
        'apartment',
        'house',
    ];

    /**
     * @ORM\Id
     * @ORM\Column(type="string", nullable=false)
     */
    private string $id;

    /**
     * @ORM\Column(type="datetimetz_immutable", nullable=false)
     */
    private \DateTimeInterface $createdAt;

    /**
     * @ORM\Column(type="datetimetz", length=255, nullable=true)
     */
    private ?\DateTimeInterface $updatedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private string $type;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private string $address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $country;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $description;

    public function __construct()
    {
        $this->id = (string) new UuidV4();
        $this->createdAt = new \DateTimeImmutable();
        $this->initializeTranslationsCollection();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCreatedAt(): \DateTimeImmutable | \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable | \DateTimeInterface $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getName(): ?string
    {
        return $this->getTranslation()->getName();
    }

    public function setName(string $name): void
    {
        $this->getTranslation()->setName($name);
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function getDescription(): ?string
    {
        return $this->getTranslation()->getDescription();
    }

    public function setDescription(?string $description): void
    {
        $this->getTranslation()->setDescription($description);
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function createTranslation(): AdvertTranslation
    {
        return new AdvertTranslation();
    }
}

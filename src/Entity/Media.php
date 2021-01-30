<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\UuidV4;

/**
 * @ORM\Entity(repositoryClass=MediaRepository::class)
 */
class Media
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", nullable=false)
     */
    private string $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private string $name;

    /**
     * @ORM\Column(type="datetimetz_immutable", nullable=false)
     */
    private \DateTimeInterface $createdAt;

    /**
     * @ORM\Column(type="datetimetz", nullable=true)
     */
    private \DateTimeInterface $updatedAt;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private string $path;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private array $options;

    /**
     * @ORM\ManyToOne(targetEntity=Advert::class, inversedBy="media")
     */
    private Advert $advert;

    public function __construct()
    {
        $this->id = (string) new UuidV4();
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): \DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function addOption(string $name, $value)
    {
        $this->options[$name] = $value;
    }
}

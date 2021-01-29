<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\UuidV4;

/**
 * @ORM\Entity()
 */
class AdvertTranslation
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", nullable=false)
     */
    private string $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private string $locale;

    /**
     * @ORM\Column(type="string")
     */
    private string $name;

    /**
     * @ORM\Column(type="text")
     */
    private string $description;

    public function __construct()
    {
        $this->id = (string) new UuidV4();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): void
    {
        $this->locale = $locale;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}

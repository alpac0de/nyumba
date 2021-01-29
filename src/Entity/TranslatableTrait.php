<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

trait TranslatableTrait
{
    protected string $currentLocale;
    protected ArrayCollection $translations;
    protected $translationsCache;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->translationsCache = [];
    }

    public function setCurrentLocale(string $currentLocale): void
    {
        $this->currentLocale = $currentLocale;
    }

    protected function getTranslation(?string $locale = null)
    {
        $locale = $locale ?: $this->currentLocale;

        if (isset($this->translatationsCache[$locale])) {
            return $this->translationsCache[$locale];
        }

        $translation = $this->translations->get($locale);
        if (null !== $translation) {
            $this->translationsCache[$locale] = $translation;

            return $translation;
        }

        $translation = $this->createTranslation();
        $translation->setLocale($locale);

        $this->translations->set($locale, $translation);

        return $translation;
    }

    public function getTranslations(): ArrayCollection
    {
        return $this->translations;
    }
}

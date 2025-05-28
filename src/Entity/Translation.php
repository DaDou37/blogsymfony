<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TranslationRepository;

#[ORM\Table('toto')]
#[ORM\Entity(repositoryClass: TranslationRepository::class)]
class Translation
{
    #[ORM\Id]
    #[ORM\GeneratedValue()]
    #[ORM\Column]
    private ?int $id;

    #[ORM\Column(length: 255, name: '`key`')]
    private ?string $translationKey;

    #[ORM\Column(length: 5)]
    private ?string $local;

    #[ORM\Column(type: 'text')]
    private ?string $translation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTranslationKey(): ?string
    {
        return $this->translationKey;
    }

    public function setTranslationKey(string $translationKey): static
    {
        $this->translationKey = $translationKey;

        return $this;
    }

    public function getLocal(): ?string
    {
        return $this->local;
    }

    public function setLocal(string $local): static
    {
        $this->local = $local;

        return $this;
    }

    public function getTranslation(): ?string
    {
        return $this->translation;
    }

    public function setTranslation(string $translation): static
    {
        $this->translation = $translation;

        return $this;
    } 

}
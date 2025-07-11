<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait DateTraits
{

    #[ORM\Column(type: 'datetime_immutable', options:['default' => 'CURRENT_TIMESTAMP'], nullable: true)]
    private ?\DateTimeImmutable $createdAt;
    
    #[ORM\Column(type: 'datetime_immutable', options:['default' => 'CURRENT_TIMESTAMP'], nullable: true)]
    private ?\DateTimeImmutable $updatedAt;


    public function getUpdatedAt():\DateTimeImmutable
    {
        return $this->updatedAt;
    }


    #[ORM\PreUpdate]
    public function setUpdatedAt($updatedAt): void
    {
        $this->updatedAt = new \DateTimeImmutable;
    }

    public function getCreatedAt():\DateTimeImmutable
    {
        return $this->createdAt;
    }

    #[ORM\PostPersist]
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = new \DateTimeImmutable;
    }
}
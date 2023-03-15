<?php

namespace App\Entity\Requests;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

trait Timestamps
{

    #[ORM\Column(name:"created_at", type:"datetime", nullable:true)]
    private $createdAt;

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTimeInterface $timestamp): self
    {
        $this->createdAt = $timestamp;
        return $this;
    }

    #[ORM\PrePersist]
    public function setCreatedAtAutomatically()
    {
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new \DateTime());
        }
    }
}
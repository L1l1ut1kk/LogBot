<?php

namespace App\Entity\Stations;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\User\User;

#[ApiResource]

#[ORM\Entity]
class Station 
{ 

    public function __construct()
    {
        $this->user = new ArrayCollection();
    }

    #[ORM\Id]
    #[ORM\Column (type: "integer")]
    #[ORM\GeneratedValue (strategy: "AUTO")]
    private int $id;

    #[ORM\Column (type: 'integer', unique:true)]
    public int $stationId;

    #[ORM\Column (type: 'string', nullable: false)]
    public string $name;

    #[ORM\OneToMany(targetEntity: User::class, mappedBy: "stations")]
    private $user;

    public function getUser(): Collection
    {
        return $this->user;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
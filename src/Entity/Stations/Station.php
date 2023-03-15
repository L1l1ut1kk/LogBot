<?php

namespace App\Entity\Stations;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]

#[ORM\Entity]
class Station 
{ 
    #[ORM\Id]
    #[ORM\Column (type: "integer")]
    #[ORM\GeneratedValue (strategy: "AUTO")]
    private int $id;

    #[ORM\Column (type: 'integer', unique:true)]
    public int $station_id;

    #[ORM\Column (type: 'string', nullable: false)]
    public string $name;

    public function getId(): ?int
    {
        return $this->id;
    }
}
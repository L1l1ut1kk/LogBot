<?php

namespace App\Entity\Requests;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]

#[ORM\Entity]
class Request 
{ 
    use Timestamps;

    #[ORM\Id]
    #[ORM\Column (type: "integer")]
    #[ORM\GeneratedValue (strategy: "AUTO")]
    private int $id;

    #[ORM\Column (type: 'integer', nullable: false)]
    public int $where_to;

    #[ORM\Column (type: 'integer', nullable: false)]
    public int $whither;

    #[ORM\Column (type: 'integer', nullable: false)]
    public int $destination;

    #[ORM\Column (type: 'integer', nullable: false)]
    public int $sender;

    #[ORM\Column (type: 'integer')]
    public int $robot_id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
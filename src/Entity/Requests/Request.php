<?php

namespace App\Entity\Requests;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\User\User;
use App\Entity\Stations\Station;
use App\Entity\Robots\Robot;

#[ApiResource]

#[ORM\Entity]
class Request 
{ 
    public const REQUEST_STATUS_ON_CONFIRMATION = 0;
    public const REQUEST_STATUS_CONFIRMED = 1;
    public const REQUEST_STATUS_IN_PROCESS = 2;
    public const REQUEST_STATUS_DONE = 3;

    use Timestamps;

    #[ORM\Id]
    #[ORM\Column (type: "integer")]
    #[ORM\GeneratedValue (strategy: "AUTO")]
    private int $id;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $requestStatus;

    #[ORM\ManyToOne(targetEntity: Robot::class, inversedBy: "robot")]
    private $robot_id;

    public function getRobotId(): ?Robot
    {
        return $this->robot_id;
    }

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: "destinations")]
    private $users_dest;

    public function getUserDest(): ?User
    {
        return $this->users_dest;
    }

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: "sender")]
    private $users_sender;

    public function getUserSend(): ?User
    {
        return $this->users_sender;
    }

    #[ORM\ManyToOne(targetEntity: Station::class, inversedBy: "station1")]
    private $whereTo;

    public function getWhereTo(): ?Station
    {
        return $this->whereTo;
    }

    #[ORM\ManyToOne(targetEntity: Station::class, inversedBy: "station2")]
    private $whitherTo;

    public function getWhitherTo(): ?Station
    {
        return $this->whitherTo;
    }

    

    public function getId(): ?int
    {
        return $this->id;
    }
}
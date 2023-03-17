<?php

namespace App\Entity\User;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Controller\User\RegistrationController;
use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Stations\Station;
use App\Entity\Requests\Request;
use App\Entity\Robots\Robot;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ApiResource(
    operations: [
        new Post(
            uriTemplate: '/user/registration',
            controller: RegistrationController::class,
            deserialize: false,
            name: 'Registration'
        ),
        new GetCollection()
    ]
)]
#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements  UserInterface, PasswordAuthenticatedUserInterface
{
    public const ROLE_ADMIN = 0;
    public const ROLE_SUPERUSER = 1;
    public const ROLE_USER = 2;

    public function __construct()
    {
        $this->stationBossId = new ArrayCollection();
        $this->robotBoss = new ArrayCollection();
        $this->destinations = new ArrayCollection();
        $this->sender = new ArrayCollection();

    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: Types::TEXT, nullable: false)]
    public string $name;

    #[ORM\Column(type: Types::TEXT, nullable: false)]
    public string $surname;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    public ?string $patronymic = null;

    #[ORM\Column(length: 15, nullable: false)]
    private string $login;

    #[ORM\Column(nullable: false)]
    private string $password;

    #[ORM\Column(type: 'array')]
    public array $roles;

    #[ORM\OneToMany(targetEntity: Station::class, mappedBy: "stationsBoss")]
    private $stationBossId;

    public function getStationBossId(): Collection
    {
        return $this->stationBossId;
    }

    public function setStationBossId(?Station $station): self
    {
        $this->stationBossId = $station;

        return $this;
    }

    #[ORM\OneToMany(targetEntity: Robot::class, mappedBy: "robotBossId")]
    private $robotBoss;

    public function getRobotBoss(): Collection
    {
        return $this->robotBoss;
    }

    public function setRobotBoss(?Robot $robot): self
    {
        $this->robotBoss = $robot;

        return $this;
    }

    #[ORM\OneToMany(targetEntity: Request::class, mappedBy: "users_dest")]
    private $destinations;

    public function getDest(): Collection
    {
        return $this->destinations;
    }

    public function setDest(?Request $request): self
    {
        $this->destinations = $request;

        return $this;
    }

    #[ORM\OneToMany(targetEntity: Request::class, mappedBy: "users_sender")]
    private $sender;

    public function getSender(): Collection
    {
        return $this->sender;
    }

    public function setSender(?Request $request): self
    {
        $this->sender = $request;

        return $this;
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }


    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     *
     * @return void
     */
    public function eraseCredentials()
    {

    }

    /**
     * Returns the identifier for this user (e.g. username or email address).
     */
    public function getUserIdentifier(): string
    {
        return $this->id;
    }

}
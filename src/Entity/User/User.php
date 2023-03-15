<?php

namespace App\Entity\User;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\User\RegistrationUserController;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Stations\Station;
use ApiPlatform\Metadata\Post;

#[ApiResource]
#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    public const ROLE_ADMIN = 0;
    public const ROLE_SUPERUSER = 1;
    public const ROLE_USER = 2;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: "user")]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: false)]
    public string $name;

    #[ORM\Column(type: Types::TEXT, nullable: false)]
    public string $surname;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    public ?string $patronymic = null;

    #[ORM\Column(length: 15, nullable: false)]
    private ?string $login;

    #[ORM\Column(nullable: false)]
    private string $password;

    #[ORM\Column(type: 'array')]
    private array $roles;

    #[ORM\Column(nullable: true)]
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: "user")]
    private ?int $bossId = null;

    #[ORM\ManyToOne(targetEntity: Station::class, inversedBy: "user")]
    private $stations;

    public function getStation(): ?Station
    {
        return $this->stations;
    }

    public function setStation(?Station $station): self
    {
        $this->stations = $station;

        return $this;
    }

    public function getId(): ?int
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

    public function getBossId(): ?int
    {
        return $this->bossId;
    }

    public function setBossId(?int $bossId): self
    {
        $this->bossId = $bossId;

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
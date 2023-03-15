<?php
namespace App\Entity\Robots;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Boolean;

#[ApiResource] 
#[ORM\Entity]
class Robot{
    public const ROBOT_STATUS_ON_CONFIRMATION = 0;
    public const ROBOT_STATUS_CONFIRMED = 1;
    public const ROBOT_STATUS_IN_PROCESS = 2;
    public const ROBOT_STATUS_DONE = 3;

     #[ORM\Id]
     #[ORM\Column(type: "integer")]
     #[ORM\GeneratedValue (strategy: 'AUTO')]
     private int $id;

    #[ORM\Column(type: "integer")]
    private int $boss_id;

    #[ORM\Column(type: "text")]
    private string $location;

    #[ORM\Column(type:"string", length: 255)]
    private string $charge;


    #[ORM\Column(type: "integer")]
    private int $status;

    #[ORM\Column(type: "integer")]
    private int $en_dis;




    /**
     * @return int
     */
    public function getBossId(): int
    {
        return $this->boss_id;
    }

    /**
     * @param int $boss_id
     */
    public function setBossId(int $boss_id): void
    {
        $this->boss_id = $boss_id;
    }

    public function getId(): ?int{
        return $this->id;
    }

    public function getLocation(): ?string{
        return $this->location;
    }
    public function setLocation(string $location): self{
        $this->location = $location;
        return $this;
    }
    public function getCharge(): ?string{
        return $this->charge;
    }
    public function setCharge(string $charge): self{
        $this->charge = $charge;
        return $this;
    }
    public function getStatus(): ?string{
        return $this->status;
    }
    public function setStatus(string $status): self{
        $this->status = $status;
        return $this;
    }
    public function getEnDis(): ?int{
        return $this->en_dis;
    }

    public function setEnDis(int $en_dis): self{
        $this->en_dis = $en_dis;
        return $this;
    }
}
?>
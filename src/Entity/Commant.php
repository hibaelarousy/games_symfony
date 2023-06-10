<?php

namespace App\Entity;

use App\Repository\CommantRepository;
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommantRepository::class)]
class Commant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'commants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?users $user = null;

    #[ORM\Column(length: 255)]
    private ?string $message = null;

    // #[ORM\Column (type:'datetime',options:['default'=>'CURRENT_TIMESTAMP'])]
    // private  ?DateTime $date;

    #[ORM\ManyToOne(inversedBy: 'commant')]
    private ?Games $games = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?users
    {
        return $this->user;
    }

    public function setUser(?users $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    // public function getDate(): ?\DateTimeImmutable
    // {
    //     return $this->date;
    // }

    // public function setDate(\DateTimeImmutable $date): self
    // {
    //     $this->date = $date;

    //     return $this;
    // }

    public function getGames(): ?Games
    {
        return $this->games;
    }

    public function setGames(?Games $games): self
    {
        $this->games = $games;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}

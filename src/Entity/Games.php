<?php

namespace App\Entity;

use App\Repository\GamesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GamesRepository::class)]
class Games
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $seen = null;

    #[ORM\OneToMany(mappedBy: 'games', targetEntity: commant::class)]
    private Collection $commant;

    public function __construct()
    {
        $this->commant = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSeen(): ?int
    {
        return $this->seen;
    }

    public function setSeen(?int $seen): self
    {
        $this->seen = $seen;

        return $this;
    }

    /**
     * @return Collection<int, commant>
     */
    public function getCommant(): Collection
    {
        return $this->commant;
    }

    public function addCommant(commant $commant): self
    {
        if (!$this->commant->contains($commant)) {
            $this->commant->add($commant);
            $commant->setGames($this);
        }

        return $this;
    }

    public function removeCommant(commant $commant): self
    {
        if ($this->commant->removeElement($commant)) {
            // set the owning side to null (unless already changed)
            if ($commant->getGames() === $this) {
                $commant->setGames(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }
}

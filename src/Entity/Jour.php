<?php

namespace App\Entity;

use App\Repository\JourRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JourRepository::class)
 */
class Jour
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $idjour;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libjour;

    /**
     * @ORM\OneToMany(targetEntity=Programmation::class, mappedBy="jour", orphanRemoval=true)
     */
    private $programmations;

    public function __construct()
    {
        $this->programmations = new ArrayCollection();
    }

   

    public function getId(): ?int
    {
        return $this->idjour;
    }

    public function getLibjour(): ?string
    {
        return $this->libjour;
    }

    public function setLibjour(string $libjour): self
    {
        $this->libjour = $libjour;

        return $this;
    }

    /**
     * @return Collection|Programmation[]
     */
    public function getProgrammations(): Collection
    {
        return $this->programmations;
    }

    public function addProgrammation(Programmation $programmation): self
    {
        if (!$this->programmations->contains($programmation)) {
            $this->programmations[] = $programmation;
            $programmation->setJour($this);
        }

        return $this;
    }

    public function removeProgrammation(Programmation $programmation): self
    {
        if ($this->programmations->removeElement($programmation)) {
            // set the owning side to null (unless already changed)
            if ($programmation->getJour() === $this) {
                $programmation->setJour(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->libjour;
    }

}

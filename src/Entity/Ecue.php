<?php

namespace App\Entity;

use App\Repository\EcueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EcueRepository::class)
 */
class Ecue
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $idecue;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Ue::class, inversedBy="ecue")
     * @ORM\JoinColumn(nullable=false,referencedColumnName="idue")
     */
    private $ue;

    /**
     * @ORM\OneToOne(targetEntity=MatiereEnseigner::class, mappedBy="ecue", cascade={"persist", "remove"})
     */
    private $matiereEnseigner;

    /**
     * @ORM\OneToMany(targetEntity=Programmation::class, mappedBy="ecue", orphanRemoval=true)
     */
    private $programmations;

    public function __construct()
    {
        $this->programmations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->idecue;
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

    public function getUe(): ?Ue
    {
        return $this->ue;
    }

    public function setUe(?Ue $ue): self
    {
        $this->ue = $ue;

        return $this;
    }

    public function getMatiereEnseigner(): ?MatiereEnseigner
    {
        return $this->matiereEnseigner;
    }

    public function setMatiereEnseigner(MatiereEnseigner $matiereEnseigner): self
    {
        // set the owning side of the relation if necessary
        if ($matiereEnseigner->getEcue() !== $this) {
            $matiereEnseigner->setEcue($this);
        }

        $this->matiereEnseigner = $matiereEnseigner;

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
            $programmation->setEcue($this);
        }

        return $this;
    }

    public function removeProgrammation(Programmation $programmation): self
    {
        if ($this->programmations->removeElement($programmation)) {
            // set the owning side to null (unless already changed)
            if ($programmation->getEcue() === $this) {
                $programmation->setEcue(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
         return $this->name;
    }
}

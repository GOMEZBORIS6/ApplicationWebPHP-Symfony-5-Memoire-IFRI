<?php

namespace App\Entity;

use App\Repository\ClasseetudiantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ClasseetudiantRepository::class)
 */
class Classeetudiant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $idclass;

    /**
     * @ORM\ManyToOne(targetEntity=Niveau::class, inversedBy="classeetudiant")
     * @ORM\JoinColumn(nullable=false, referencedColumnName="idniveau")
     */
    private $niveau;

    /**
     * @ORM\ManyToOne(targetEntity=Filiere::class, inversedBy="classeetudiant")
     * @ORM\JoinColumn(nullable=false, referencedColumnName="idfiliere")
     */
    private $filiere;

    /**
     * @ORM\OneToMany(targetEntity=Programmation::class, mappedBy="classeetudiant", orphanRemoval=true)
     */
    private $programmations;

    /**
     * @ORM\OneToMany(targetEntity=Ue::class, mappedBy="classeetudiant", orphanRemoval=true)
     */
    private $ue;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    public function __construct()
    {
        $this->programmations = new ArrayCollection();
        $this->ue = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->idclass;
    }

    public function getNiveau(): ?Niveau
    {
        return $this->niveau;
    }

    public function setNiveau(?Niveau $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getFiliere(): ?Filiere
    {
        return $this->filiere;
    }

    public function setFiliere(?Filiere $filiere): self
    {
        $this->filiere = $filiere;

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
            $programmation->setClasseetudiant($this);
        }

        return $this;
    }

    public function removeProgrammation(Programmation $programmation): self
    {
        if ($this->programmations->removeElement($programmation)) {
            // set the owning side to null (unless already changed)
            if ($programmation->getClasseetudiant() === $this) {
                $programmation->setClasseetudiant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ue[]
     */
    public function getUe(): Collection
    {
        return $this->ue;
    }

    public function addUe(ue $ue): self
    {
        if (!$this->ue->contains($ue)) {
            $this->ue[] = $ue;
            $ue->setClasseetudiant($this);
        }

        return $this;
    }

    public function removeUe(ue $ue): self
    {
        if ($this->ue->removeElement($ue)) {
            // set the owning side to null (unless already changed)
            if ($ue->getClasseetudiant() === $this) {
                $ue->setClasseetudiant(null);
            }
        }

        return $this;
    }

   
   
      public function __toString()
     {
        return $this->name;
       //  return $this->getFiliere()->getLibfiliere() . " " . $this->getNiveau()->getLibniveau();
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

}

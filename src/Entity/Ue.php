<?php

namespace App\Entity;

use App\Repository\UeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UeRepository::class)
 */
class Ue
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $idue;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Ecue::class, mappedBy="ue", orphanRemoval=true)
     */
    private $ecue;

    /**
     * @ORM\ManyToOne(targetEntity=Classeetudiant::class, inversedBy="ue")
     * @ORM\JoinColumn(nullable=false, referencedColumnName="idclass" )
     */
    private $classeetudiant;



    public function __construct()
    {
        $this->ecue = new ArrayCollection();
        $this->ueclass = new ArrayCollection();
        $this->classeetudiants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->idue;
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

    /**
     * @return Collection|ecue[]
     */
    public function getEcue(): Collection
    {
        return $this->ecue;
    }

    public function addEcue(ecue $ecue): self
    {
        if (!$this->ecue->contains($ecue)) {
            $this->ecue[] = $ecue;
            $ecue->setUe($this);
        }

        return $this;
    }

    public function removeEcue(ecue $ecue): self
    {
        if ($this->ecue->removeElement($ecue)) {
            // set the owning side to null (unless already changed)
            if ($ecue->getUe() === $this) {
                $ecue->setUe(null);
            }
        }

        return $this;
    }

    public function getClasseetudiant(): ?Classeetudiant
    {
        return $this->classeetudiant;
    }

    public function setClasseetudiant(?Classeetudiant $classeetudiant): self
    {
        $this->classeetudiant = $classeetudiant;

        return $this;
    }

     public function __toString()
     {
        return $this->name;
    }
  
}

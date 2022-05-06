<?php

namespace App\Entity;

use App\Repository\FiliereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FiliereRepository::class)
 */
class Filiere
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $idfiliere;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libfiliere;

    /**
     * @ORM\OneToMany(targetEntity=Classeetudiant::class, mappedBy="filiere", orphanRemoval=true)
     */
    private $classeetudiant;

    public function __construct()
    {
        $this->classeetudiant = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->idfiliere;
    }

    public function getLibfiliere(): ?string
    {
        return $this->libfiliere;
    }

    public function setLibfiliere(string $libfiliere): self
    {
        $this->libfiliere = $libfiliere;

        return $this;
    }

    /**
     * @return Collection|classeetudiant[]
     */
    public function getClasseetudiant(): Collection
    {
        return $this->classeetudiant;
    }

    public function addClasseetudiant(classeetudiant $classeetudiant): self
    {
        if (!$this->classeetudiant->contains($classeetudiant)) {
            $this->classeetudiant[] = $classeetudiant;
            $classeetudiant->setFiliere($this);
        }

        return $this;
    }

    public function removeClasseetudiant(classeetudiant $classeetudiant): self
    {
        if ($this->classeetudiant->removeElement($classeetudiant)) {
            // set the owning side to null (unless already changed)
            if ($classeetudiant->getFiliere() === $this) {
                $classeetudiant->setFiliere(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->libfiliere;
    }
}

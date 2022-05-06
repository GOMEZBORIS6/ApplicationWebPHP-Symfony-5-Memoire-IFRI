<?php

namespace App\Entity;

use App\Repository\NiveauRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NiveauRepository::class)
 */
class Niveau
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $idniveau;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libniveau;

    /**
     * @ORM\OneToMany(targetEntity=Classeetudiant::class, mappedBy="niveau", orphanRemoval=true)
     */
    private $classeetudiant;

    public function __construct()
    {
        $this->classeetudiant = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->idniveau;
    }

    public function getLibniveau(): ?string
    {
        return $this->libniveau;
    }

    public function setLibniveau(string $libniveau): self
    {
        $this->libniveau = $libniveau;

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
            $classeetudiant->setNiveau($this);
        }

        return $this;
    }

    public function removeClasseetudiant(classeetudiant $classeetudiant): self
    {
        if ($this->classeetudiant->removeElement($classeetudiant)) {
            // set the owning side to null (unless already changed)
            if ($classeetudiant->getNiveau() === $this) {
                $classeetudiant->setNiveau(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->libniveau;
    }
}

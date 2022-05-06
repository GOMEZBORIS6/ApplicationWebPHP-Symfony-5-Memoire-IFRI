<?php

namespace App\Entity;

use App\Repository\MatiereEnseignerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MatiereEnseignerRepository::class)
 */
class MatiereEnseigner
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $idmatensgn;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libmatenseign;

    /**
     * @ORM\OneToOne(targetEntity=Ecue::class, inversedBy="matiereEnseigner", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false, referencedColumnName="idecue")
     */
    private $ecue;

    

    public function getId(): ?int
    {
        return $this->idmatensgn;
    }

    public function getLibmatenseign(): ?string
    {
        return $this->libmatenseign;
    }

    public function setLibmatenseign(string $libmatenseign): self
    {
        $this->libmatenseign = $libmatenseign;

        return $this;
    }

    public function getEcue(): ?ecue
    {
        return $this->ecue;
    }

    public function setEcue(ecue $ecue): self
    {
        $this->ecue = $ecue;

        return $this;
    }

   
}


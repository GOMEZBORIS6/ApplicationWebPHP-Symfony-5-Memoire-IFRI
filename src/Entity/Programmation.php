<?php

namespace App\Entity;

use App\Entity\Traits\Timestampable;
use App\Repository\ProgrammationRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProgrammationRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class Programmation
{
    use Timestampable;

    //public const NUM_ITEMS_PER_PAGE = 3;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $idprog;


    /**
     * @ORM\Column(type="time")
     */
    private $heuredeb;

    /**
     * @ORM\Column(type="time")
     */
    private $heurefin;


    /**
     * @ORM\Column(type="date")
     */
    private $semainedeb;

    /**
     * @ORM\Column(type="date")
     * 
     */
    private $semainefin;

    /**
     * @ORM\ManyToOne(targetEntity=Ecue::class, inversedBy="programmations")
     * @ORM\JoinColumn(nullable=false, referencedColumnName="idecue")
     *@Assert\NotBlank
     */
    private $ecue;

    /**
     * @ORM\ManyToOne(targetEntity=Classeetudiant::class, inversedBy="programmations")
     * @ORM\JoinColumn(nullable=false, referencedColumnName="idclass")
     * 
     */
    private $classeetudiant;

    /**
     * @ORM\ManyToOne(targetEntity=Jour::class, inversedBy="programmations")
     * @ORM\JoinColumn(nullable=false, referencedColumnName="idjour")
     * 
     */
    private $jour;


    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="programmations")
     * @ORM\JoinColumn(nullable=false, referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $salle;


    public function getId(): ?int
    {
        return $this->idprog;
    }


    public function getHeuredeb(): ?\DateTimeInterface
    {
        return $this->heuredeb;
    }

    public function setHeuredeb( $heuredeb): self
    {
        $this->heuredeb = $heuredeb;

        return $this;
    }

    public function getHeurefin(): ?\DateTimeInterface
    {
        return $this->heurefin;
    }

    public function setHeurefin( $heurefin): self
    {
        $this->heurefin = $heurefin;

        return $this;
    }

    public function getSemainedeb(): ?\DateTimeInterface
    {
        return $this->semainedeb;
    }

    public function setSemainedeb($semainedeb): self
    {
        $this->semainedeb = $semainedeb;

        return $this;
    }

    public function getSemainefin(): ?\DateTimeInterface
    {
        return $this->semainefin;
    }

    public function setSemainefin( $semainefin): self
    {
        $this->semainefin = $semainefin;

        return $this;
    }

    public function getEcue(): ?ecue
    {
        return $this->ecue;
    }

    public function setEcue(?ecue $ecue): self
    {
        $this->ecue = $ecue;

        return $this;
    }

    public function getClasseetudiant(): ?classeetudiant
    {
        return $this->classeetudiant;
    }

    public function setClasseetudiant(?classeetudiant $classeetudiant): self
    {
        $this->classeetudiant = $classeetudiant;

        return $this;
    }

    public function getJour(): ?jour
    {
        return $this->jour;
    }

    public function setJour(?jour $jour): self
    {
        $this->jour = $jour;

        return $this;
    }


    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getSalle(): ?string
    {
        return $this->salle;
    }

    public function setSalle(?string $salle): self
    {
        $this->salle = $salle;

        return $this;
    }

   
}

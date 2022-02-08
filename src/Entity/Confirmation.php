<?php

namespace App\Entity;

use App\Repository\ConfirmationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConfirmationRepository::class)
 */
class Confirmation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Entretien::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Entretien;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Titre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntretien(): ?Entretien
    {
        return $this->Entretien;
    }

    public function setEntretien(Entretien $Entretien): self
    {
        $this->Entretien = $Entretien;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(?string $Titre): self
    {
        $this->Titre = $Titre;

        return $this;
    }
    public function __toString()
    {
        return $this->Titre;
    }
}

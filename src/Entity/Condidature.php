<?php

namespace App\Entity;
use App\Entity\User;
use App\Repository\CondidatureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CondidatureRepository::class)
 */
class Condidature
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NomCondidat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $PrenomCondidat;

    /**
     * @ORM\Column(type="integer")
     */
    private $AgeCondidat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NumTelCondidat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $MailCondidat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $AdressVille;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $LienLinkedin;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $LienGithub;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CvCondidat;

    /**
     * @ORM\ManyToOne(targetEntity=Annonce::class, inversedBy="IdCondidature")
     * @ORM\JoinColumn(nullable=false)
     */
    private $IdAnnonce;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="IdCondidature")
     * @ORM\JoinColumn(nullable=false)
     */
    private $IdCondidat;

    /**
     * @ORM\OneToOne(targetEntity=Entretien::class, mappedBy="IdCondidature", cascade={"persist", "remove"})
     */
    private $IdEntretien;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCondidat(): ?string
    {
        return $this->NomCondidat;
    }

    public function setNomCondidat(string $NomCondidat): self
    {
        $this->NomCondidat = $NomCondidat;

        return $this;
    }

    public function getPrenomCondidat(): ?string
    {
        return $this->PrenomCondidat;
    }

    public function setPrenomCondidat(string $PrenomCondidat): self
    {
        $this->PrenomCondidat = $PrenomCondidat;

        return $this;
    }

    public function getAgeCondidat(): ?int
    {
        return $this->AgeCondidat;
    }

    public function setAgeCondidat(int $AgeCondidat): self
    {
        $this->AgeCondidat = $AgeCondidat;

        return $this;
    }

    public function getNumTelCondidat(): ?string
    {
        return $this->NumTelCondidat;
    }

    public function setNumTelCondidat(string $NumTelCondidat): self
    {
        $this->NumTelCondidat = $NumTelCondidat;

        return $this;
    }

    public function getMailCondidat(): ?string
    {
        return $this->MailCondidat;
    }

    public function setMailCondidat(string $MailCondidat): self
    {
        $this->MailCondidat = $MailCondidat;

        return $this;
    }

    public function getAdressVille(): ?string
    {
        return $this->AdressVille;
    }

    public function setAdressVille(string $AdressVille): self
    {
        $this->AdressVille = $AdressVille;

        return $this;
    }

    public function getLienLinkedin(): ?string
    {
        return $this->LienLinkedin;
    }

    public function setLienLinkedin(?string $LienLinkedin): self
    {
        $this->LienLinkedin = $LienLinkedin;

        return $this;
    }

    public function getLienGithub(): ?string
    {
        return $this->LienGithub;
    }

    public function setLienGithub(?string $LienGithub): self
    {
        $this->LienGithub = $LienGithub;

        return $this;
    }

    public function getCvCondidat(): ?string
    {
        return $this->CvCondidat;
    }

    public function setCvCondidat(string $CvCondidat): self
    {
        $this->CvCondidat = $CvCondidat;

        return $this;
    }

    public function getIdAnnonce(): ?Annonce
    {
        return $this->IdAnnonce;
    }

    public function setIdAnnonce(?Annonce $IdAnnonce): self
    {
        $this->IdAnnonce = $IdAnnonce;

        return $this;
    }

    public function getIdCondidat(): ?User
    {
        return $this->IdCondidat;
    }

    public function setIdCondidat(?User $IdCondidat): self
    {
        $this->IdCondidat = $IdCondidat;

        return $this;
    }

    public function getIdEntretien(): ?Entretien
    {
        return $this->IdEntretien;
    }

    public function setIdEntretien(Entretien $IdEntretien): self
    {
        // set the owning side of the relation if necessary
        if ($IdEntretien->getIdCondidature() !== $this) {
            $IdEntretien->setIdCondidature($this);
        }

        $this->IdEntretien = $IdEntretien;

        return $this;
    }
    public function __toString()
    {
        return $this->NomCondidat;
    }
    
    
}

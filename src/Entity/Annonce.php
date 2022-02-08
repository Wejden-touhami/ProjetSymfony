<?php

namespace App\Entity;

use App\Repository\AnnonceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnnonceRepository::class)
 */
class Annonce
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
    private $Titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Date_annonce;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Deadline;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $KeyWord;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Societe;

    /**
     * @ORM\OneToMany(targetEntity=Condidature::class, mappedBy="IdAnnonce", orphanRemoval=true)
     */
    private $IdCondidature;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="IdAnnonce")
     * @ORM\JoinColumn(nullable=false)
     */
    private $IdRecriteur;

    /**
     * @ORM\ManyToMany(targetEntity=Categorie::class, inversedBy="IdAnnonce")
     */
    private $IdCategorie;

    

    public function __construct()
    {
        $this->IdCondidature = new ArrayCollection();
        $this->IdCategorie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): self
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getDateAnnonce(): ?\DateTimeInterface
    {
        return $this->Date_annonce;
    }

    public function setDateAnnonce(\DateTimeInterface $Date_annonce): self
    {
        $this->Date_annonce = $Date_annonce;

        return $this;
    }

    public function getDeadline(): ?\DateTimeInterface
    {
        return $this->Deadline;
    }

    public function setDeadline(\DateTimeInterface $Deadline): self
    {
        $this->Deadline = $Deadline;

        return $this;
    }

    public function getKeyWord(): ?string
    {
        return $this->KeyWord;
    }

    public function setKeyWord(string $KeyWord): self
    {
        $this->KeyWord = $KeyWord;

        return $this;
    }

    public function getSociete(): ?string
    {
        return $this->Societe;
    }

    public function setSociete(string $Societe): self
    {
        $this->Societe = $Societe;

        return $this;
    }

    /**
     * @return Collection|Condidature[]
     */
    public function getIdCondidature(): Collection
    {
        return $this->IdCondidature;
    }

    public function addIdCondidature(Condidature $idCondidature): self
    {
        if (!$this->IdCondidature->contains($idCondidature)) {
            $this->IdCondidature[] = $idCondidature;
            $idCondidature->setIdAnnonce($this);
        }

        return $this;
    }

    public function removeIdCondidature(Condidature $idCondidature): self
    {
        if ($this->IdCondidature->removeElement($idCondidature)) {
            // set the owning side to null (unless already changed)
            if ($idCondidature->getIdAnnonce() === $this) {
                $idCondidature->setIdAnnonce(null);
            }
        }

        return $this;
    }

    public function getIdRecriteur(): ?User
    {
        return $this->IdRecriteur;
    }

    public function setIdRecriteur(?User $IdRecriteur): self
    {
        $this->IdRecriteur = $IdRecriteur;

        return $this;
    }

    /**
     * @return Collection|Categorie[]
     */
    public function getIdCategorie(): Collection
    {
        return $this->IdCategorie;
    }

    public function addIdCategorie(Categorie $idCategorie): self
    {
        if (!$this->IdCategorie->contains($idCategorie)) {
            $this->IdCategorie[] = $idCategorie;
        }

        return $this;
    }

    public function removeIdCategorie(Categorie $idCategorie): self
    {
        $this->IdCategorie->removeElement($idCategorie);

        return $this;
    }
    public function __toString()
    {
        return $this->Titre;
    }

    

    
}

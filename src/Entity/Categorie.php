<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
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
    private $Nom;

    /**
     * @ORM\ManyToMany(targetEntity=Annonce::class, mappedBy="IdCategorie")
     */
    private $IdAnnonce;

    public function __construct()
    {
        $this->IdAnnonce = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    /**
     * @return Collection|Annonce[]
     */
    public function getIdAnnonce(): Collection
    {
        return $this->IdAnnonce;
    }

    public function addIdAnnonce(Annonce $idAnnonce): self
    {
        if (!$this->IdAnnonce->contains($idAnnonce)) {
            $this->IdAnnonce[] = $idAnnonce;
            $idAnnonce->addIdCategorie($this);
        }

        return $this;
    }

    public function removeIdAnnonce(Annonce $idAnnonce): self
    {
        if ($this->IdAnnonce->removeElement($idAnnonce)) {
            $idAnnonce->removeIdCategorie($this);
        }

        return $this;
    }
    public function __toString()
    {
        return $this->Nom;
    }
}

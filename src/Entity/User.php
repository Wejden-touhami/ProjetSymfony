<?php

namespace App\Entity;


use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $AdresseVille;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NumTelephone;

    /**
     * @ORM\Column(type="integer")
     */
    private $Age;

    /**
     * @ORM\OneToMany(targetEntity=Condidature::class, mappedBy="IdCondidat", orphanRemoval=true)
     */
    private $IdCondidature;

    /**
     * @ORM\OneToMany(targetEntity=Annonce::class, mappedBy="IdRecriteur", orphanRemoval=true)
     */
    private $IdAnnonce;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Photo;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $NbrCandidature;

    /**
     * @ORM\ManyToOne(targetEntity=Regle::class)
     */
    private $Regle;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $DateLogin;

    public function __construct()
    {
        $this->IdCondidature = new ArrayCollection();
        $this->IdAnnonce = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getAdresseVille(): ?string
    {
        return $this->AdresseVille;
    }

    public function setAdresseVille(string $AdresseVille): self
    {
        $this->AdresseVille = $AdresseVille;

        return $this;
    }

    public function getNumTelephone(): ?string
    {
        return $this->NumTelephone;
    }

    public function setNumTelephone(string $NumTelephone): self
    {
        $this->NumTelephone = $NumTelephone;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->Age;
    }

    public function setAge(int $Age): self
    {
        $this->Age = $Age;

        return $this;
    }
    public function addRoles(string $roles): self
    { 
        if (!in_array($roles, $this->roles)){
            $this->roles[]=$roles;
        }
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
            $idCondidature->setIdCondidat($this);
        }

        return $this;
    }

    public function removeIdCondidature(Condidature $idCondidature): self
    {
        if ($this->IdCondidature->removeElement($idCondidature)) {
            // set the owning side to null (unless already changed)
            if ($idCondidature->getIdCondidat() === $this) {
                $idCondidature->setIdCondidat(null);
            }
        }

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
            $idAnnonce->setIdRecriteur($this);
        }

        return $this;
    }

    public function removeIdAnnonce(Annonce $idAnnonce): self
    {
        if ($this->IdAnnonce->removeElement($idAnnonce)) {
            // set the owning side to null (unless already changed)
            if ($idAnnonce->getIdRecriteur() === $this) {
                $idAnnonce->setIdRecriteur(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->Nom;
    }

    public function getPhoto(): ?string
    {
        return $this->Photo;
    }

    public function setPhoto(?string $Photo): self
    {
        $this->Photo = $Photo;

        return $this;
    }

    public function getNbrCandidature(): ?int
    {
        return $this->NbrCandidature;
    }

    public function setNbrCandidature(?int $NbrCandidature): self
    {
        $this->NbrCandidature = $NbrCandidature;

        return $this;
    }

    public function getRegle(): ?Regle
    {
        return $this->Regle;
    }

    public function setRegle(?Regle $Regle): self
    {
        $this->Regle = $Regle;

        return $this;
    }

    public function getDateLogin(): ?\DateTimeInterface
    {
        return $this->DateLogin;
    }

    public function setDateLogin(?\DateTimeInterface $DateLogin): self
    {
        $this->DateLogin = $DateLogin;

        return $this;
    }
    
    
    
}

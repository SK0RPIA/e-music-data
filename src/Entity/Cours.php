<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoursRepository::class)]
class Cours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 70)]
    private ?string $libelle = null;

    #[ORM\Column(nullable: true)]
    private ?int $agemini = null;

    #[ORM\Column(nullable: true)]
    private ?int $agemaxi = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbplaces = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $heureDebut = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $heureFin = null;

     #[ORM\Column(type: integer)]
    
   private ?\DateTimeInterface $duration = null;

    #[ORM\ManyToOne(inversedBy: 'cours')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeInstrument $instrument = null;

    #[ORM\ManyToOne(inversedBy: 'cours')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Professeur $professeur = null;

    #[ORM\ManyToMany(targetEntity: Jour::class, inversedBy: 'cours')]
    private Collection $jours;

    #[ORM\ManyToOne(inversedBy: 'cours')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeDeCours $typeDeCours = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'cours')]
    private Collection $users;

    public function __construct()
    {
        $this->jour = new ArrayCollection();
        $this->users = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getAgemini(): ?int
    {
        return $this->agemini;
    }

    public function setAgemini(?int $agemini): self
    {
        $this->agemini = $agemini;

        return $this;
    }

    public function getAgemaxi(): ?int
    {
        return $this->agemaxi;
    }

    public function setAgemaxi(?int $agemaxi): self
    {
        $this->agemaxi = $agemaxi;

        return $this;
    }

    public function getNbplaces(): ?int
    {
        return $this->nbplaces;
    }

    public function setNbplaces(?int $nbplaces): self
    {
        $this->nbplaces = $nbplaces;

        return $this;
    }

    public function getHeureDebut(): ?\DateTimeInterface
    {
        return $this->heureDebut;
    }

    public function setHeureDebut(\DateTimeInterface $heureDebut): self
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    public function getHeureFin(): ?\DateTimeInterface
    {
        return $this->heureFin;
    }

    public function setHeureFin(\DateTimeInterface $heureFin): self
    {
        $this->heureFin = $heureFin;

        return $this;
    }

    public function getInstrument(): ?TypeInstrument
    {
        return $this->instrument;
    }

    public function setInstrument(?TypeInstrument $instrument): self
    {
        $this->instrument = $instrument;

        return $this;
    }
    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getProfesseur(): ?Professeur
    {
        return $this->professeur;
    }

    public function setProfesseur(?Professeur $professeur): self
    {
        $this->professeur = $professeur;

        return $this;
    }

    /**
     * @return Collection<int, Jour>
     */
    public function getJours(): Collection
    {
        return $this->jours;
    }

    public function addJour(Jour $jour): self
    {
        if (!$this->jour->contains($jour)) {
            $this->jour->add($jour);
        }

        return $this;
    }

    public function removeJour(Jour $jour): self
    {
        $this->jour->removeElement($jour);

        return $this;
    }

    public function getTypeDeCours(): ?TypeDeCours
    {
        return $this->typeDeCours;
    }

    public function setTypeDeCours(?TypeDeCours $typeDeCours): self
    {
        $this->typeDeCours = $typeDeCours;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->users->removeElement($user);

        return $this;
    }

    
}

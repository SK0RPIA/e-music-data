<?php

namespace App\Entity;

use App\Repository\ClasseInstrumentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClasseInstrumentRepository::class)]
class ClasseInstrument
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 70)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'classeInstrument', targetEntity: TypeInstrument::class, orphanRemoval: true)]
    private Collection $typeInstruments;

    public function __construct()
    {
        $this->typeInstruments = new ArrayCollection();
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

    /**
     * @return Collection<int, TypeInstrument>
     */
    public function getTypeInstruments(): Collection
    {
        return $this->typeInstruments;
    }

    public function addTypeInstrument(TypeInstrument $typeInstrument): self
    {
        if (!$this->typeInstruments->contains($typeInstrument)) {
            $this->typeInstruments->add($typeInstrument);
            $typeInstrument->setClasseInstrument($this);
        }

        return $this;
    }

    public function removeTypeInstrument(TypeInstrument $typeInstrument): self
    {
        if ($this->typeInstruments->removeElement($typeInstrument)) {
            // set the owning side to null (unless already changed)
            if ($typeInstrument->getClasseInstrument() === $this) {
                $typeInstrument->setClasseInstrument(null);
            }
        }

        return $this;
    }
}

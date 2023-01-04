<?php

namespace App\Entity;

use App\Repository\EnfantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnfantRepository::class)]
class Enfant extends User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'enfants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Responsable $responsable = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResponsable(): ?Responsable
    {
        return $this->responsable;
    }

    public function setResponsable(?Responsable $responsable): self
    {
        $this->responsable = $responsable;

        return $this;
    }
}

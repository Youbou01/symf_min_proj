<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $Designation = null;

    #[ORM\ManyToMany(mappedBy: 'categories', targetEntity: Peinture::class)]
    private Collection $peintures;

    public function __construct()
    {
        $this->peintures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->Designation;
    }

    public function setDesignation(string $Designation): static
    {
        $this->Designation = $Designation;
        return $this;
    }

    /** @return Collection<int, Peinture> */
    public function getPeintures(): Collection
    {
        return $this->peintures;
    }

    public function __toString(): string
    {
        return $this->Designation ?? '';
    }
}

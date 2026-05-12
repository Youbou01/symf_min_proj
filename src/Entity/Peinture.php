<?php

namespace App\Entity;

use App\Repository\PeintureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PeintureRepository::class)]
class Peinture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $Nom = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private ?string $largeur = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private ?string $Hauteur = null;

    #[ORM\Column]
    private ?bool $en_vente = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private ?string $prix = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $date_realisation = null;

    #[ORM\Column(type: 'text')]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'peintures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Personne $personne = null;

    #[ORM\ManyToMany(targetEntity: Categorie::class, inversedBy: 'peintures')]
    private Collection $categories;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;
        return $this;
    }

    public function getLargeur(): ?string
    {
        return $this->largeur;
    }

    public function setLargeur(string $largeur): static
    {
        $this->largeur = $largeur;
        return $this;
    }

    public function getHauteur(): ?string
    {
        return $this->Hauteur;
    }

    public function setHauteur(string $Hauteur): static
    {
        $this->Hauteur = $Hauteur;
        return $this;
    }

    public function isEnVente(): ?bool
    {
        return $this->en_vente;
    }

    public function setEnVente(bool $en_vente): static
    {
        $this->en_vente = $en_vente;
        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): static
    {
        $this->prix = $prix;
        return $this;
    }

    public function getDateRealisation(): ?\DateTimeInterface
    {
        return $this->date_realisation;
    }

    public function setDateRealisation(\DateTimeInterface $date_realisation): static
    {
        $this->date_realisation = $date_realisation;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getPersonne(): ?Personne
    {
        return $this->personne;
    }

    public function setPersonne(?Personne $personne): static
    {
        $this->personne = $personne;
        return $this;
    }

    /** @return Collection<int, Categorie> */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategorie(Categorie $categorie): static
    {
        if (!$this->categories->contains($categorie)) {
            $this->categories->add($categorie);
        }
        return $this;
    }

    public function removeCategorie(Categorie $categorie): static
    {
        $this->categories->removeElement($categorie);
        return $this;
    }

    public function __toString(): string
    {
        return $this->Nom ?? '';
    }
}

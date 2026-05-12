<?php

namespace App\Entity;

use App\Repository\PersonneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonneRepository::class)]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'type', type: 'string')]
#[ORM\DiscriminatorMap(['personne' => Personne::class, 'user' => User::class])]
class Personne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $Nom = null;

    #[ORM\Column(length: 20)]
    private ?string $preNom = null;

    #[ORM\Column(type: 'decimal', precision: 15, scale: 0)]
    private ?string $Tel = null;

    #[ORM\Column(length: 8)]
    private ?string $CIN = null;

    #[ORM\OneToMany(mappedBy: 'personne', targetEntity: Commentaire::class, orphanRemoval: true)]
    private Collection $commentaires;

    #[ORM\OneToMany(mappedBy: 'personne', targetEntity: Peinture::class, orphanRemoval: true)]
    private Collection $peintures;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
        $this->peintures    = new ArrayCollection();
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

    public function getPreNom(): ?string
    {
        return $this->preNom;
    }

    public function setPreNom(string $preNom): static
    {
        $this->preNom = $preNom;
        return $this;
    }

    public function getTel(): ?string
    {
        return $this->Tel;
    }

    public function setTel(string $Tel): static
    {
        $this->Tel = $Tel;
        return $this;
    }

    public function getCIN(): ?string
    {
        return $this->CIN;
    }

    public function setCIN(string $CIN): static
    {
        $this->CIN = $CIN;
        return $this;
    }

    /** @return Collection<int, Commentaire> */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): static
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires->add($commentaire);
            $commentaire->setPersonne($this);
        }
        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): static
    {
        if ($this->commentaires->removeElement($commentaire)) {
            if ($commentaire->getPersonne() === $this) {
                $commentaire->setPersonne(null);
            }
        }
        return $this;
    }

    /** @return Collection<int, Peinture> */
    public function getPeintures(): Collection
    {
        return $this->peintures;
    }

    public function addPeinture(Peinture $peinture): static
    {
        if (!$this->peintures->contains($peinture)) {
            $this->peintures->add($peinture);
            $peinture->setPersonne($this);
        }
        return $this;
    }

    public function removePeinture(Peinture $peinture): static
    {
        if ($this->peintures->removeElement($peinture)) {
            if ($peinture->getPersonne() === $this) {
                $peinture->setPersonne(null);
            }
        }
        return $this;
    }

    public function __toString(): string
    {
        return $this->Nom . ' ' . $this->preNom;
    }
}

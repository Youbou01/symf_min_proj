<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['Emaillogin'], message: 'Cet email est déjà utilisé.')]
class User extends Personne implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Column(length: 50, unique: true)]
    private ?string $Emaillogin = null;

    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    public function getEmaillogin(): ?string
    {
        return $this->Emaillogin;
    }

    public function setEmaillogin(string $Emaillogin): static
    {
        $this->Emaillogin = $Emaillogin;
        return $this;
    }

    /**
     * Identifiant utilisé par Symfony Security (= email de login).
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->Emaillogin;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        // Chaque utilisateur a au minimum ROLE_USER
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;
        return $this;
    }

    public function eraseCredentials(): void
    {
        // Effacer les données sensibles temporaires si nécessaire
    }
}

<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
// use PHPUnit\Framework\Assert;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Usuers
 *
 * @ORM\Table(name="usuers")
 * @ORM\Entity
 */
class Usuers implements PasswordAuthenticatedUserInterface, UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="role", type="string", length=50, nullable=true)
     */
    private $role;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     * @Assert\NotBlank
     * @Assert\Regex(
     *      pattern = "/^[\pL\s]+$/u",
     *      message = "El campo debe estar formado por letras"
     * )
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="surname", type="string", length=100, nullable=true)
     * @Assert\NotBlank
     * @Assert\Regex(
     *      pattern = "/^[\pL\s]+$/u",
     *      message = "El campo debe estar formado por letras"
     * )
     */
    private $surname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=true)
     * @Assert\NotBlank
     * @Assert\Email(
     *      message = "Email invalido"
     * )
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=true)
     * @Assert\NotBlank
     * 
     */
    private $password;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="Tasks", mappedBy="user")
     * 
     */

    private $tasks;

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(?string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|Task[]
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }
    public function getUsername()
    {
        return $this->email;
    }
    public function getSalt()
    {
        return null;
    }

    public function getRoles(): array
    {
        $roles = $this->role;
        // guarantee every user at least has ROLE_USER
        $roles = array('ROLE_USER');

        return array_unique($roles);
    }
    public function eraseCredentials()
    {
    }

    public function getUserIdentifier(): string
    {
        return 'role';
    }
}

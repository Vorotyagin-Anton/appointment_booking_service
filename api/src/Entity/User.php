<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['userShort'])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['userShort'])]
    private $surname;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['userShort'])]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['userShort'])]
    private $middlename;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    #[Groups(['userShort'])]
    private $isWorker;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    #[Groups(['userShort'])]
    private $isClient;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    #[Groups(['userShort'])]
    private $mobilePhoneNumber;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['userShort'])]
    private $email;

    #[ORM\Column(type: 'string', length: 255, nullable: true, options: ['default' => 'uploads/photo/dummy.jpg'])]
    #[Groups(['userShort'])]
    private $pathToPhoto;

    #[ORM\Column(type: 'text', nullable: true)]
    #[Groups(['userShort'])]
    private $story;

    #[ORM\ManyToMany(targetEntity: Service::class, inversedBy: "workers")]
    #[ORM\JoinTable(name: "users_services")]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id")]
    #[ORM\InverseJoinColumn(name: "service_id", referencedColumnName: "id")]
    #[Groups(['user_services'])]
    private $services;

    #[ORM\Column(type: 'json', nullable: true)]
    private $roles = [];

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $password;

    public function __construct($surname, $name, $middlename)
    {
        $this->surname = $surname;
        $this->name = $name;
        $this->middlename = $middlename;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getMiddlename(): ?string
    {
        return $this->middlename;
    }

    public function setMiddlename(string $middlename): self
    {
        $this->middlename = $middlename;

        return $this;
    }

    public function getIsWorker(): ?bool
    {
        return $this->isWorker;
    }

    public function setIsWorker(bool $isWorker): self
    {
        $this->isWorker = $isWorker;

        return $this;
    }

    public function getIsClient(): ?bool
    {
        return $this->isClient;
    }

    public function setIsClient(bool $isClient): self
    {
        $this->isClient = $isClient;

        return $this;
    }

    public function getMobilePhoneNumber(): ?string
    {
        return $this->mobilePhoneNumber;
    }

    public function setMobilePhoneNumber(?string $mobilePhoneNumber): self
    {
        $this->mobilePhoneNumber = $mobilePhoneNumber;

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

    public function getPathToPhoto(): ?string
    {
        return $this->pathToPhoto;
    }

    public function setPathToPhoto(string $pathToPhoto): self
    {
        $this->pathToPhoto = $pathToPhoto;

        return $this;
    }

    public function getStory(): ?string
    {
        return $this->story;
    }

    public function setStory(?string $story): self
    {
        $this->story = $story;

        return $this;
    }

    public function getServices(): ?Collection
    {
        return $this->services;
    }

    public function setServices(?array $services): self
    {
        $this->services = $services;

        return $this;
    }

    /**
     * The public representation of the user (e.g. a username, an email address, etc.)
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
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
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
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
}

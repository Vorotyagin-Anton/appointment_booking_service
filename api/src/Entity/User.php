<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $surname;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $middlename;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private $isWorker;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private $isClient;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private $mobilePhoneNumber;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $email;

    #[ORM\Column(type: 'string', length: 255, nullable: true, options: ['default' => 'public/uploads/photo/dummy.jpg'])]
    private $path_to_photo;

    #[ORM\Column(type: 'text', nullable: true)]
    private $story;

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
        return $this->path_to_photo;
    }

    public function setPathToPhoto(string $path_to_photo): self
    {
        $this->path_to_photo = $path_to_photo;

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
}

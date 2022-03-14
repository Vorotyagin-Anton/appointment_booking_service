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

    #[ORM\Column(type: 'boolean')]
    private $isWorker;

    #[ORM\Column(type: 'boolean')]
    private $isClient;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private $mobilePhoneNumber;

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
}

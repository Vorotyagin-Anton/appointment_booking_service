<?php

namespace App\Entity;

use App\Entity\User\User;
use App\Repository\AddressRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AddressRepository::class)]
class Address
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['addressShort'])]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['addressShort'])]
    private $state;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['addressShort'])]
    private $city;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['addressShort'])]
    private $street;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups(['addressShort'])]
    private $code;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['addressShort'])]
    private $home;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'addresses')]
    #[Groups(['address_users'])]
    private $relatedUsers;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Gedmo\Timestampable(on: 'create')]
    private $createdAt;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    #[Gedmo\Timestampable(on: 'update')]
    private $updatedAt;

    public function __construct()
    {
        $this->relatedUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(?int $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getHome(): ?string
    {
        return $this->home;
    }

    public function setHome(?string $home): self
    {
        $this->home = $home;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getRelatedUsers(): Collection
    {
        return $this->relatedUsers;
    }

    public function addRelatedUser(User $relatedUser): self
    {
        if (!$this->relatedUsers->contains($relatedUser)) {
            $this->relatedUsers[] = $relatedUser;
        }

        return $this;
    }

    public function removeRelatedUser(User $relatedUser): self
    {
        $this->relatedUsers->removeElement($relatedUser);

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}

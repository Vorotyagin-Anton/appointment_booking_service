<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['serviceShort'])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['serviceShort'])]
    private $name;

    #[ORM\ManyToMany(targetEntity: ServiceCategory::class)]
    #[ORM\JoinTable(name: 'services_service_categories')]
    #[ORM\JoinColumn(name: "service_id", referencedColumnName: "id")]
    #[ORM\InverseJoinColumn(name: "service_category_id", referencedColumnName: "id")]
    #[Groups(['service_category'])]
    private $category;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['serviceShort'])]
    private $pathToPhoto;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: "services")]
    #[Groups(['service_workers'])]
    private $workers;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCategory(): ?Collection
    {
        return $this->category;
    }

    public function setCategory(?Collection $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getPathToPhoto(): ?string
    {
        return $this->pathToPhoto;
    }

    public function setPathToPhoto(?string $pathToPhoto): self
    {
        $this->pathToPhoto = $pathToPhoto;

        return $this;
    }

    public function getWorkers(): ?Collection
    {
        return $this->workers;
    }

    public function setWorkers(?Collection $workers): self
    {
        $this->workers = $workers;

        return $this;
    }
}

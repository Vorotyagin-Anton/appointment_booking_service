<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\ManyToMany(targetEntity: ServiceCategory::class)]
    #[ORM\JoinTable(name: 'services_service_categories')]
    #[ORM\JoinColumn(name: "service_id", referencedColumnName: "id")]
    #[ORM\InverseJoinColumn(name: "service_category_id", referencedColumnName: "id")]
    private $category;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $pathToPhoto;

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

    public function getCategory(): ?array
    {
        return $this->category;
    }

    public function setCategory(?array $category): self
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
}

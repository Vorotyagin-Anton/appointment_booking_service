<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
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

    #[ORM\ManyToMany(targetEntity: ServiceCategory::class, inversedBy: "services")]
    #[ORM\JoinTable(name: 'services_service_categories')]
    #[ORM\JoinColumn(name: "service_id", referencedColumnName: "id")]
    #[ORM\InverseJoinColumn(name: "service_category_id", referencedColumnName: "id")]
    #[Groups(['service_category'])]
    private $category;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['serviceShort'])]
    private $pathToPhoto;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Gedmo\Timestampable(on: 'create')]
    private $createdAt;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    #[Gedmo\Timestampable(on: 'update')]
    private $updatedAt;

    public function __construct()
    {
        $this->category = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, ServiceCategory>
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(ServiceCategory $serviceCategory): self
    {
        if (!$this->category->contains($serviceCategory)) {
            $this->category[] = $serviceCategory;
            $serviceCategory->addService($this);
        }

        return $this;
    }

    public function removeCategory(ServiceCategory $serviceCategory): self
    {
        if ($this->category->removeElement($serviceCategory)) {
            $serviceCategory->removeService($this);
        }

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

<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
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

    #[ORM\ManyToMany(targetEntity: ServiceCategory::class, inversedBy: "services")]
    #[ORM\JoinTable(name: 'services_service_categories')]
    #[ORM\JoinColumn(name: "service_id", referencedColumnName: "id")]
    #[ORM\InverseJoinColumn(name: "service_category_id", referencedColumnName: "id")]
    #[Groups(['service_category'])]
    private $category;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['serviceShort'])]
    private $pathToPhoto;

    #[ORM\ManyToMany(targetEntity: Worker::class, mappedBy: "services")]
    #[Groups(['service_workers'])]
    private $workers;

    #[ORM\Column(type: 'smallint', nullable: true)]
    #[Groups(['serviceShort'])]
    private $price;

    #[ORM\Column(type: 'smallint', nullable: true)]
    #[Groups(['serviceShort'])]
    private $duration;

    #[ORM\OneToMany(mappedBy: 'service', targetEntity: Order::class)]
    #[Groups(['service_orders'])]
    private $orders;

    public function __construct()
    {
        $this->workers = new ArrayCollection();
        $this->category = new ArrayCollection();
        $this->orders = new ArrayCollection();
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

    /**
     * @return Collection<int, Worker>
     */
    public function getWorkers(): Collection
    {
        return $this->workers;
    }

    public function addWorker(Worker $worker): self
    {
        if (!$this->workers->contains($worker)) {
            $this->workers[] = $worker;
            $worker->addService($this);
        }

        return $this;
    }

    public function removeWorker(Worker $worker): self
    {
        if ($this->workers->removeElement($worker)) {
            $worker->removeService($this);
        }

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setService($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getService() === $this) {
                $order->setService(null);
            }
        }

        return $this;
    }
}

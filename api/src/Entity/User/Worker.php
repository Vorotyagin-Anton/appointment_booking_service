<?php

namespace App\Entity\User;

use App\Entity\Career;
use App\Entity\Order;
use App\Entity\Rating;
use App\Entity\Review;
use App\Entity\Service;
use App\Entity\WorkerAvailableTime;
use App\Repository\WorkerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: WorkerRepository::class)]
class Worker extends User
{
    #[ORM\ManyToMany(targetEntity: Service::class, inversedBy: "workers")]
    #[ORM\JoinTable(name: "workers_services")]
    #[ORM\JoinColumn(name: "worker_id", referencedColumnName: "id")]
    #[ORM\InverseJoinColumn(name: "service_id", referencedColumnName: "id")]
    #[Groups(['worker_services'])]
    private $services;

    #[ORM\OneToMany(mappedBy: 'worker', targetEntity: WorkerAvailableTime::class, cascade: ['persist'], orphanRemoval: true)]
    #[Groups(['worker_workerAvailableTimes'])]
    private $availableTimes;

    #[ORM\OneToOne(mappedBy: 'worker', targetEntity: Rating::class, cascade: ['persist', 'remove'])]
    #[Groups(['worker_rating'])]
    private $rating;

    #[ORM\OneToMany(mappedBy: 'worker', targetEntity: Career::class, cascade: ['persist'], orphanRemoval: true)]
    #[Groups(['worker_career'])]
    private $career;

    #[ORM\OneToMany(mappedBy: 'worker', targetEntity: Review::class, cascade: ['persist'], orphanRemoval: true)]
    #[Groups(['worker_reviews'])]
    private $reviews;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['workerShort'])]
    private $speciality;

    #[ORM\OneToMany(mappedBy: 'worker', targetEntity: Order::class)]
    #[Groups(['worker_orders'])]
    private $orders;

    public function __construct()
    {
        parent::__construct();

        $this->setIsClient(false);
        $this->setIsWorker(true);

        $this->services = new ArrayCollection();
        $this->availableTimes = new ArrayCollection();
        $this->career = new ArrayCollection();
        $this->reviews = new ArrayCollection();
        $this->orders = new ArrayCollection();
    }

    /**
     * @return Collection<int, Service>
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Service $service): self
    {
        if (!$this->services->contains($service)) {
            $this->services[] = $service;
            $service->addWorker($this);
        }

        return $this;
    }

    public function removeService(Service $service): self
    {
        if ($this->services->removeElement($service)) {
            $service->removeWorker($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, WorkerAvailableTime>
     */
    public function getAvailableTimes(): Collection
    {
        return $this->availableTimes;
    }

    public function addAvailableTime(WorkerAvailableTime $workerAvailableTime): self
    {
        if (!$this->availableTimes->contains($workerAvailableTime)) {
            $this->availableTimes[] = $workerAvailableTime;
            $workerAvailableTime->setWorker($this);
        }

        return $this;
    }

    public function removeAvailableTime(WorkerAvailableTime $workerAvailableTime): self
    {
        $this->availableTimes->removeElement($workerAvailableTime);

        return $this;
    }

    public function getRating(): ?Rating
    {
        return $this->rating;
    }

    public function setRating(Rating $rating): self
    {
        // set the owning side of the relation if necessary
        if ($rating->getWorker() !== $this) {
            $rating->setWorker($this);
        }

        $this->rating = $rating;

        return $this;
    }

    /**
     * @return Collection<int, Career>
     */
    public function getCareer(): Collection
    {
        return $this->career;
    }

    public function addCareer(Career $career): self
    {
        if (!$this->career->contains($career)) {
            $this->career[] = $career;
            $career->setWorker($this);
        }

        return $this;
    }

    public function removeCareer(Career $career): self
    {
        if ($this->career->removeElement($career)) {
            // set the owning side to null (unless already changed)
            if ($career->getWorker() === $this) {
                $career->setWorker(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Review $review): self
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews[] = $review;
            $review->setWorker($this);
        }

        return $this;
    }

    public function removeReview(Review $review): self
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getWorker() === $this) {
                $review->setWorker(null);
            }
        }

        return $this;
    }

    public function getSpeciality(): ?string
    {
        return $this->speciality;
    }

    public function setSpeciality(?string $speciality): self
    {
        $this->speciality = $speciality;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addWorkerOrder(Order $workerOrder): self
    {
        if (!$this->orders->contains($workerOrder)) {
            $this->orders[] = $workerOrder;
            $workerOrder->setWorker($this);
        }

        return $this;
    }

    public function removeWorkerOrder(Order $workerOrder): self
    {
        if ($this->orders->removeElement($workerOrder)) {
            // set the owning side to null (unless already changed)
            if ($workerOrder->getWorker() === $this) {
                $workerOrder->setWorker(null);
            }
        }

        return $this;
    }
}

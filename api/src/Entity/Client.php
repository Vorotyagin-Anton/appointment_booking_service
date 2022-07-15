<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client extends User
{
    #[ORM\OneToMany(mappedBy: 'reviewer', targetEntity: Review::class, cascade: ['persist'])]
    #[Groups(['client_reviews'])]
    private $reviews;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Order::class)]
    #[Groups(['client_orders'])]
    private $orders;

    public function __construct()
    {
        parent::__construct();

        $this->setIsClient(true);
        $this->setIsWorker(false);

        $this->reviews = new ArrayCollection();
        $this->orders = new ArrayCollection();
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
            $review->setReviewer($this);
        }

        return $this;
    }

    public function removeReview(Review $review): self
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getReviewer() === $this) {
                $review->setReviewer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $clientOrder): self
    {
        if (!$this->orders->contains($clientOrder)) {
            $this->orders[] = $clientOrder;
            $clientOrder->setClient($this);
        }

        return $this;
    }

    public function removeOrder(Order $clientOrder): self
    {
        if ($this->orders->removeElement($clientOrder)) {
            // set the owning side to null (unless already changed)
            if ($clientOrder->getClient() === $this) {
                $clientOrder->setClient(null);
            }
        }

        return $this;
    }
}

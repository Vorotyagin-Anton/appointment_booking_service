<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['orderShort'])]
    private $id;

    #[ORM\Column(type: 'integer')]
    #[Groups(['orderShort'])]
    private $clientContactType;

    #[ORM\Column(type: 'integer')]
    #[Groups(['orderShort'])]
    private $status;

    #[ORM\Column(type: 'text', nullable: true)]
    #[Groups(['orderShort'])]
    private $details;

    #[ORM\ManyToOne(targetEntity: Service::class, inversedBy: 'orders')]
    #[Groups(['order_service'])]
    private $service;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['orderShort'])]
    private $clientName;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    #[Groups(['orderShort'])]
    private $clientPhone;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['orderShort'])]
    private $clientEmail;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['orderShort'])]
    private $clientTelegram;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'clientOrders')]
    #[Groups(['order_client'])]
    private $client;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'workerOrders')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['order_worker'])]
    private $worker;

    #[ORM\OneToMany(mappedBy: 'relatedOrder', targetEntity: WorkerAvailableTime::class)]
    #[Groups(['order_time'])]
    private $time;

    public function __construct()
    {
        $this->time = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?User
    {
        return $this->client;
    }

    public function setClient(User $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getClientContactType(): ?int
    {
        return $this->clientContactType;
    }

    public function setClientContactType(int $clientContactType): self
    {
        $this->clientContactType = $clientContactType;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(?string $details): self
    {
        $this->details = $details;

        return $this;
    }

    public function getWorker(): ?User
    {
        return $this->worker;
    }

    public function setWorker(User $worker): self
    {
        $this->worker = $worker;

        return $this;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): self
    {
        $this->service = $service;

        return $this;
    }

    public function getClientName(): ?string
    {
        return $this->clientName;
    }

    public function setClientName(string $clientName): self
    {
        $this->clientName = $clientName;

        return $this;
    }

    public function getClientPhone(): ?string
    {
        return $this->clientPhone;
    }

    public function setClientPhone(?string $clientPhone): self
    {
        $this->clientPhone = $clientPhone;

        return $this;
    }

    public function getClientEmail(): ?string
    {
        return $this->clientEmail;
    }

    public function setClientEmail(?string $clientEmail): self
    {
        $this->clientEmail = $clientEmail;

        return $this;
    }

    public function getClientTelegram(): ?string
    {
        return $this->clientTelegram;
    }

    public function setClientTelegram(?string $clientTelegram): self
    {
        $this->clientTelegram = $clientTelegram;

        return $this;
    }

    /**
     * @return Collection<int, WorkerAvailableTime>
     */
    public function getTime(): Collection
    {
        return $this->time;
    }

    public function addTime(WorkerAvailableTime $time): self
    {
        if (!$this->time->contains($time)) {
            $this->time[] = $time;
            $time->setRelatedOrder($this);
        }

        return $this;
    }

    public function removeTime(WorkerAvailableTime $time): self
    {
        if ($this->time->removeElement($time)) {
            // set the owning side to null (unless already changed)
            if ($time->getRelatedOrder() === $this) {
                $time->setRelatedOrder(null);
            }
        }

        return $this;
    }
}

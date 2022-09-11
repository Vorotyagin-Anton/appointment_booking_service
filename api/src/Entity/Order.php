<?php

namespace App\Entity;

use App\Entity\User\Client;
use App\Entity\User\Worker;
use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
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

    #[ORM\ManyToOne(targetEntity: ContactType::class)]
    #[Groups(['order_clientContactType'])]
    private $clientContactType;

    #[ORM\ManyToOne(targetEntity: OrderStatus::class)]
    #[Groups(['order_status'])]
    private $status;

    #[ORM\Column(type: 'text', nullable: true)]
    #[Groups(['orderShort'])]
    private $details;

    #[ORM\ManyToOne(targetEntity: WorkerService::class)]
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

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'orders')]
    #[Groups(['order_client'])]
    private $client;

    #[ORM\ManyToOne(targetEntity: Worker::class, inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['order_worker'])]
    private $worker;

    #[ORM\OneToMany(mappedBy: 'relatedOrder', targetEntity: WorkerAvailableTime::class)]
    #[Groups(['order_time'])]
    private $time;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Gedmo\Timestampable(on: 'create')]
    private $createdAt;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    #[Gedmo\Timestampable(on: 'update')]
    private $updatedAt;

    public function __construct()
    {
        $this->time = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getClientContactType(): ?ContactType
    {
        return $this->clientContactType;
    }

    public function setClientContactType(ContactType $clientContactType): self
    {
        $this->clientContactType = $clientContactType;

        return $this;
    }

    public function getStatus(): ?OrderStatus
    {
        return $this->status;
    }

    public function setStatus(OrderStatus $status): self
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

    public function getWorker(): ?Worker
    {
        return $this->worker;
    }

    public function setWorker(Worker $worker): self
    {
        $this->worker = $worker;

        return $this;
    }

    public function getService(): ?WorkerService
    {
        return $this->service;
    }

    public function setService(?WorkerService $service): self
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

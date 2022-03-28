<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'client_user_id', referencedColumnName: 'id', nullable: false)]
    private $client;

    #[ORM\Column(type: 'date', nullable: true)]
    private $executionDate;

    #[ORM\Column(type: 'time', nullable: true)]
    private $executionTime;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $serviceType;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $workerContactType;

    #[ORM\Column(type: 'integer')]
    private $clientContactType;

    #[ORM\Column(type: 'integer')]
    private $status;

    #[ORM\Column(type: 'text', nullable: true)]
    private $details;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'worker_user_id', referencedColumnName: 'id', nullable: false)]
    private $worker;

    public function __construct($client, $worker)
    {
        $this->client = $client;
        $this->worker = $worker;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?User
    {
        return $this->client;
    }

    public function setClient(int $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getExecutionDate(): ?\DateTimeInterface
    {
        return $this->executionDate;
    }

    public function setExecutionDate(?\DateTimeInterface $executionDate): self
    {
        $this->executionDate = $executionDate;

        return $this;
    }

    public function getExecutionTime(): ?\DateTimeInterface
    {
        return $this->executionTime;
    }

    public function setExecutionTime(?\DateTimeInterface $executionTime): self
    {
        $this->executionTime = $executionTime;

        return $this;
    }

    public function getServiceType(): ?int
    {
        return $this->serviceType;
    }

    public function setServiceType(?int $serviceType): self
    {
        $this->serviceType = $serviceType;

        return $this;
    }

    public function getWorkerContactType(): ?int
    {
        return $this->workerContactType;
    }

    public function setWorkerContactType(?int $workerContactType): self
    {
        $this->workerContactType = $workerContactType;

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
}

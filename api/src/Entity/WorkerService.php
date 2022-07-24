<?php

namespace App\Entity;

use App\Entity\User\Worker;
use App\Repository\WorkerServiceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: WorkerServiceRepository::class)]
class WorkerService
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['workerServiceShort'])]
    private $id;

    #[ORM\ManyToOne(targetEntity: Worker::class, inversedBy: 'services')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['workerService_worker'])]
    private $worker;

    #[ORM\ManyToOne(targetEntity: Service::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['workerService_service'])]
    private $service;

    #[ORM\Column(type: 'integer')]
    #[Groups(['workerServiceShort'])]
    private $price;

    #[ORM\Column(type: 'smallint')]
    #[Groups(['workerServiceShort'])]
    private $duration;

    #[ORM\Column(type: 'text')]
    #[Groups(['workerServiceShort'])]
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWorker(): ?Worker
    {
        return $this->worker;
    }

    public function setWorker(?Worker $worker): self
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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}

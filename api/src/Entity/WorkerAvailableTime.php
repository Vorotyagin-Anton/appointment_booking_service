<?php

namespace App\Entity;

use App\Repository\WorkerAvailableTimeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: WorkerAvailableTimeRepository::class)]
class WorkerAvailableTime
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['workerAvailableTimeShort'])]
    private $id;

    #[ORM\ManyToOne(targetEntity: Worker::class, inversedBy: 'availableTimes')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['workerAvailableTime_worker'])]
    private $worker;

    #[ORM\Column(type: 'integer')]
    #[Groups(['workerAvailableTimeShort'])]
    private $exactTimeInMinutes;

    #[ORM\Column(type: 'boolean', options: ['default' => true])]
    #[Groups(['workerAvailableTimeShort'])]
    private $isTimeFree;

    #[ORM\Column(type: 'date')]
    #[Groups(['workerAvailableTimeShort'])]
    private $exactDate;

    #[ORM\ManyToOne(targetEntity: Order::class, inversedBy: 'time')]
    #[Groups(['workerAvailableTime_relatedOrder'])]
    private $relatedOrder;

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

    public function getExactTimeInMinutes(): ?int
    {
        return $this->exactTimeInMinutes;
    }

    public function setExactTimeInMinutes(int $exactTimeInMinutes): self
    {
        $this->exactTimeInMinutes = $exactTimeInMinutes;

        return $this;
    }

    public function getIsTimeFree(): ?bool
    {
        return $this->isTimeFree;
    }

    public function setIsTimeFree(bool $isTimeFree): self
    {
        $this->isTimeFree = $isTimeFree;

        return $this;
    }

    public function getExactDate(): ?\DateTimeInterface
    {
        return $this->exactDate;
    }

    public function setExactDate(\DateTimeInterface $exactDate): self
    {
        $this->exactDate = $exactDate;

        return $this;
    }

    public function getRelatedOrder(): ?Order
    {
        return $this->relatedOrder;
    }

    public function setRelatedOrder(?Order $relatedOrder): self
    {
        $this->relatedOrder = $relatedOrder;

        return $this;
    }
}

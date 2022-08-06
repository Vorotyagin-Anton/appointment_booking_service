<?php

namespace App\Entity;

use App\Entity\User\Worker;
use App\Repository\WorkerAvailableTimeRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
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
    private $isTimeFree = true;

    #[ORM\Column(type: 'date')]
    #[Groups(['workerAvailableTimeShort'])]
    private $exactDate;

    #[ORM\ManyToOne(targetEntity: Order::class, inversedBy: 'time')]
    #[Groups(['workerAvailableTime_relatedOrder'])]
    private $relatedOrder;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Gedmo\Timestampable(on: 'create')]
    private $createdAt;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    #[Gedmo\Timestampable(on: 'update')]
    private $updatedAt;

    public function __toString(): string
    {
        $hours = intval($this->exactTimeInMinutes/60);
        $minutes = str_pad(($this->exactTimeInMinutes/60 - $hours) * 6, 2, 0);
        return $this->exactDate->format('Y-m-d') . " $hours:$minutes";
    }

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

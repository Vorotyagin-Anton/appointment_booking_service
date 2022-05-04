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

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'workerAvailableTimes')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['workerAvailableTime_worker'])]
    private $worker;

    #[ORM\Column(type: 'integer')]
    #[Groups(['workerAvailableTimeShort'])]
    private $exactTimeInMinutes;

    #[ORM\Column(type: 'boolean', options: ['default' => true])]
    #[Groups(['workerAvailableTimeShort'])]
    private $isTimeFree;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWorker(): ?User
    {
        return $this->worker;
    }

    public function setWorker(?User $worker): self
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
}

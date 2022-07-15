<?php

namespace App\Entity;

use App\Repository\RatingRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: RatingRepository::class)]
class Rating
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['ratingShort'])]
    private $id;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups(['ratingShort'])]
    private $score;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups(['ratingShort'])]
    private $voices;

    #[ORM\OneToOne(inversedBy: 'rating', targetEntity: Worker::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $worker;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(?int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getVoices(): ?int
    {
        return $this->voices;
    }

    public function setVoices(?int $voices): self
    {
        $this->voices = $voices;

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
}

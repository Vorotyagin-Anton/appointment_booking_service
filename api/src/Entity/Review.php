<?php

namespace App\Entity;

use App\Repository\ReviewRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['reviewShort'])]
    private $id;

    #[ORM\Column(type: 'smallint')]
    #[Groups(['reviewShort'])]
    private $score;

    #[ORM\Column(type: 'text')]
    #[Groups(['reviewShort'])]
    private $text;

    #[ORM\Column(type: 'datetime')]
    #[Groups(['reviewShort'])]
    private $date;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'reviews')]
    #[Groups(['review_reviewer'])]
    private $reviewer;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'gettedReviews')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['review_worker'])]
    private $worker;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getReviewer(): ?User
    {
        return $this->reviewer;
    }

    public function setReviewer(?User $reviewer): self
    {
        $this->reviewer = $reviewer;

        return $this;
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
}

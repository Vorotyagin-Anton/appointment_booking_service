<?php

namespace App\Entity;

use App\Repository\CareerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CareerRepository::class)]
class Career
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['careerShort'])]
    private $id;

    #[ORM\Column(type: 'date', nullable: true)]
    #[Groups(['careerShort'])]
    private $yearFrom;

    #[ORM\Column(type: 'date', nullable: true)]
    #[Groups(['careerShort'])]
    private $yearTo;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['careerShort'])]
    private $speciality;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['careerShort'])]
    private $place;

    #[ORM\ManyToOne(targetEntity: User::class, cascade: ['persist'], inversedBy: 'career')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['career_worker'])]
    private $worker;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYearFrom(): ?\DateTimeInterface
    {
        return $this->yearFrom;
    }

    public function setYearFrom(?\DateTimeInterface $yearFrom): self
    {
        $this->yearFrom = $yearFrom;

        return $this;
    }

    public function getYearTo(): ?\DateTimeInterface
    {
        return $this->yearTo;
    }

    public function setYearTo(?\DateTimeInterface $yearTo): self
    {
        $this->yearTo = $yearTo;

        return $this;
    }

    public function getSpeciality(): ?string
    {
        return $this->speciality;
    }

    public function setSpeciality(string $speciality): self
    {
        $this->speciality = $speciality;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(?string $place): self
    {
        $this->place = $place;

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

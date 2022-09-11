<?php

namespace App\Entity;

use App\Repository\OrderStatusRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: OrderStatusRepository::class)]
class OrderStatus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['orderStatusShort'])]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['orderStatusShort'])]
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\SymfonyConsoleMakeEntityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SymfonyConsoleMakeEntityRepository::class)]
class SymfonyConsoleMakeEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}

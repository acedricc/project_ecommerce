<?php

namespace App\Entity;

use App\Entity\User;
use App\Entity\CreatedAtTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommandesRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: CommandesRepository::class)]
class Commandes
{
    use CreatedAtTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $reference = null;



    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?Coupons $coupons = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'commandes', targetEntity: CommandesDetails::class, orphanRemoval: true)]
    private Collection $commandesDetails;

    public function __construct()
    {
        $this->commandesDetails = new ArrayCollection();
        $this->created_at = new \DateTimeImmutable();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }


    public function getCoupons(): ?Coupons
    {
        return $this->coupons;
    }

    public function setCoupons(?Coupons $coupons): self
    {
        $this->coupons = $coupons;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, CommandesDetails>
     */
    public function getCommandesDetails(): Collection
    {
        return $this->commandesDetails;
    }

    public function addCommandesDetail(CommandesDetails $commandesDetail): self
    {
        if (!$this->commandesDetails->contains($commandesDetail)) {
            $this->commandesDetails->add($commandesDetail);
            $commandesDetail->setCommandes($this);
        }

        return $this;
    }

    public function removeCommandesDetail(CommandesDetails $commandesDetail): self
    {
        if ($this->commandesDetails->removeElement($commandesDetail)) {
            // set the owning side to null (unless already changed)
            if ($commandesDetail->getCommandes() === $this) {
                $commandesDetail->setCommandes(null);
            }
        }

        return $this;
    }
}

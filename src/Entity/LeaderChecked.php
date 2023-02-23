<?php

namespace App\Entity;

use App\Repository\LeaderCheckedRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LeaderCheckedRepository::class)]
class LeaderChecked
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isDispatch = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isChargeable = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $transferCost = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isDelivery = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isTruckDocChecked = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isAlcohol = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isCustomDocChecked = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $commentApprehensionCustom = null;

    #[ORM\OneToOne(mappedBy: 'leaderListValidate', cascade: ['persist', 'remove'])]
    private ?Calendar $calendar = null;

    #[ORM\OneToMany(mappedBy: 'leaderChecked', targetEntity: Calendar::class)]
    private Collection $calendars;

    public function __construct()
    {
        $this->calendars = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isIsDispatch(): ?bool
    {
        return $this->isDispatch;
    }

    public function setIsDispatch(?bool $isDispatch): self
    {
        $this->isDispatch = $isDispatch;

        return $this;
    }

    public function isIsChargeable(): ?bool
    {
        return $this->isChargeable;
    }

    public function setIsChargeable(?bool $isChargeable): self
    {
        $this->isChargeable = $isChargeable;

        return $this;
    }

    public function getTransferCost(): ?string
    {
        return $this->transferCost;
    }

    public function setTransferCost(?string $transferCost): self
    {
        $this->transferCost = $transferCost;

        return $this;
    }

    public function isIsDelivery(): ?bool
    {
        return $this->isDelivery;
    }

    public function setIsDelivery(?bool $isDelivery): self
    {
        $this->isDelivery = $isDelivery;

        return $this;
    }

    public function isIsTruckDocChecked(): ?bool
    {
        return $this->isTruckDocChecked;
    }

    public function setIsTruckDocChecked(?bool $isTruckDocChecked): self
    {
        $this->isTruckDocChecked = $isTruckDocChecked;

        return $this;
    }

    public function isIsAlcohol(): ?bool
    {
        return $this->isAlcohol;
    }

    public function setIsAlcohol(?bool $isAlcohol): self
    {
        $this->isAlcohol = $isAlcohol;

        return $this;
    }

    public function isIsCustomDocChecked(): ?bool
    {
        return $this->isCustomDocChecked;
    }

    public function setIsCustomDocChecked(?bool $isCustomDocChecked): self
    {
        $this->isCustomDocChecked = $isCustomDocChecked;

        return $this;
    }

    public function getCommentApprehensionCustom(): ?string
    {
        return $this->commentApprehensionCustom;
    }

    public function setCommentApprehensionCustom(?string $commentApprehensionCustom): self
    {
        $this->commentApprehensionCustom = $commentApprehensionCustom;

        return $this;
    }

    public function getCalendar(): ?Calendar
    {
        return $this->calendar;
    }

    // public function setCalendar(?Calendar $calendar): self
    // {
    //     // unset the owning side of the relation if necessary
    //     if ($calendar === null && $this->calendar !== null) {
    //         $this->calendar->setLeaderListValidate(null);
    //     }

    //     // set the owning side of the relation if necessary
    //     if ($calendar !== null && $calendar->getLeaderListValidate() !== $this) {
    //         $calendar->setLeaderListValidate($this);
    //     }

    //     $this->calendar = $calendar;

    //     return $this;
    // }

    /**
     * @return Collection<int, Calendar>
     */
    public function getCalendars(): Collection
    {
        return $this->calendars;
    }

    public function addCalendar(Calendar $calendar): self
    {
        if (!$this->calendars->contains($calendar)) {
            $this->calendars->add($calendar);
            $calendar->setLeaderChecked($this);
        }

        return $this;
    }

    public function removeCalendar(Calendar $calendar): self
    {
        if ($this->calendars->removeElement($calendar)) {
            // set the owning side to null (unless already changed)
            if ($calendar->getLeaderChecked() === $this) {
                $calendar->setLeaderChecked(null);
            }
        }

        return $this;
    }
}

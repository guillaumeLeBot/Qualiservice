<?php

namespace App\Entity;

use App\Repository\DriverCheckedRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DriverCheckedRepository::class)]
class DriverChecked
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $startLoading = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $stopLoading = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $durationLoading = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isCompliant = null;

    #[ORM\OneToMany(mappedBy: 'driverChecked', targetEntity: Calendar::class)]
    private Collection $calendars;

    #[ORM\Column(nullable: true)]
    private ?int $palletsChecked = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $comment = null;
    
    public function __construct()
    {
        $this->calendars = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartLoading(): ?\DateTimeInterface
    {
        return $this->startLoading;
    }

    public function setStartLoading(?\DateTimeInterface $startLoading): self
    {
        $this->startLoading = $startLoading;

        return $this;
    }

    public function getStopLoading(): ?\DateTimeInterface
    {
        return $this->stopLoading;
    }

    public function setStopLoading(?\DateTimeInterface $stopLoading): self
    {
        $this->stopLoading = $stopLoading;

        return $this;
    }

    public function getDurationLoading(): ?string
    {
        return $this->durationLoading;
    }

    public function setDurationLoading(?string $durationLoading): self
    {
        $this->durationLoading = $durationLoading;

        return $this;
    }

    public function isIsCompliant(): ?bool
    {
        return $this->isCompliant;
    }

    public function setIsCompliant(?bool $isCompliant): self
    {
        $this->isCompliant = $isCompliant;

        return $this;
    }

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
            $calendar->setDriverChecked($this);
        }

        return $this;
    }

    public function removeCalendar(Calendar $calendar): self
    {
        if ($this->calendars->removeElement($calendar)) {
            // set the owning side to null (unless already changed)
            if ($calendar->getDriverChecked() === $this) {
                $calendar->setDriverChecked(null);
            }
        }

        return $this;
    }

    public function getPalletsChecked(): ?int
    {
        return $this->palletsChecked;
    }

    public function setPalletsChecked(?int $palletsChecked): self
    {
        $this->palletsChecked = $palletsChecked;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }
}
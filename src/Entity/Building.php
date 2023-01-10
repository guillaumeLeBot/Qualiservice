<?php

namespace App\Entity;

use App\Repository\BuildingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BuildingRepository::class)]
class Building
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Calendar::class, inversedBy: 'buildings')]
    private Collection $property;

    #[ORM\OneToMany(mappedBy: 'building', targetEntity: Calendar::class)]
    private Collection $calendars;

    public function __construct()
    {
        $this->property = new ArrayCollection();
        $this->calendars = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Calendar>
     */
    public function getProperty(): Collection
    {
        return $this->property;
    }

    public function addProperty(Calendar $property): self
    {
        if (!$this->property->contains($property)) {
            $this->property->add($property);
        }

        return $this;
    }

    public function removeProperty(Calendar $property): self
    {
        $this->property->removeElement($property);

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
            $calendar->setBuilding($this);
        }

        return $this;
    }

    public function removeCalendar(Calendar $calendar): self
    {
        if ($this->calendars->removeElement($calendar)) {
            // set the owning side to null (unless already changed)
            if ($calendar->getBuilding() === $this) {
                $calendar->setBuilding(null);
            }
        }

        return $this;
    }
}

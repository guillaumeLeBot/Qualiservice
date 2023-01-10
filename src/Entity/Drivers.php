<?php

namespace App\Entity;

use App\Repository\DriversRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DriversRepository::class)]
class Drivers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Calendar::class, inversedBy: 'drivers')]
    private Collection $property;

    #[ORM\OneToMany(mappedBy: 'driver', targetEntity: Calendar::class)]
    private Collection $building;

    public function __construct()
    {
        $this->property = new ArrayCollection();
        $this->building = new ArrayCollection();
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
    public function getBuilding(): Collection
    {
        return $this->building;
    }

    public function addBuilding(Calendar $building): self
    {
        if (!$this->building->contains($building)) {
            $this->building->add($building);
            $building->setDriver($this);
        }

        return $this;
    }

    public function removeBuilding(Calendar $building): self
    {
        if ($this->building->removeElement($building)) {
            // set the owning side to null (unless already changed)
            if ($building->getDriver() === $this) {
                $building->setDriver(null);
            }
        }

        return $this;
    }
}
